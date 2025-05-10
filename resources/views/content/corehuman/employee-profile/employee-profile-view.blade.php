<?php use Carbon\Carbon; ?>

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
            <div class="d-flex justify-content-between pt-5 px-5">
                <button class="btn btn-dark btn-sm"
                    onclick="location.href = '{{ route('employee-profile') }}'">Back</button>

                @if ($employee->status == 'Terminated')
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#attachFileModal">Attach
                        File</button>
                @endif
            </div>

            @if (session()->has('success'))
                <x-alert successMessage="{{ session('success') }}" />
            @elseif(session()->has('error'))
                <x-alert errorMessage="{{ session('error') }}" />
            @endif

            <div class="card-datatable p-5">
                @error('file')
                    <div class="text-danger text-sm mt-1">{{ $message }}</div>
                @enderror
                @php
                    $dateHired = Carbon::parse($employee->date_hired);
                    $status = $dateHired->greaterThanOrEqualTo(Carbon::now()->subMonths(6))
                        ? 'Newly Hired'
                        : 'Old Hired';
                    $dateFormatted = $dateHired->format('F d, Y');
                @endphp
                <h1>{{ $employee->name }}</h1>
                <h5>Job Position: {{ $employee->jobPosition->title }}</h5>

                <p>Gender: {{ $employee->gender }}</p>
                <p>Civil Status: {{ $employee->civil_status }}</p>
                <p>Age: {{ $employee->age }}</p>
                <p>Email: {{ $employee->email }}</p>
                <p>Present Address: {{ $employee->present_address }}</p>
                <p>Department: {{ $employee->department }}</p>
                <p>Employment Type: {{ $employee->employment_type }}</p>
                <p>Date Hired: {{ $dateFormatted }} - <span
                        class="badge rounded {{ $status == 'Newly Hired' ? 'bg-warning' : 'bg-secondary' }}">{{ $status }}</span>
                </p>
                <p>Status: {{ $employee->status }}</p>

                @if ($employee->hasMedia('employee_profile_attachments'))
                    <div class="border p-2">
                        <p>Attachments:</p>
                        @foreach ($employee->getMedia('employee_profile_attachments') as $attachment)
                            <a href="{{ $attachment->getUrl() }}" target="_blank">{{ $attachment->file_name }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="attachFileModal" tabindex="-1" aria-labelledby="attachFileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attachFileModalLabel">Attach File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee-profile.attach-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">Attach</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection