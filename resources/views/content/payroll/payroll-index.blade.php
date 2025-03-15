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
                <button type="button" class="btn btn-primary m-3"
                    onclick="location.href = '{{ route('payroll-create') }}'">Add Payroll</button>
            </div>

            @if (session()->has('success'))
                <x-alert successMessage="{{ session('success') }}" />
            @elseif(session()->has('error'))
                <x-alert errorMessage="{{ session('error') }}" />
            @endif

            <div class="card-datatable table-responsive p-5">
                <table class="datatables-projects table border-top" id="dataTable">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Basic Salary Total</th>
                            <th>Regular OT Total</th>
                            <th>Rest Day OT Total</th>
                            <th>Total Deductions</th>
                            <th>Total Earnings</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payrolls as $payroll)
                            <tr>
                                <td>{{ $payroll->employee->employee_code }}</td>
                                <td>{{ $payroll->employee->name }}</td>
                                <td>{{ $payroll->basic_salary_amount }}</td>
                                <td>{{ $payroll->reg_ot_amount }}</td>
                                <td>{{ $payroll->rd_ot_amount }}</td>
                                <td>{{ $payroll->total_deductions }}</td>
                                <td>{{ $payroll->total_earnings }}</td>
                                <td class="d-flex gap-2">
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="location.href = '{{ route('payroll-edit', ['id' => $payroll->id]) }}'">Update</button>
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modal-{{ $payroll->id }}"
                                            data-action="{{ route('payroll-delete', ['id' => $payroll->id]) }}">
                                            Delete
                                        </button>
                                    </div>

                                    {{-- MODAL FOR DELETE CONFIRMATION --}}
                                    <x-confirmation-modal action="{{ route('payroll-delete', ['id' => $payroll->id]) }}"
                                        title="Confirm Deletion" id="{{ $payroll->id }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        // DataTable
        $(document).ready(function() {
            new DataTable('#dataTable'); // Use the correct ID
        });
    </script>
@endsection
