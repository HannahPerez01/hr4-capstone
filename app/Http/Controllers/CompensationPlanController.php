<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Http\Request;
use App\Models\CompensationPlan;
use App\Enum\Compensation\JobCategoryEnum;

class CompensationPlanController extends Controller
{

    protected CompensationPlan $model;

    public function __construct(CompensationPlan $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $compensationPlan = $request->has('jobPositionCategory')
            ? $this->model->where('job_category', $request->query('jobPositionCategory'))->first()
            : null;

        if ($request->ajax()) {
            return response()->json([
                'compensationPlan' => $compensationPlan,
            ]);
        }

        $categories = JobCategoryEnum::toOptions();

        return view('content.compensation-plan.compensation-plan-index', [
            'categories' => $categories,
            'compensationPlan' => $compensationPlan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
