<?php
namespace App\Http\Controllers;

use App\Models\Performance;

class PerformanceController extends Controller
{

    protected Performance $model;

    public function __construct(Performance $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $performances = $this->model->query()->get();

        return view('content.corehuman.performance-index', [
            'performances' => $performances
        ]);
    }
}
