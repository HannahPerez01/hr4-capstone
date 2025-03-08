


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@extends('layouts/layoutMaster')

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
      <button class="btn  btn-primary btn-sm btn-flat mt-3 " style="margin-left:7px;font-size:15px;width:13%;height:38px;"  data-bs-toggle="modal" data-bs-target="#smallModal"><i class="fas fa-plus-square"></i>Insert Info</button>

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
           <th>Date Request</th>
           <th>Employee Id</th>
           <th>Employee Name</th>
           <th>Leave Type</th>
           <th>Start Date</th>
           <th>End Date</th>
           <th>Status</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
        @foreach($Leaves as $claim)
        <tr class="contents">
         <td>{{ $claim->date_request}}</td>
          <td>{{ $claim->id }}</td>
          <td  class="titles">{{ $claim->employee_name }}</td>
             <td>{{ $claim->leave_type }}</td>
          <td>{{ $claim->start_date }}</td>
          <td>{{ $claim->end_date }}</td>
          <td>{{ $claim->status }}</td>

          <td style="display:flex;">
            <button class="btn btn-primary" style="height:38px;" id="updatemodal"> Edit</button>


            <form method="POST" action="{{ route('Leave.delete', ['id' => $claim->id]) }}" style="margin-left:4px">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger ml-3">Delete</button>
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
    <form  action="{{url('/Leave')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LEAVE MANAGEMENT</h5>

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
         <label>LEAVE TYPE</label>
         <div class="form-group">
          <select class="form-select" name="leave_type">
           <option>Annaul Leave</option>
           <option>Sick Leave</option>
           <option>Maternity Leave</option>
           <option>Peternity Leave</option>
           <option>Personal Leave</option>
         </select>
       </div>


       <label>START DATE</label>
       <div class="form-group">
         <input type="date" name="start_date" class="form-control">
       </div>

       <label>END DATE</label>
       <div class="form-group">
         <input type="date" name="end_date" class="form-control">
       </div>

       <label style="display:none;">STATUS</label>
       <div class="form-group">
         <input type="text"  value="Pending" name="status" class="form-control" style="display:none;">
       </div>




     </div>
     <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Save</button>
      <a class="btn btn-danger" data-toggle="modal"  id="closemodal" style="color:white;">close</a>
    </div>

  </div>
</form>
</div>
</div>






<div class="modal" tabindex="-2" role="dialog" id="update_date">
  <div class="modal-dialog" role="document">
    <form  action="{{url('/Leaveupdate')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LEAVE MANAGEMENT</h5>

        </div>
        <div class="modal-body">
          <label>EMPLOYEE ID</label>
          <div class="form-group">
           <input type="text"  id="employee_ids" name="employee_id" class="form-control" disabled>
         </div>

              <div class="form-group">
           <input type="text"  id="employee_id" name="employee_id" class="form-control"style="display:none;">
         </div>



         <label>EMPLOYEE NAME</label>
         <div class="form-group">
           <input type="text" id="employee_name_update" name="employee_name_update" class="form-control">
         </div>
         <label>LEAVE TYPE</label>
         <div class="form-group">
          <select class="form-select" id="leave_type_update" name="leave_type_update">
            <option>Annaul Leave</option>
            <option>Sick Leave</option>
            <option>Maternity Leave</option>
            <option>Peternity Leave</option>
            <option>Personal Leave</option>
          </select>
        </div>


        <label>START DATE</label>
        <div class="form-group">
         <input type="date" id="start_date_update" name="start_date_update" class="form-control">
       </div>

       <label>END DATE</label>
       <div class="form-group">
         <input type="date" id="end_date_update"  name="end_date_update" class="form-control">
       </div>
     </div>
     <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Save</button>
      <a class="btn btn-danger" data-toggle="modal"  id="closemodal_update" style="color:white;">close</a>
    </div>

  </div>
</form>
</div>
</div>







<script type="text/javascript">

  $(document).on('click', '#closemodal', function () {
    $('#smallModal').modal('hide');

  });

  $(document).on('click', '#updatemodal', function () {
    $('#update_date').modal('show');
    $('form')[0].reset();
    var tr = $(this).closest("tr").find('td');
    $('#employee_id').val(tr.eq(1).text());
   $('#employee_ids').val(tr.eq(1).text());
    $('#employee_name_update').val(tr.eq(2).text());
    $('#leave_type_update').val(tr.eq(3).text());
    $('#start_date_update').val(tr.eq(4).text());
    $('#end_date_update').val(tr.eq(5).text());
  });


  $(document).on('click', '#closemodal_update', function () {
    $('#update_date').modal('hide');

  });


  $('#myInput').keyup(function(){
// Search text
    var text = $(this).val();
// Hide all content class element
    $('.contents').hide();

// Search 
    $('.contents .titles:contains("'+text+'")').closest('.contents').show();
  });

</script>



@endsection


