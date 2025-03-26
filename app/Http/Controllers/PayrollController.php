<?php
namespace App\Http\Controllers;

use App\Http\Requests\PayrollRequest;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Support\Str;

class PayrollController extends Controller
{

    protected Payroll $model;

    public function __construct(Payroll $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $payrolls = $this->model->query()->with(['employee'])->get();

        return view('content.payroll.payroll-index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::query()->with('jobPosition')->get();

        return view('content.payroll.payroll-create', compact('employees'));
    }

    public function store(PayrollRequest $request)
    {
        $payroll = $this->model->create([
            'employee_id'         => $request->employee_id,
            'code'                => strtoupper(Str::random(16)),
            'from'                => $request->from,
            'to'                  => $request->to,
            'basic_salary_hours'  => $request->basic_salary,
            'basic_salary_amount' => $request->basic_salary_render,
            'reg_ot_hours'        => $request->reg_ot,
            'reg_ot_amount'       => $request->reg_ot_render,
            'rd_ot_hours'         => $request->rd_ot,
            'rd_ot_amount'        => $request->rd_ot_render,
            'pag_ibig'            => $request->pag_ibig_render,
            'sss'                 => $request->sss_render,
            'philhealth'          => $request->philhealth_render,
            'total_deductions'    => $request->total_deductions,
            'total_earnings'      => $request->total_earnings,
        ]);

        if (! $payroll) {
            return redirect()->route('payroll')->with(["errors" => 'Error in creating payroll!']);
        }

        return redirect()->route('payroll')->with(["success" => "Payroll added successfully!"]);
    }

    public function edit(string $id)
    {
        $employees = Employee::query()->with('jobPosition')->get();
        $payroll   = $this->model->where('id', $id)->with('employee')->first();

        return view('content.payroll.payroll-edit', compact('employees', 'payroll'));
    }

    public function update(PayrollRequest $request, string $id)
    {
        $payroll = $this->model->find($id)
            ->update([
                'employee_id'         => $request->employee_id,
                'from'                => $request->from,
                'to'                  => $request->to,
                'basic_salary_hours'  => $request->basic_salary,
                'basic_salary_amount' => $request->basic_salary_render,
                'reg_ot_hours'        => $request->reg_ot,
                'reg_ot_amount'       => $request->reg_ot_render,
                'rd_ot_hours'         => $request->rd_ot,
                'rd_ot_amount'        => $request->rd_ot_render,
                'pag_ibig'            => $request->pag_ibig_render,
                'sss'                 => $request->sss_render,
                'philhealth'          => $request->philhealth_render,
                'total_deductions'    => $request->total_deductions,
                'total_earnings'      => $request->total_earnings,
            ]);

        if (! $payroll) {
            return redirect()->route('payroll')->with(["errors" => 'Error in updating payroll!']);
        }

        return redirect()->route('payroll')->with(["success" => "Payroll updated successfully!"]);
    }

    public function destroy(string $id)
    {
        $payroll = $this->model->findOrFail($id);
        $payroll->delete();

        if (! $payroll) {
            return redirect()->back()->with(["errors" => 'Error in deleting payroll!']);
        }

        return redirect()->back()->with(["success" => "Payroll deleted successfully!"]);
    }

    public function records()
    {
        $payrolls = $this->model->query()->with(['employee'])->get();

        return view('content.payroll.records', compact('payrolls'));
    }
}
