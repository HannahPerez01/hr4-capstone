<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Compensation;
use Illuminate\Http\Request;
use App\Enum\Compensation\StatusEnum;
use App\Enum\Compensation\TransactionTypeEnum;

class CompensationController extends Controller
{

    protected Compensation $model;
    protected Payroll $payroll;
    protected Employee $employee;

    public function __construct(Compensation $model, Payroll $payroll, Employee $employee)
    {
        $this->model = $model;
        $this->payroll = $payroll;
        $this->employee = $employee;
    }

    public function index()
    {
        $compensations = $this->model->query()->with('employee')->get();
        $payrolls = $this->payroll->query()->with(['employee'])->get();

        return view('content.compensation.compensation-index', [
            'payrolls' => $payrolls
        ]);
    }

    public function create()
    {
        $employees = $this->employee->query()->with('payrolls')->get();
        $transactionEnums = TransactionTypeEnum::toOptions();
        $statusEnums = StatusEnum::toOptions();

        return view('content.compensation.compensation-create', [
            'employees' => $employees,
            'transactionTypeEnums' => $transactionEnums,
            'statusEnums' => $statusEnums,
        ]);
    }

    public function store(Request $request)
    {
        $compensation = $this->model;
        $compensation->employee_id = $request->employee_id;
        $compensation->transaction_type = $request->transaction;
        $compensation->status = $request->status;
        $compensation->save();

        if (!$compensation) {
            return redirect()
                ->route('compensation')
                ->with('error', 'There was an error adding compensation.');
        }

        return redirect()
            ->route('compensation')
            ->with('success', 'Compensation is added successfully.');
    }

    public function edit($id) {
        $compensation = $this->model->where('id', $id)->with('employee')->first();
        $employees = $this->employee->query()->get();
        $transactionEnums = TransactionTypeEnum::toOptions();
        $statusEnums = StatusEnum::toOptions();

        return view('content.compensation.compensation-edit', [
            'compensation' => $compensation,
            'employees' => $employees,
            'transactionTypeEnums' => $transactionEnums,
            'statusEnums' => $statusEnums,
        ]);
    }

    public function update(Request $request, $id)
    {
        $compensation = $this->model->where('id', $id)->first();
        $compensation->employee_id = $request->employee_id;
        $compensation->transaction_type = $request->transaction;
        $compensation->status = $request->status;
        $compensation->save();

        if (!$compensation) {
            return redirect()
                ->route('compensation')
                ->with('error', 'There was an error updating compensation.');
        }

        return redirect()
            ->route('compensation')
            ->with('success', 'Compensation is updated successfully.');
    }
}
