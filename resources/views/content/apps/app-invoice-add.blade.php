
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


@extends('layouts/layoutMaster')

@section('title', 'SHIFT AND SCHEDULINg')

@section('vendor-style')
@vite('resources/assets/vendor/libs/flatpickr/flatpickr.scss')
@endsection


@section('vendor-script')
@vite([
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/jquery-repeater/jquery-repeater.js'
])
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
           <th>Date</th>
           <th>Employee Id</th>
           <th>Shift Start</th>
           <th>Shift end</th>
           <th>Shift type</th>
           <th>Action</th>

         </tr>
       </thead>
       <tbody>
         @foreach($Shift_and_schedule as $claim)
         <tr class="contents">
           <td class="titles">{{ $claim->shift_date }}</td>
          <td class="titles">{{ $claim->employee_id }}</td>
          <td>{{ $claim->shift_start }}</td>
          <td>{{ $claim->shift_end }}</td>
          <td>{{ $claim->shift_type }}</td>
          <td style="display:flex;">
            <button class="btn btn-primary" style="height:38px;" id="updatebutton">Update</button>

            <form method="POST" action="{{ route('Shift_and_schedule.delete', ['id' => $claim->id]) }}"  style="margin-left:2%;">
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
    <form  action="{{url('/Shift_and_schedule')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">SHIFT AND SCHEDULING</h5>

        </div>
        <div class="modal-body">
          <label>EMPLOYEE ID</label>
          <div class="form-group">
           <input type="text" name="employee_id" class="form-control">
         </div>
            
                    <label>DATE SHIFT</label>
         <div class="form-group">
           <input type="date" name="date_shift" class="form-control">
         </div>

         <label>SHIFT START</label>
         <div class="form-group">
           <input type="time" name="shift_start" class="form-control">
         </div>

         <label>SHIFT END </label>
         <div class="form-group">
           <input type="time" name="shift_end" class="form-control">
         </div>
         <label>SHIFT TYPE</label>
         <div class="form-group">
          <select class="form-select" name="shift_type">
           <option>Day Shift</option>
           <option>Graveyard Shift</option>
           <option>Night Shift</option>
         </select>
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






<div class="modal" tabindex="-1" role="dialog" id="updateshift">
  <div class="modal-dialog" role="document">
    <form  action="{{url('/Shift_and_schedules')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">UPDATE SHIFT AND SCHEDULING</h5>

        </div>
        <div class="modal-body">
          <label>EMPLOYEE ID</label>
          <div class="form-group">
           <input type="text" id="employee_id_update" name="employee_id_update" class="form-control">
         </div>


         <label>SHIFT START</label>
         <div class="form-group">
           <input type="time" id="shift_start_update" name="shift_start_update" class="form-control">
         </div>

         <label>SHIFT END </label>
         <div class="form-group">
           <input type="time" id="shift_end_update" name="shift_end_update" class="form-control">
         </div>


         <label>SHIFT TYPE</label>
         <div class="form-group">
          <select class="form-select"  id="shift_type_update" name="shift_type_update">
           <option>Day Shift</option>
         </select>
       </div>
     </div>
     <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Save</button>
      <a class="btn btn-danger" data-toggle="modal"  id="closemodalupdate" style="color:white;">close</a>
    </div>
  </div>
</form>
</div>
</div>




<script type="text/javascript">

  $(document).on('click', '#closemodal', function () {
    $('#smallModal').modal('hide');

  });

  $(document).on('click', '#updatebutton', function () {
    $('#updateshift').modal('show');
    $('form')[0].reset();
    var tr = $(this).closest("tr").find('td');
    $('#employee_id_update').val(tr.eq(0).text());
    $('#shift_start_update').val(tr.eq(1).text());
    $('#shift_end_update').val(tr.eq(2).text());
    $('#shift_type_update').val(tr.eq(3).text());
  });

  $(document).on('click', '#closemodalupdate', function () {
    $('#updateshift').modal('hide');

  });

  $(document).on('click', '#smallModal', function () {

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
