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
                <button class="btn btn-dark btn-sm"
                    onclick="location.href = '{{ route('employee-profile') }}'">Back</button>
            </div>
            <div class="card-datatable">
                <div class="p-5">
                    <form action="{{ route('employee-profile-update', ['id' => $employee->employee_id]) }}" method="POST"
                        class="row">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <label for="" class="form-label">Employee Name</label>
                            <input type="text" name="employee_name" id="employee_name" class="form-control"
                                value="{{ $employee->employee_name ?? old('employee_name') }}" required>

                            @if ($errors->has('employee_name'))
                                <div class="text-danger">
                                    {{ $errors->first('employee_name') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="{{ $employee->gender }}">
                                    {{ $employee->gender }}
                                </option>
                                @foreach ($genderEnums as $gender)
                                    <option value="{{ $gender }}">{{ $gender }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('gender'))
                                <div class="text-danger">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Department</label>
                            <select name="department" id="department" class="form-select" required>
                                <option value="{{ $employee->department }}">
                                    {{ $employee->department }}
                                </option>
                                @foreach ($departmentEnums as $department)
                                    <option value="{{ $department }}">{{ $department }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('department'))
                                <div class="text-danger">
                                    {{ $errors->first('department') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Job Position</label>
                            <select name="job_position_id" id="job_position_id" class="form-select" required>
                                <option value="{{ $employee->job_position_id }}">
                                    {{ $employee->jobPosition->title }}
                                </option>
                                @foreach ($jobPositions as $jobPosition)
                                    <option value="{{ $jobPosition->id }}">{{ $jobPosition->title }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('job_position_id'))
                                <div class="text-danger">
                                    {{ $errors->first('job_position_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Employment Type</label>
                            <select name="employment_type" id="employment_type" class="form-select" required>
                                <option value="{{ $employee->employment_type }}">
                                    {{ $employee->employment_type }}
                                </option>
                                @foreach ($employmentTypeEnums as $employmentType)
                                    <option value="{{ $employmentType }}">{{ $employmentType }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('employment_type'))
                                <div class="text-danger">
                                    {{ $errors->first('employment_type') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Date Hired</label>
                            <input type="date" name="date_hired" id="date_hired" class="form-control"
                                value="{{ $employee->date_hired ?? old('date_hired') }}" required>

                            @if ($errors->has('date_hired'))
                                <div class="text-danger">
                                    {{ $errors->first('date_hired') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="{{ $employee->status }}">
                                    {{ $employee->status }}
                                </option>
                                @foreach ($employeeStatusEnums as $employmentStatus)
                                    <option value="{{ $employmentStatus }}">{{ $employmentStatus }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('status'))
                                <div class="text-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>

                        <div class="mt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
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
