<?php
namespace App\Http\Controllers;

use App\Enum\PayrollStatusEnum;
use App\Http\Requests\PayrollRequest;
use App\Models\Employee;
use App\Models\Finance;
use App\Models\JobPosition;
use App\Models\Payroll;
use App\Models\Timesheet;
use App\Models\User;
use App\Notifications\PayslipNotification;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PayrollController extends Controller
{

    protected Payroll $model;
    protected JobPosition $jobPosition;
    protected GeminiService $geminiService;

    public function __construct(Payroll $model, JobPosition $jobPosition, GeminiService $geminiService, protected User $user)
    {
        $this->model         = $model;
        $this->jobPosition   = $jobPosition;
        $this->geminiService = $geminiService;
        $this->user          = $user;
    }

    public function index()
    {
        $payrolls     = $this->model->query()->with(['employee'])->get();
        $jobPositions = $this->jobPosition->query()->get();

        return view('content.payroll.payroll-index', compact('payrolls', 'jobPositions'));
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

    public function show(string $id)
    {
        $payroll = $this->model->with(['employee.jobPosition'])->find($id);

        return view('content.payroll.payroll-view', [
            'payroll' => $payroll,
        ]);
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

    public function generatePayroll(Request $request)
    {
        $jobPositionId = $request->input('job_position_id');
        $jobPosition   = JobPosition::find($jobPositionId);

        if (! $jobPosition) {
            return response()->json(['error' => 'Invalid job position'], 400);
        }

        // Fetch employees with selected job position
        $employees = Employee::where('job_position_id', $jobPositionId)->get();

        if ($employees->isEmpty()) {
            return redirect()->back()->with('info', 'No timesheet found to the selected job position and given date!');
        }

        $employeeData = [];

        foreach ($employees as $employee) {
            // Fetch total work hours from timesheets
            $timesheets = Timesheet::where('employee_id', $employee->id)
                ->whereBetween('date', [$request->from, $request->to])
                ->get();

            if ($timesheets->isEmpty()) {
                return redirect()->back()->with('info', 'No timesheet found to the selected job position and given date!');
            }

            $hoursWorked   = 0;
            $totalOvertime = 0;

            foreach ($timesheets as $timesheet) {
                $normalHours = 8;
                $hoursWorked += $timesheet->total_hours_work; // Sum total hours
                $overtime = max(0, $timesheet->total_hours_work - $normalHours);
                $totalOvertime += $overtime;
            }

            $totalHoursWorked    = $hoursWorked - $totalOvertime;
            $totalAmount         = $totalHoursWorked * $jobPosition->hourly_rate;
            $totalOvertimeAmount = $jobPosition->hourly_rate * 1.25 * $totalOvertime;
            $salary              = $totalAmount + $totalOvertimeAmount;
            $total_earnings      = $salary - 1100;

            // Send individual request to Gemini AI
            $aiResponse = $this->geminiService->generatePayroll([
                'name'                      => $employee->name,
                'hourly_rate'               => $jobPosition->hourly_rate,
                'ot_percentage'             => 1.25,
                'total_hours'               => $hoursWorked,
                'regular_hours'             => $totalHoursWorked,
                'overtime_hours'            => $totalOvertime,
                'hours_worked_and_rate'     => $totalAmount,
                'total_overtime_amount'     => $totalOvertimeAmount,
                'salary'                    => $salary,
                'pag_ibig_employee_share'   => 50,
                'pag_ibig_employer_share'   => 50,
                'sss_employee_share'        => 675,
                'sss_employer_share'        => 675,
                'philhealth_employee_share' => 375,
                'philhealth_employer_share' => 375,
                'total_deductions'          => 2200,
                'net_salary'                => $total_earnings,
            ]);

            // Extract AI response text
            $aiText = $aiResponse['candidates'][0]['content']['parts'][0]['text'] ?? 'No AI response';

            // Employee payroll data
            $payroll = $this->model->create([
                'employee_id'         => $employee->id,
                'code'                => strtoupper(Str::random(16)),
                'from'                => $request->from,
                'to'                  => $request->to,
                'basic_salary_hours'  => $totalHoursWorked,
                'basic_salary_amount' => $totalAmount ?? 0,
                'reg_ot_hours'        => $totalOvertime,
                'reg_ot_amount'       => $totalOvertimeAmount ?? 0,
                'rd_ot_hours'         => $request->rd_ot,
                'rd_ot_amount'        => $request->rd_ot_render ?? 0,
                'sss'                 => 675,
                'philhealth'          => 375,
                'pagibig'             => 50,
                'total_deductions'    => 1100,
                'total_earnings'      => $total_earnings,
                'status'              => PayrollStatusEnum::IN_PROGRESS->value,
                'response'            => $aiText,
            ]);

            // Store the processed employee payroll data
            $employeeData[] = [
                'name'           => $employee->name,
                'regular_hours'  => $totalHoursWorked,
                'overtime_hours' => $totalOvertime,
                'salary'         => $salary,
                'net_salary'     => $payroll->total_earnings,
            ];
        }

        return redirect()->back()->with('success', 'Payroll generated successfully. You can view the response in view payroll.');
    }

    public function generatePayslip(string $id)
    {
        $payroll  = $this->model->find($id);
        $employee = Employee::find($payroll->employee_id);

        if (! $payroll) {
            return redirect()->back()->with('errors', 'Payroll is not exists!');
        }

        if (! $employee) {
            return redirect()->back()->with('errors', 'Employee is not exists!');
        }

        // Update the generate payslip to true to display in ESS
        $payroll->status           = PayrollStatusEnum::COMPLETED->value;
        $payroll->generate_payslip = true;
        $payroll->save();

        // Send notification to ESS
        $employee->user->notify(new PayslipNotification($payroll));

        return redirect()->back()->with('success', 'Payslip is successfully generated to ESS');
    }

    public function generatePayrollToFinance(string $id)
    {
        $payroll = $this->model->find($id);

        if (! $payroll) {
            return redirect()->back()->with('errors', 'Payroll is not exists!');
        }

        $finance = Finance::create([
            'amount'       => $payroll->total_earnings,
            'category'     => 'Disbursement',
            'requested_by' => strtoupper(auth()->user()->role),
            'status'       => 'Pending',
        ]);

        if (! $finance) {
            return redirect()->back()->with('errors', 'There was an error in generating payroll records to finance!');
        }

        return redirect()->back()->with('success', 'Payroll record generated to finance successfully!');
    }

}
