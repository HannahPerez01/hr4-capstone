@extends('layouts.layoutMaster')

@section('title', 'Leave Management')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/jkanban/jkanban.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/quill/typography.scss',
    'resources/assets/vendor/libs/quill/katex.scss',
    'resources/assets/vendor/libs/quill/editor.scss'
])
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/app-kanban.scss')
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/jkanban/jkanban.js',
    'resources/assets/vendor/libs/quill/katex.js',
    'resources/assets/vendor/libs/quill/quill.js'
])
@endsection

@section('page-script')
@vite('resources/assets/js/app-kanban.js')
@endsection

@section('content')
<div class="">
    <div class="card">
        <div style="display:flex;">
            <form class="mt-3 ml-3 mw-100 navbar-search" style="margin-left:7px" autocomplete="off">
                <div class="input-group">
                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control bg-light border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" style="height:40px;">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-projects table border-top">
                <thead>
                    <tr>
                        <th>Date Request</th>
                        <th>Employee Id</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leave as $leave)
                    <tr>
                        <td>{{ $leave->date_request }}</td>
                        <td>{{ $leave->employee_id }}</td>
                        <td>{{ $leave->employee_name }}</td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function myFunction() {
        // Search text
        var text = $('#myInput').val().toLowerCase();
        // Hide all rows initially
        $('tbody tr').hide();
        // Show rows that match the search query
        $('tbody tr').filter(function() {
            return $(this).text().toLowerCase().indexOf(text) > -1;
        }).show();
    }
</script>
@endsection
