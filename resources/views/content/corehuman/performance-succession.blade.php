@extends('layouts/layoutMaster')

@section('title', 'PERFORMANCE - SUCCESSION')

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
                <form action="{{ route('performance-succession-request') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-dark btn-sm" type="submit">Request to HR2</button>
                </form>
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
                            <th>EMPLOYEE ID</th>
                            <th>EMPLOYEE NAME</th>
                            <th>CURRENT POSITION</th>
                            <th>DEPARTMENT</th>
                            <th>STATUS</th>
                            <th>PROMOTE STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($successions as $succession)
                            @php
                                $status = match (strtolower($succession->status)) {
                                    'active' => 'bg-success text-white',
                                    'in progress' => 'bg-warning text-white',
                                    'ready now' => 'bg-info text-white',
                                    'not ready' => 'bg-secondary text-white',
                                    default => 'bg-default',
                                };
                                $promoted_status = match (strtolower($succession->promoted_status)) {
                                    'promoted' => 'bg-success text-white',
                                    'rejected' => 'bg-danger text-white',
                                    'pending' => 'bg-secondary text-white',
                                    default => 'bg-default',
                                };
                            @endphp
                            <tr>
                                <td>{{ $succession->employee->employee_code }}</td>
                                <td>{{ $succession->employee->name }}</td>
                                <td>{{ $succession->current_position }}</td>
                                <td>{{ $succession->department }}</td>
                                <td>
                                    <span class="badge rounded {{ $status }}">{{ $succession->status }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge rounded {{ $promoted_status }}">{{ $succession->promoted_status }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm promote-button"
                                        data-action="{{ route('succession-promote', ['id' => $succession->id]) }}"
                                        data-name="{{ $succession->employee->name }}"
                                        @if ($succession->promoted_status != 'Pending') disabled @endif>
                                        Promote</button>
                                    <button type="button" class="btn btn-danger btn-sm reject-button"
                                        data-action="{{ route('succession-reject', ['id' => $succession->id]) }}"
                                        data-name="{{ $succession->employee->name }}"
                                        @if ($succession->promoted_status != 'Pending') disabled @endif>Reject</button>
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
        $(document).ready(function() {
            new DataTable('#dataTable'); // Use the correct ID
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.promote-button').forEach(button => {
                button.addEventListener('click', function() {
                    let actionUrl = this.getAttribute('data-action');
                    let name = this.getAttribute('data-name');

                    Swal.fire({
                        title: "Are you sure you want to promote " + name + "?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Yes, proceed!",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            let form = document.createElement('form');
                            form.method = 'POST';
                            form.action = actionUrl;
                            form.innerHTML = `
                            @csrf
                            @method('PUT')
                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.reject-button').forEach(button => {
                button.addEventListener('click', function() {
                    let actionUrl = this.getAttribute('data-action');
                    let name = this.getAttribute('data-name');

                    Swal.fire({
                        title: "Are you sure you want to reject " + name + "?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Yes, proceed!",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            let form = document.createElement('form');
                            form.method = 'POST';
                            form.action = actionUrl;
                            form.innerHTML = `
                            @csrf
                            @method('PUT')
                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
