@extends('layouts/layoutMaster')

@section('title', 'Fullcalendar - Apps')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/fullcalendar/fullcalendar.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/select2/select2.scss',
    'resources/assets/vendor/libs/quill/editor.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  ])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/app-calendar.scss'])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/fullcalendar/fullcalendar.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/moment/moment.js',
  ])
@endsection

@section('page-script')
  @vite([
    'resources/assets/js/app-calendar-events.js',
    'resources/assets/js/app-calendar.js',
  ])
@endsection

@section('content')
  


  <div class="">
    <div class="card">

  

      <div class="card-datatable table-responsive">


        <form  action="{{route('claims.update', ['id' => $claim->id])}}" id="formAuthentication" class="mb-3" method="POST">
          @method('PUT')
      @csrf
    <div class="card-content">
      <div class="card-header">
        <h5 class="card-title">CLAIMS AND REIMBURSEMENT INFO UPDATE</h5>
 
      </div>
      <div class="card-body">
        <label>EMPLOYEE ID</label>
   <div class="form-group">
     <input value="{{ $claim->employee_id }}" type="text" name="employee_id" class="form-control">
   </div>
          <label>EMPLOYEE NAME</label>
   <div class="form-group">
     <input value="{{ $claim->employee_name }}" type="text" name="employee_name" class="form-control">
   </div>


          <label>CLAIM DATE</label>
   <div class="form-group">
     <input value="{{ $claim->claim_date }}" type="date" name="claim_date" class="form-control">
   </div>


          <label>CLAIM TYPE</label>
   <div class="form-group">
     <input value="{{ $claim->claim_type }}" type="text" name="employee_type" class="form-control">
   </div>

       <label>AMOUNT</label>
   <div class="form-group">
     <input value="{{ $claim->amount }}" type="number" name="amount" class="form-control">
   </div>




      </div>
      <div class="modal-footer">
        <button type="SUBMIT" class="btn btn-primary">Save changes</button>
      </div>
    </div>

    <!-- @END -->
  </form>

      </div>
    </div>
  </div> 
  

@endsection

<script type="text/javascript">
 
</script>




