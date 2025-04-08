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
                            @endphp
                            <tr>
                                <td>{{ $succession->employee->employee_code }}</td>
                                <td>{{ $succession->employee->name }}</td>
                                <td>{{ $succession->current_position }}</td>
                                <td>{{ $succession->department }}</td>
                                <td class="badge rounded {{ $status }}">{{ $succession->status }}</td>
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
