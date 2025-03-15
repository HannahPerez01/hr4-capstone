<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

@extends('layouts/layoutMaster')
@section('title', 'COMPENSATION')
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
    <div class="">
        <div class="card">
            <div class="pt-5 px-5">
                <button class="btn btn-dark btn-sm" onclick="location.href = '{{ route('compensation') }}'">Back</button>
                <button class="btn btn-primary btn-sm" onclick="location.href = '{{ route('payroll-create') }}'">Create Payroll</button>
            </div>

            <div class="card-datatable">
                <div class="p-5">
                    <form action="{{ route('compensation-store') }}" method="POST" class="row">
                        @csrf
                        @method('POST')

                        <div class="col-md-6">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-select" required>
                                <option value="" disabled selected>Select Employee</option>
                                @foreach ($employees as $employee)
                                    @foreach ($employee->payrolls as $payroll)
                                        <option value="{{ $employee->id }}"
                                            data-payroll="{{ $payroll->basic_salary_amount }}">
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>

                            @if ($errors->has('employee_id'))
                                <div class="text-danger">
                                    {{ $errors->first('employee_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Salary Details</label>
                            <input type="text" name="basic_salary_amount" id="basic_salary_amount" class="form-control"
                                value="{{ old('basic_salary_amount') }}" value="{{ $employee }}" required readonly>

                            @if ($errors->has('basic_salary_amount'))
                                <div class="text-danger">
                                    {{ $errors->first('basic_salary_amount') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Duration</label>
                            <input type="date" name="date_hired" id="date_hired" class="form-control"
                                value="{{ old('date_hired') }}" required disabled>

                            @if ($errors->has('date_hired'))
                                <div class="text-danger">
                                    {{ $errors->first('date_hired') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="transaction" class="form-label">Transaction</label>
                            <select name="transaction" id="transaction" class="form-select" required>
                                <option value="" disabled selected>Select Transaction</option>
                                @foreach ($transactionTypeEnums as $transactionTypeEnum)
                                    <option value="{{ $transactionTypeEnum }}">{{ $transactionTypeEnum }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('transaction'))
                                <div class="text-danger">
                                    {{ $errors->first('transaction') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="" disabled selected>Select Status</option>
                                @foreach ($statusEnums as $statusEnum)
                                    <option value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('status'))
                                <div class="text-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('employee_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let payroll = selectedOption.getAttribute('data-payroll') || '';
            let payrollField = document.getElementById('basic_salary_amount');

            payrollField.value = payroll;
        });
    </script>
@endsection
