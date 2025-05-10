<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\UserRoleEnum;
use App\Enum\PromoteStatus;
use App\Models\JobPosition;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Enum\RequestStatusEnum;
use App\Enum\SuccessionStatusEnum;
use App\Models\SuccessionPlanning;
use Illuminate\Http\RedirectResponse;
use App\Models\SuccessionPlanningRequest;
use App\Notifications\SuccessionPlanningRequestNotification;

class PerformanceController extends Controller
{
    public function __construct(protected Performance $model,
        protected SuccessionPlanning $successionPlanning,
        protected User $user,
        protected SuccessionPlanningRequest $successionPlanningRequest,
        protected JobPosition $jobPosition
    ) {
        $this->model                     = $model;
        $this->successionPlanning        = $successionPlanning;
        $this->user                      = $user;
        $this->successionPlanningRequest = $successionPlanningRequest;
        $this->jobPosition               = $jobPosition;
    }

    public function index()
    {
        $performances = $this->model->query()->get();

        return view('content.corehuman.performance-index', [
            'performances' => $performances,
        ]);
    }

    public function succession()
    {
        $successions = $this->successionPlanning->query()
            ->where('status', SuccessionStatusEnum::READY_NOW->value)
            ->where('request_status', RequestStatusEnum::APPROVED->value)
            ->with('employee')
            ->get();

        $positions = $this->jobPosition->query()->get();

        return view('content.corehuman.performance-succession', [
            'successions' => $successions,
            'positions'   => $positions,
        ]);
    }

    public function successionRequest(Request $request): RedirectResponse
    {
        $successionRequest = $this->successionPlanningRequest
            ->where('requestor_id', auth()->user()->id)
            ->where('job_position_id', $request->position)
            ->where('status', RequestStatusEnum::PENDING->value)
            ->first();

        if ($successionRequest) {
            return redirect()->back()->with('error', 'You have pending request for this position. Please try again later once the status is changed.');
        }

        $successionRequest               = $this->successionPlanningRequest;
        $successionRequest->requestor_id = auth()->user()->id;
        $successionRequest->job_position_id = $request->position;
        $successionRequest->save();

        $successions = $this->successionPlanning->query()
            ->where('status', SuccessionStatusEnum::READY_NOW->value)
            ->where('request_status', RequestStatusEnum::PENDING->value)
            ->get();

        foreach ($successions as $succession) {
            $succession->update([
                'request_status' => RequestStatusEnum::REQUESTED->value,
            ]);
        }

        $users = $this->user->where('role', UserRoleEnum::HR2_ADMIN->value)->get();

        if ($users->isEmpty()) {
            return redirect()->back()->withErrors(['errors' => 'No HR2 Admin found.']);
        }

        $title       = 'Succession Planning Request';
        $message     = 'A request from HR4 Admin has been submitted.';
        $submittedBy = $this->successionRequest->user->name ?? 'Unknown';
        foreach ($users as $user) {
            $user->notify(new SuccessionPlanningRequestNotification($successionRequest, $title, $message, $submittedBy));
        }

        return redirect()->back()->with('success', 'Request has been submitted. Wait for the HR2 Admin to approve it.');
    }

    public function promote(string $id)
    {
        $succession = $this->successionPlanning->find($id);

        if (! $succession) {
            return redirect()->back()->with('error', 'Succession not found!');
        }

        $succession->promoted_status = PromoteStatus::PROMOTED->value;
        $succession->save();

        return redirect()->back()->with('success', 'Promoted successfully');
    }

    public function reject(string $id)
    {
        $succession = $this->successionPlanning->find($id);

        if (! $succession) {
            return redirect()->back()->with('error', 'Succession not found!');
        }

        $succession->promoted_status = PromoteStatus::REJECTED->value;
        $succession->save();

        return redirect()->back()->with('success', 'Rejected successfully');
    }
}
