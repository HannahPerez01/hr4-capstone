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
                            <th>Action</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach ($deduction as $claim)
                            <tr class="contents">
                                <td style="display:none;">{{ $claim->deduction_id }}</td>
                                <td>{{ $claim->employee_id }}</td>
                                <td>{{ $claim->pagibig}}</td>
                                <td>{{ $claim->philhealth}}</td>
                                <td>{{ $claim->sss}}</td>
                                <td>{{ $claim->created_at}}</td>
                                <td><button class=" btn btn-primary btn-sm  btn-flat" id="update_btn">Update</button></td>
                            </tr>
                        @endforeach
                    </tbody> --}}
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
