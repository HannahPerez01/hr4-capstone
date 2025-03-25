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
    <div class="container">
        <div class="card">
            {{-- <div>
                <button type="button" class="btn btn-primary m-3"
                    onclick="location.href = '{{ route('compensation-create') }}'">Add Compensation</button>
            </div> --}}

            @if (session()->has('success'))
                <x-alert successMessage="{{ session('success') }}" />
            @elseif(session()->has('error'))
                <x-alert errorMessage="{{ session('error') }}" />
            @endif

            <div class="card-datatable table-responsive p-5">
                <table id="dataTable" class="datatables-projects table border-top">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th class="text-center">Salary Details</th>
                            <th>Duration</th>
                            <th>Transaction</th>
                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                            @php
                                $from = Carbon\Carbon::parse($payroll->from);
                                $to = Carbon\Carbon::parse($payroll->to);
                                $duration = $from->diffInDays($to);
                            @endphp
                            <tr>
                                <td>{{ $payroll->employee->employee_code }}</td>
                                <td>{{ $payroll->employee->name }}</td>
                                <td class="d-flex gap-2 w-100">
                                    <div>
                                        <strong>Total Salary</strong>:
                                        {{ $payroll->total_earnings }}
                                    </div>
                                </td>
                                <td>{{ $duration }} Days</td>
                                <td>{{ $payroll->transaction_type }}</td>
                                <td>{{ $payroll->status }}</td>
                                {{-- <td class="d-flex gap-2">
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="location.href = '{{ route('compensation-edit', ['id' => $compensation->id]) }}'">Update</button>
                                    <button class="btn btn-danger btn-flat btn-sm">Delete</button>
                                </td> --}}
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
