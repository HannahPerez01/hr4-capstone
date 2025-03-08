<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@extends('layouts/layoutMaster')

@section('title', 'CLAIMS AND REIMBERSMENT')

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
    <div style="display:flex;">
     <button class="btn  btn-primary btn-sm btn-flat m-3 " style="font-size:15px;width:13%;height:38px;"  data-bs-toggle="modal" data-bs-target="#smallModal"><i class="fas fa-plus-square"></i>Insert Info</button>

     <form class=" mt-3 ml-3 mw-100 navbar-search"  style="margin-left:7px" autocomplete="off">
      <div class="input-group">
        <input type="text"  id="myInput" onkeyup="myFunction()" class="form-control bg-light border-1 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" >
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
         <th>Employee Id</th>
         <th>Employee Name</th>
         <th>Claim Date</th>
         <th>Claim Type</th>
         <th>Amount</th>
         <th>Status</th>
       </tr>
     </thead>
     <tbody>
      @foreach($claims as $claim)
      <tr class="contents">
        <td>{{ $claim->employee_id }}</td>
        <td class="titles">{{ $claim->employee_name }}</td>
        <td>{{ $claim->claim_date }}</td>
        <td>{{ $claim->claim_type }}</td>
        <td>{{ $claim->amount }}</td>
        <td style="display:flex;">
          <button class="btn btn-primary" style="height:38px;"><a href="{{ route('claims.edit', ['id' => $claim->id]) }}" style="color:white;"> Edit </a></button>


          <form method="POST" action="{{ route('claims.delete', ['id' => $claim->id]) }}" >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>


        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="smallModal">
  <div class="modal-dialog" role="document">
    <form  action="{{url('/claims')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">CLAIMS AND REIMBURSEMENT INFO</h5>

        </div>
        <div class="modal-body">
          <label>EMPLOYEE ID</label>
          <div class="form-group">
           <input type="text" name="employee_id" class="form-control">
         </div>
         <label>EMPLOYEE NAME</label>
         <div class="form-group">
           <input type="text" name="employee_name" class="form-control">
         </div>

         <label>CLAIM DATE</label>
         <div class="form-group">
           <input type="date" name="claim_date" class="form-control">
         </div>


         <label>CLAIM TYPE</label>
         <div class="form-group">
 <select name="employee_type" class="form-control">
   <option class="form-control">Travel Expenses</option>

 </select>

          </div>

         <label>AMOUNT</label>
         <div class="form-group">
           <input type="number" name="amount" class="form-control">
         </div>




       </div>
       <div class="modal-footer">
        <button type="SUBMIT" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-danger" id="modal_close">Close</button>
      </div>
    </div>
  </form>
</div>
</div>

@endsection


<script >
  $(document).on('click', '#modal_close', function () {
    $('#smallModal').hide();

  });

</script>






<script type="text/javascript">


  $(document).ready(function(){





    $('#myInput').keyup(function(){
// Search text
      var text = $(this).val();
// Hide all content class element
      $('.contents').hide();

// Search 
      $('.contents .titles:contains("'+text+'")').closest('.contents').show();
    });

  });

</script>




