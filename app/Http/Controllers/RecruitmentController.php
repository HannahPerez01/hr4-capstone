<?php
namespace App\Http\Controllers;

use App\Enum\DepartmentEnum;
use App\Enum\JobRequestStatusEnum;
use App\Models\JobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{

    protected JobRequest $model;

    public function __construct(JobRequest $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $jobRequests = $this->model->query()->get();

        return view('content.recruitment.recruitment-index', [
            'jobRequests' => $jobRequests,
        ]);
    }

    public function create()
    {
        $departmentEnums = DepartmentEnum::toOptions();

        return view('content.recruitment.recruitment-create', [
            'departmentEnums' => $departmentEnums,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'job_title'  => 'string|required',
            'department' => 'string|required',
        ]);

        $jobRequest = $this->model->create([
            'job_title'  => $data['job_title'],
            'department' => $data['department'],
            'status'     => JobRequestStatusEnum::PENDING->value,
        ]);

        if (! $jobRequest) {
            return redirect()->back()->with('errors', 'There was an error in creating job request');
        }

        return redirect()->route('recruitment')->with('success', 'Job Request created successfully!');
    }

    public function edit(string $id)
    {
        $jobRequest      = $this->model->find($id);
        $departmentEnums = DepartmentEnum::toOptions();

        return view('content.recruitment.recruitment-edit', [
            'jobRequest'      => $jobRequest,
            'departmentEnums' => $departmentEnums,
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'job_title'  => 'string|required',
            'department' => 'string|required',
        ]);

        $jobRequest = $this->model->find($id)->update([
            'job_title'  => $data['job_title'],
            'department' => $data['department'],
            'status'     => JobRequestStatusEnum::PENDING->value,
        ]);

        if (! $jobRequest) {
            return redirect()->back()->with('errors', 'There was an error in updating job request');
        }

        return redirect()->route('recruitment')->with('success', 'Job Request updated successfully!');
    }

    public function destroy(string $id)
    {
        $jobRequest = $this->model->findOrFail($id);
        $jobRequest->delete();

        if (! $jobRequest) {
            return redirect()->back()->with('errors', 'There was an error in deleting job request');
        }

        return redirect()->route('recruitment')->with('success', 'Job Request deleted successfully!');
    }
}
