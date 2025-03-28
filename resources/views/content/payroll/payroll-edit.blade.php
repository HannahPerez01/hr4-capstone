@extends('layouts/layoutMaster')
@section('title', 'Payroll')
@section('vendor-style')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-chat.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')
@endsection
@section('page-script')
    @vite('resources/assets/js/app-chat.js')
@endsection

@section('content')

    <div class="card">
        <div class="card">
            <div>
                <button type="button" class="btn btn-dark btn-sm m-3"
                    onclick="location.href = '{{ route('payroll') }}'">Back</button>
            </div>

            @if (session()->has('success'))
                <x-alert successMessage="{{ session('success') }}" />
            @elseif(session()->has('error'))
                <x-alert errorMessage="{{ session('error') }}" />
            @endif

            <div class="card-datatable p-5">
                <form action="{{ route('payroll-update', ['id' => $payroll->id]) }}" method="POST" class="form-group row">
                    @method('PUT')
                    @csrf

                    <div class="col-md-12">
                        <label for="" class="form-label">Employee</label>
                        <select id="select-employee" name="employee_id" placeholder="Select an option" class="w-50"
                            autocomplete="off">
                            <option value="{{ $payroll->employee_id }}">{{ $payroll->employee->employee_code }} -
                                {{ $payroll->employee->name }}</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" data-position="{{ $employee->jobPosition->title }}"
                                    data-position-rate="{{ $employee->jobPosition->hourly_rate }}">
                                    {{ $employee->employee_code }} - {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="updated_rate" value="{{ $payroll->employee->jobPosition->hourly_rate }}"
                        id="updated_rate">

                    <div class="col-md-12 mt-3" id="position-container"">
                        <label for="" class="form-label">Position:</label>
                        <input type="text" id="text" class="form-control w-50"
                            value="{{ $payroll->employee->jobPosition->title }}" readonly />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="" class="form-label">From</label>
                        <input type="date" name="from" id="from" value="{{ $payroll->from }}"
                            class="form-control w-50" />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="" class="form-label">To</label>
                        <input type="date" name="to" id="to" value="{{ $payroll->to }}"
                            class="form-control w-50" />
                    </div>

                    <div class="w-100" id="position-container2"">
                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <strong>EARNINGS</strong>
                                </div>
                                <div class="col">
                                    <strong>HOURS</strong>
                                </div>
                                <div class="col">
                                    <strong>AMOUNT</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">Basic Salary</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="basic_salary" id="basic_salary"
                                        value="{{ $payroll->basic_salary_hours }}" class="form-control">
                                </div>
                                <div class="col" id="basic_salary_render">
                                    {{ $payroll->basic_salary_amount }}
                                </div>
                                <input type="hidden" name="basic_salary_render"
                                    value="{{ $payroll->basic_salary_amount }}" id="basic_salary_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">Reg OT</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="reg_ot" id="reg_ot"
                                        value="{{ $payroll->reg_ot_hours }}" class="form-control">
                                </div>
                                <div class="col" id="reg_ot_render">
                                    {{ $payroll->reg_ot_amount }}
                                </div>
                                <input type="hidden" name="reg_ot_render" value="{{ $payroll->reg_ot_amount }}"
                                    id="reg_ot_render_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">RD OT</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="rd_ot" id="rd_ot"
                                        value="{{ $payroll->rd_ot_hours }}" class="form-control">
                                </div>
                                <div class="col" id="rd_ot_render">
                                    {{ $payroll->rd_ot_amount }}
                                </div>
                                <input type="hidden" name="rd_ot_render" value="{{ $payroll->rd_ot_amount }}"
                                    id="rd_ot_render_hidden">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label" id="total_earnings">TOTAL EARNINGS</label>
                                </div>
                                <div class="col" id="total_earnings_render">
                                    {{ $payroll->total_earnings }}
                                </div>
                                <div class="col">
                                </div>
                                <input type="hidden" name="total_earnings" value="{{ $payroll->total_earnings }}"
                                    id="total_earnings_hidden">
                            </div>
                        </div>

                        {{-- TOTAL EARNINGS --}}
                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                </div>
                                <div class="col">
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">PAGIBIG CONTRIBUTION</label>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col" id="pag_ibig_render">
                                    {{ $payroll->pag_ibig }}
                                </div>
                                <input type="hidden" name="pag_ibig_render" value="{{ $payroll->pag_ibig }}"
                                    id="pag_ibig_render_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">PHILHEALTH CONTRIBUTION</label>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col" id="philhealth_render">
                                    {{ $payroll->philhealth }}
                                </div>
                                <input type="hidden" name="philhealth_render" value="{{ $payroll->philhealth }}"
                                    id="philhealth_render_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">SSS CONTRIBUTION</label>
                                </div>
                                <div class="col">
                                </div>
                                <div class="col" id="sss_render">
                                    {{ $payroll->sss }}
                                </div>
                                <input type="hidden" name="sss_render" value="{{ $payroll->sss }}"
                                    id="sss_render_hidden">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">TOTAL DEDUCTIONS</label>
                                </div>
                                <div class="col" id="total_deduction_render">
                                    {{ $payroll->total_deductions }}
                                </div>
                                <div class="col">
                                </div>
                                <input type="hidden" name="total_deductions" value="{{ $payroll->total_deductions }}"
                                    id="total_deductions_hidden">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-5">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        new TomSelect("#select-employee", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        let rate = 0;

        document.addEventListener('DOMContentLoaded', function() {
            let selectedEmployee = document.getElementById('select-employee').options[document.getElementById(
                'select-employee').selectedIndex];
            let updatedRate = parseFloat(document.getElementById('updated_rate').value) || 0;
            rate = parseFloat(selectedEmployee.getAttribute('data-position-rate')) || updatedRate;

            recalculateTotal();
        });


        // Display the Job Position of selected Employee
        document.getElementById('select-employee').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let position = selectedOption.getAttribute('data-position') || '';
            let positionContainer = document.getElementById('position-container');
            let positionContainer2 = document.getElementById('position-container2');
            let positionField = document.getElementById('text');

            positionField.value = position;
        });


        // Function to recalculate total salary
        function recalculateTotal() {
            let basicSalary = parseFloat(document.getElementById('basic_salary_render').textContent) || 0;
            let regOtSalary = parseFloat(document.getElementById('reg_ot_render').textContent) || 0;
            let rdOtSalary = parseFloat(document.getElementById('rd_ot_render').textContent) || 0;

            let totalEarnings = basicSalary + regOtSalary + rdOtSalary;
            let totalDeductions = totalEarnings - 1350 - 750 - 100;

            document.getElementById('total_earnings_render').textContent = totalDeductions.toFixed(2);
            document.getElementById('pag_ibig_render').textContent = 100;
            document.getElementById('sss_render').textContent = 1350;
            document.getElementById('philhealth_render').textContent = 750;
            document.getElementById('total_deduction_render').textContent = 2200;

            // Update hidden fields for form submission
            document.getElementById('total_earnings_hidden').value = totalDeductions.toFixed(2);
            document.getElementById('sss_render_hidden').value = 1350;
            document.getElementById('philhealth_render_hidden').value = 750;
            document.getElementById('pag_ibig_render_hidden').value = 100;
            document.getElementById('total_deductions_hidden').value = 2200;
        }

        // Employee Selection (Updates Rate)
        document.getElementById('select-employee').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            rate = parseFloat(selectedOption.getAttribute('data-position-rate')) || 0;
        });

        // Basic Salary Calculation
        document.getElementById('basic_salary').addEventListener('input', function() {
            let hoursWorked = parseFloat(this.value) || 0;
            let totalAmount = hoursWorked * rate;
            document.getElementById('basic_salary_render').textContent = totalAmount.toFixed(2);
            document.getElementById('basic_salary_hidden').value = totalAmount.toFixed(2);
            recalculateTotal();
        });

        // Regular Overtime Calculation
        document.getElementById('reg_ot').addEventListener('input', function() {
            let regularOvertimeHoursWorked = parseFloat(this.value) || 0;
            let totalAmount = rate * 1.25 * regularOvertimeHoursWorked;
            document.getElementById('reg_ot_render').textContent = totalAmount.toFixed(2);
            document.getElementById('reg_ot_render_hidden').value = totalAmount.toFixed(2);
            recalculateTotal();
        });

        // Rest Day Overtime Calculation
        document.getElementById('rd_ot').addEventListener('input', function() {
            let restDayOvertimeHoursWorked = parseFloat(this.value) || 0;
            let totalAmount = rate * 1.5 * restDayOvertimeHoursWorked;
            document.getElementById('rd_ot_render').textContent = totalAmount.toFixed(2);
            document.getElementById('rd_ot_render_hidden').value = totalAmount.toFixed(2);
            recalculateTotal();
        });
    </script>
@endsection
