@extends('layouts/layoutMaster')
@section('title', 'Recruitment')
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
                    onclick="location.href = '{{ route('recruitment-create') }}'">Add Request</button>
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
                            <th>JOB ROLES</th>
                            <th>DEPARTMENT</th>
                            <th>STATUS</th>
                            <th>DATE REQUEST</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobRequests as $jobRequest)
                            @php
                                $status = match (strtolower($jobRequest->status)) {
                                    'pending' => 'bg-secondary',
                                    'in progress' => 'bg-warning',
                                    'completed' => 'bg-success',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <tr class="contents">
                                <td>{{ $jobRequest->job_title }}</td>
                                <td>{{ $jobRequest->department }}</td>
                                <td>
                                    <span class="badge rounded {{ $status }}">{{ $jobRequest->status }}</span>
                                </td>
                                <td>{{ $jobRequest->created_at->format('F d, Y H:i A') }}</td>

                                <td class="d-flex gap-2">
                                    @if (strtolower($jobRequest->status) == 'pending')
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="location.href = '{{ route('recruitment-edit', ['id' => $jobRequest->id]) }}'">Update</button>
                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-{{ $jobRequest->id }}"
                                                data-action="{{ route('payroll-delete', ['id' => $jobRequest->id]) }}">
                                                Delete
                                            </button>
                                        </div>

                                        <x-confirmation-modal
                                            action="{{ route('recruitment-delete', ['id' => $jobRequest->id]) }}"
                                            title="Confirm Deletion" id="{{ $jobRequest->id }}" />
                                    @endif
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
