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
                <form action="{{ route('payroll-store') }}" method="POST" class="form-group row">
                    @method('POST')
                    @csrf

                    <div class="col-md-12">
                        <label for="" class="form-label">Employee</label>
                        <select id="select-employee" name="employee_id" placeholder="Select an option" class="w-50"
                            autocomplete="off">
                            <option value="">Select an options</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" data-position="{{ $employee->jobPosition->title }}"
                                    data-position-rate="{{ $employee->jobPosition->hourly_rate }}">
                                    {{ $employee->employee_code }} - {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3" id="position-container" style="display: none;">
                        <label for="" class="form-label">Position:</label>
                        <input type="text" id="text" class="form-control w-50" value="" readonly />
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control w-50" />
                    </div>

                    <div class="w-100" id="position-container2" style="display: none;">
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
                                    <input type="number" name="basic_salary" id="basic_salary" class="form-control">
                                </div>
                                <div class="col" id="basic_salary_render">
                                    0.00
                                </div>
                                <input type="hidden" name="basic_salary_render" id="basic_salary_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">Reg OT</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="reg_ot" id="reg_ot" class="form-control">
                                </div>
                                <div class="col" id="reg_ot_render">
                                    0.00
                                </div>
                                <input type="hidden" name="reg_ot_render" id="reg_ot_render_hidden">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">RD OT</label>
                                </div>
                                <div class="col">
                                    <input type="number" name="rd_ot" id="rd_ot" class="form-control">
                                </div>
                                <div class="col" id="rd_ot_render">
                                    0.00
                                </div>
                                <input type="hidden" name="rd_ot_render" id="rd_ot_render_hidden">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label" id="total_earnings">TOTAL EARNINGS</label>
                                </div>
                                <div class="col" id="total_earnings_render">
                                    0.00
                                </div>
                                <div class="col">
                                </div>
                                <input type="hidden" name="total_earnings" id="total_earnings_hidden">
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
                                    0.00
                                </div>
                                <input type="hidden" name="pag_ibig_render" id="pag_ibig_render_hidden">
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
                                    0.00
                                </div>
                                <input type="hidden" name="philhealth_render" id="philhealth_render_hidden">
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
                                    0.00
                                </div>
                                <input type="hidden" name="sss_render" id="sss_render_hidden">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="row w-50">
                                <div class="col">
                                    <label for="" class="form-label">TOTAL DEDUCTIONS</label>
                                </div>
                                <div class="col" id="total_deduction_render">
                                    0.00
                                </div>
                                <div class="col">
                                </div>
                                <input type="hidden" name="total_deductions" id="total_deductions_hidden">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
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

        // Display the Job Position of selected Employee
        document.getElementById('select-employee').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let position = selectedOption.getAttribute('data-position') || '';
            let positionContainer = document.getElementById('position-container');
            let positionContainer2 = document.getElementById('position-container2');
            let positionField = document.getElementById('text');

            positionField.value = position;
            if (positionField.value) {
                positionContainer.style.display = 'block';
                positionContainer2.style.display = 'block';
            } else {
                positionContainer.style.display = 'none';
                positionContainer2.style.display = 'none';
            }
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
