<?php
namespace App\Http\Controllers;

use App\Enum\CivilStatusEnum;
use App\Enum\DepartmentEnum;
use App\Enum\EmployeeGenderEnum;
use App\Enum\EmployeeStatusEnum;
use App\Enum\EmploymentTypeEnum;
use App\Models\Employee;
use App\Models\JobPosition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{

    protected Employee $model;
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $employees = $this->model->query()->with('jobPosition')->get();

        return view('content.corehuman.employee-profile.employee-profile-index', [
            'employees' => $employees,
        ]);
    }

    public function view($id)
    {
        $employee = $this->model->where('id', $id)->with('jobPosition')->first();

        return view('content.corehuman.employee-profile.employee-profile-view', [
            'employee' => $employee,
        ]);
    }

    public function edit($id)
    {
        $employee            = $this->model->where('id', $id)->with('jobPosition')->first();
        $jobPositions        = JobPosition::query()->get();
        $genderEnums         = EmployeeGenderEnum::toOptions();
        $departmentEnums     = DepartmentEnum::toOptions();
        $employmentTypeEnums = EmploymentTypeEnum::toOptions();
        $employeeStatusEnums = EmployeeStatusEnum::toOptions();
        $civilStatusEnums    = CivilStatusEnum::toOptions();

        return view('content.corehuman.employee-profile.employee-profile-edit', [
            'employee'            => $employee,
            'jobPositions'        => $jobPositions,
            'genderEnums'         => $genderEnums,
            'departmentEnums'     => $departmentEnums,
            'employmentTypeEnums' => $employmentTypeEnums,
            'employeeStatusEnums' => $employeeStatusEnums,
            'civilStatusEnums'    => $civilStatusEnums,
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee                  = $this->model->where('id', $id)->first();
        $employee->name            = $request->employee_name;
        $employee->gender          = $request->gender;
        $employee->civil_status    = $request->civil_status;
        $employee->age             = $request->age;
        $employee->email           = $request->email;
        $employee->present_address = $request->present_address;
        $employee->department      = $request->department;
        $employee->job_position_id = $request->job_position_id;
        $employee->employment_type = $request->employment_type;
        $employee->date_hired      = $request->date_hired;
        $employee->status          = $request->status;
        $employee->save();

        if (! $employee) {
            return redirect()
                ->route('employee-profile')
                ->with('error', 'There was an error updating employee.');
        }

        return redirect()
            ->route('employee-profile')
            ->with('success', 'Employee Information is updated successfully.');
    }

    public function attachFile(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if (! $data) {
            return redirect()->back()->with('error', 'File is required.');
        }

        if (! $request->hasFile('file')) {
            return redirect()->back()->with('error', 'File is required.');
        }

        $employee = $this->model->find($request->employee_id);


        if (! $employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        if ($request->hasFile('file')) {
            $employee->addMedia($request->file('file'))
                ->toMediaCollection('employee_profile_attachments');
        }

        return redirect()
            ->route('employee-profile')
            ->with('success', 'Attachment is added successfully.');
    }
}
