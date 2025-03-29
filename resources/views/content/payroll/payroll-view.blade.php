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

            @php
                $from = Carbon\Carbon::parse($payroll->from);
                $to = Carbon\Carbon::parse($payroll->to);
                $dateHired = Carbon\Carbon::parse($payroll->employee->date_hired);
                $fromText = $from->format('F d, Y');
                $toText = $to->format('F d, Y');
                $dateHiredText = $dateHired->format('F d, Y');
                $total_earnings_without_deductions = $payroll->basic_salary_amount + $payroll->reg_ot_amount + $payroll->rd_ot_amount;
            @endphp

            <div class="p-5">
                <div class="border p-5 rounded">
                    <h3>Company Name: XYZ Trading</h3>
                    <p>Email: sample@gmail.com</p>
                    <p>Pay Period: {{ $fromText }} - {{ $toText }}</p>
                    <p>Payslip No.: {{ $payroll->code }}</p>
                </div>

                <div class="border mt-2 p-5 rounded">
                    <h3>Employee Name: {{ $payroll->employee->name }}</h3>
                    <p>Employee ID: {{ $payroll->employee->employee_code }}</p>
                    <p>Position: {{ $payroll->employee->jobPosition->title }}</p>
                    <p>Department: {{ $payroll->employee->department }}</p>
                    <p>Date of Joining: {{ $dateHiredText }}</p>
                </div>

                <div class="table-responsive border mt-2 p-5">
                    <h3>Earnings</h3>
                    <table class="table table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white">Description</th>
                                <th class="text-white">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic Salary</td>
                                <td>{{ $payroll->basic_salary_amount }}</td>
                            </tr>
                            <tr>
                                <td>Regular Overtime Pay</td>
                                <td>{{ $payroll->reg_ot_amount }}</td>
                            </tr>
                            <tr>
                                <td>Rest Day Overtime Pay</td>
                                <td>{{ $payroll->rd_ot_amount ?? 0 }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><strong>Total Earnings</strong></th>
                                <th><strong>{{ $total_earnings_without_deductions }}</strong></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="table-responsive border mt-2 p-5">
                    <h3>Deductions</h3>
                    <table class="table table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white">Description</th>
                                <th class="text-white">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SSS Contribution</td>
                                <td>{{ $payroll->sss }}</td>
                            </tr>
                            <tr>
                                <td>PhilHealth</td>
                                <td>{{ $payroll->philhealth }}</td>
                            </tr>
                            <tr>
                                <td>Pag-IBIG</td>
                                <td>{{ $payroll->pag_ibig }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><strong>Total Deductions</strong></th>
                                <th><strong>{{ $payroll->total_deductions }}</strong></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-2 p-5">
                    <h3>Net Salary (Take-Home Pay)</h3>
                    <h5>PHP {{ $payroll->total_earnings }}</h5>
                </div>

                <div class="border rounded mt-2 p-5">
                    <h3>AI Analysis and Salary Error Detection (if any)</h3>

                    <div>{!! $payroll->response !!}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
