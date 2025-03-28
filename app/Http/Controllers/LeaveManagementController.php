<?php
namespace App\Http\Controllers;

use App\Models\FileLeave;
use Illuminate\Support\Facades\DB;

class LeaveManagementController extends Controller
{

    protected FileLeave $model;

    public function __construct(FileLeave $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $leaves = $this->model->query()->with(['employee'])->get();

        return view('content.corehuman.leave-management-index', [
            'leaves' => $leaves
        ]);
    }

}
