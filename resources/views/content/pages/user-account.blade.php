@extends('layouts/layoutMaster')

@section('title', 'USERS')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/fullcalendar/fullcalendar.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/app-calendar.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/fullcalendar/fullcalendar.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/moment/moment.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/app-calendar-events.js', 'resources/assets/js/app-calendar.js'])
@endsection

@section('content')

    <div class="w-100">
        <div class="card">
            {{-- <div class="px-5 pt-5">
                <button class="btn  btn-primary btn-sm btn-flat" data-bs-toggle="modal" data-bs-target="#smallModal">Add
                    User</button>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            @if (strtolower(auth()->user()->role) !== 'hr_coordinator')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->created_at }}</td>
                                @if (strtolower(auth()->user()->role) !== 'hr_coordinator')
                                    <td class="d-flex gap-2">
                                        <div>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="location.href = '{{ route('user.edit', ['id' => $user->id]) }}'">Update</button>
                                        </div>

                                        <div>
                                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                                data-action="{{ route('user.delete', ['id' => $user->id]) }}">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL FOR CREATE --}}
    <div class="modal" tabindex="-1" role="dialog" id="smallModal">
        <div class="modal-dialog" role="document">
            <form action="{{ route('user.store') }}" id="formAuthentication" class="mb-3" method="POST">
                @method('POST')
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD ACCOUNT</h5>

                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mt-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option value="" selected disabled>Select an option</option>
                                @foreach ($roleEnums as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="SUBMIT" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        // DataTable
        $(document).ready(function() {
            new DataTable('#dataTable'); // Use the correct ID
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    let actionUrl = this.getAttribute('data-action');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to delete this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Yes, delete it!",
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            let form = document.createElement('form');
                            form.method = 'POST';
                            form.action = actionUrl;
                            form.innerHTML = `
                            @csrf
                            @method('DELETE')
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
