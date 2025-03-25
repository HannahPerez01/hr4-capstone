<?php use Carbon\Carbon; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

@extends('layouts/layoutMaster')

@section('title', 'EMPLOYEE PROFILE')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/jkanban/jkanban.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('page-style')

    @vite('resources/assets/vendor/scss/pages/app-kanban.scss')
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/jkanban/jkanban.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')
    @vite('resources/assets/js/app-kanban.js')
@endsection

@section('content')

    <div class="">
        <div class="card">
            <div class="card-datatable table-responsive p-5">
                @if (session()->has('success'))
                    <x-alert successMessage="{{ session('success') }}" />
                @elseif(session()->has('error'))
                    <x-alert errorMessage="{{ session('error') }}" />
                @endif

                <table id="dataTable" class="datatables-projects table border-top">
                    <thead>
                        <tr>
                            <th>EMPLOYEE ID</th>
                            <th>EMPLOYEE NAME</th>
                            <th>GENDER</th>
                            <th>CIVIL STATUS</th>
                            <th>AGE</th>
                            <th>EMAIL</th>
                            <th>PRESENT ADDRESS</th>
                            <th>JOB POSITION</th>
                            <th>DEPARTMENT</th>
                            <th>EMPLOYMENT TYPE</th>
                            <th>DATE OF HIRE</th>
                            <th>STATUS</th>
                            @if (auth()->user()->role !== 'hr_coordinator')
                                <th>ACTION</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                @php
                                    $dateHired = Carbon::parse($employee->date_hired);
                                    $status = $dateHired->greaterThanOrEqualTo(Carbon::now()->subMonths(6))
                                        ? 'Newly Hired'
                                        : 'Old Hired';
                                    $dateFormatted = $dateHired->format('F d, Y');
                                @endphp
                                <td>{{ $employee->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->civil_status }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->present_address }}</td>
                                <td>{{ $employee->jobPosition->title }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->employment_type }}</td>
                                <td class="d-flex flex-column">
                                    <div class="mb-3">
                                        {{ $dateFormatted }}
                                    </div>

                                    <div class="mb-3">
                                        <span
                                            class="badge rounded {{ $status == 'Newly Hired' ? 'bg-warning' : 'bg-secondary' }}">
                                            {{ $status }}
                                        </span>
                                    </div>
                                </td>

                                <td>{{ $employee->status }}</td>
                                @if (auth()->user()->role !== 'hr_coordinator')
                                    <td class="d-flex gap-2">
                                        <!-- Add action buttons or links here -->
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="location.href = '{{ route('employee-profile-view', ['id' => $employee->id]) }}'">View</button>
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="location.href = '{{ route('employee-profile-edit', ['id' => $employee->id]) }}'">Edit</button>
                                    </td>
                                @endif
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
        $(document).ready(function() {
            new DataTable('#dataTable'); // Use the correct ID
        });
    </script>
@endsection
