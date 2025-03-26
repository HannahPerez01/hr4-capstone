@extends('layouts/layoutMaster')

@section('title', 'PERFORMANCE TRACKING')

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
                {{-- <button class="btn btn-dark btn-sm" onclick="location.href = '{{ route('employee-profile') }}'">Back</button> --}}
            </div>
            <div class="card-datatable table-responsive p-5">
                <table class="datatables-projects table border-top" id="dataTable">
                    <thead>
                        <tr>
                            <th>EMPLOYEE ID</th>
                            <th>EMPLOYEE NAME</th>
                            <th>JOB POSITION</th>
                            <th>DEPARTMENT</th>
                            <th>PERFORMANCE REVIEW</th>
                            <th>SUCCESSIONs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($performances as $performance)
                            @php
                                $status = match (strtolower($performance->performance_review)) {
                                    'unsatisfactory' => 'bg-danger text-white',
                                    'needs improvement' => 'bg-danger-subtle text-black',
                                    'meets expectations' => 'bg-info text-white',
                                    'exceeds expectations' => 'bg-warning text-white',
                                    'outstanding' => 'bg-success text-white',
                                    default => 'bg-default',
                                };
                            @endphp
                            <tr>
                                <td>{{ $performance->employee->employee_code }}</td>
                                <td>{{ $performance->employee->name }}</td>
                                <td>{{ $performance->jobPosition->title }}</td>
                                <td>{{ $performance->department }}</td>
                                <td class="p-2">
                                    <span
                                        class="badge rounded {{ $status }}">{{ $performance->performance_review }}</span>
                                </td>
                                <td></td>
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
