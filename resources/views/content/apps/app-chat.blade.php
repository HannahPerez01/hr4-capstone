@extends('layouts/layoutMaster')
@section('title', 'TIMESHEET MANAGEMENT')
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
  <div class="">
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-projects table border-top">
          <thead>
    <tr>
         <th>Control No</th>
         <th>Employee ID</th>
         <th>Employee Name</th>
         <th>Basic Salary</th>
         <th>Hourly Rate</th>
         <th>Reg OT</th>
         <th>RD OT</th>
         <th>Pagibig Contribution</th>
         <th>Philhealth Contribution</th>
         <th>SSS Contribution</th>
         <th>TOTAL</th>
          <th>Action</th>


       </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

@endsection
