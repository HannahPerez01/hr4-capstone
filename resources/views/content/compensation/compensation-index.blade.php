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
    <div class="container">
        <div class="card">
            <div>
                <button type="button" class="btn btn-primary m-3"
                    onclick="location.href = '{{ route('compensation-create') }}'">Add Compensation</button>
            </div>

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
                            <th>Salary Details</th>
                            <th>Duration</th>
                            <th>Transaction</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compensations as $compensation)
                            <tr>
                                <td>{{ $compensation->employee->employee_code }}</td>
                                <td>{{ $compensation->employee->name }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $compensation->transaction_type }}</td>
                                <td>{{ $compensation->status }}</td>
                                <td class="d-flex gap-2">
                                    <button type="button" class="btn btn-success btn-sm" onclick="location.href = '{{ route('compensation-edit', ['id' => $compensation->id]) }}'">Update</button>
                                    <button class="btn btn-danger btn-flat btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    // DataTable
    $(document).ready(function () {
        new DataTable('#dataTable'); // Use the correct ID
    });

</script>
