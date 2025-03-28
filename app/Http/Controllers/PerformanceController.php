<?php
namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\SuccessionPlanning;

class PerformanceController extends Controller
{

    protected Performance $model;
    protected SuccessionPlanning $successionPlanning;

    public function __construct(Performance $model, SuccessionPlanning $successionPlanning)
    {
        $this->model = $model;
        $this->successionPlanning = $successionPlanning;
    }

    public function index()
    {
        $performances = $this->model->query()->get();

        return view('content.corehuman.performance-index', [
            'performances' => $performances
        ]);
    }

    public function succession()
    {
        $successions = $this->successionPlanning->query()->with('employee')->get();

        return view('content.corehuman.performance-succession', [
            'successions' => $successions
        ]);
    }
}
