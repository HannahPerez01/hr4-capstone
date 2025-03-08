<?php use Carbon\Carbon; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
            <div class="pt-5 px-5">
                <button class="btn btn-dark btn-sm" onclick="location.href = '{{ route('employee-profile') }}'">Back</button>
            </div>
            <div class="card-datatable p-5">
                @php
                    $dateHired = Carbon::parse($employee->date_hired);
                    $status = $dateHired->greaterThanOrEqualTo(Carbon::now()->subMonths(6))
                        ? 'Newly Hired'
                        : 'Old Hired';
                    $dateFormatted = $dateHired->format('F d, Y');
                @endphp
                <h1>{{ $employee->employee_name }}</h1>
                <h5>Job Position: {{ $employee->jobPosition->title }}</h5>

                <p>Gender: {{ $employee->gender }}</p>
                <p>Department: {{ $employee->department }}</p>
                <p>Employment Type: {{ $employee->employment_type }}</p>
                <p>Date Hired: {{ $dateFormatted }} - <span class="badge rounded {{ $status == 'Newly Hired' ? 'bg-warning' : 'bg-secondary' }}">{{ $status }}</span></p>
                <p>Status: {{ $employee->status }}</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datat ables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            new DataTable('#dataTable'); // Use the correct ID
        });
    </script>
@endsection
