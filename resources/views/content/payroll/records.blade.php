@extends('layouts/layoutMaster')
@section('title', 'Payroll Records')
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
            <div class="card-datatable table-responsive p-5">
                <table class="datatables-projects table border-top" id="dataTable">
                    <thead>
                        <tr>
                            <th>Control No</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Basic Salary</th>
                            <th>Hourly Rate</th>
                            <th>Regular OT</th>
                            <th>RD OT</th>
                            <th>Pag-ibig Contribution</th>
                            <th>Philhealth Contribution</th>
                            <th>SSS Contribution Salary</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payrolls as $payroll)
                            <tr class="contents">
                                <td>{{ $payroll->code }}</td>
                                <td>{{ $payroll->employee->employee_code }}</td>
                                <td>{{ $payroll->employee->name }}</td>
                                <td>{{ $payroll->basic_salary_amount }}</td>
                                <td>{{ $payroll->basic_salary_hours }}</td>
                                <td>{{ $payroll->reg_ot_amount }}</td>
                                <td>{{ $payroll->rd_ot_amount }}</td>
                                <td>{{ $payroll->pag_ibig }}</td>
                                <td>{{ $payroll->philhealth }}</td>
                                <td>{{ $payroll->sss }}</td>
                                <td>{{ $payroll->total_earnings }}</td>
                                <td>{{ $payroll->status }}</td>
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
            new DataTable('#dataTable');
        });
    </script>
@endsection
