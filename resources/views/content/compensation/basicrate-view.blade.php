<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@extends('layouts/layoutMaster')
@section('title', 'COMPENSATION')
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
    <div style="display:flex;">
     <button class="btn  btn-primary btn-sm btn-flat m-3 " style="font-size:15px;width:13%;height:38px;"  data-bs-toggle="modal" data-bs-target="#smallModal"><i class="fas fa-plus-square"></i>Insert Info</button>

     <div class="form-group  " style="margin-top:1.60%;">
       <form action="" method="Post">
         @METHOD('POST')
         @csrf

         <select name="position"  class="form-control btn-primary" style="width:100%;" onchange="this.form.submit()">
          <option>--SELECT POSITION--</option>
          <option>HR</option>
          <option>IT</option>
          <option>LOGISTIC</option>
        </select>
      </form>
    </div>

  </div>
</div>

<div class="card-datatable table-responsive">
  <table class="datatables-projects table border-top">
    <thead>
      <tr>

        <th>Basic Pay Range</th>
        <th>Daily Rate</th>
        <th>Hourly Rate</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($basic as $basic)
      <tr>
        <td>{{$basic->basic_pay_range}}</td>
        <td>{{$basic->daily_rate}}</td>
        <td>{{$basic->hourly_rate}}</td>

        <td>
          <form action="{{url('/deleted')}}" method="POST">
            @METHOD('POST')
            @csrf
            <input type="hidden"  name="basicrate_id"  value="{{$basic->basicrate_id}}">
            <button  type="submit" class="btn-danger btn btn-sm btn-flat">Delete</button>
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
    <form  action="{{url('/insertdata')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">BENEFITS INFO</h5>

        </div>


        <div class="modal-body">
          <label>JOB POSITION</label>
          <div class="form-group " style="margin-top:1.70%">
            <select name="position" class="form-control  bg-primary text-white">
              <option class="form-control">TRAINING STAFF</option>
              <option class="form-control">LOGISTIC</option>
              <option class="form-control">HR STAFF</option>
              <option class="form-control">LOGISTIC</option>
              <option class="form-control">FINANCE STAFF</option>
              <option class="form-control">Training and development specialist</option>
            </select>
          </div>


          <label>Basic Pay Range</label>
          <div class="form-group">
           <input type="text" name="basic_pay_range" class="form-control">
         </div>
         <label>Daily Rate</label>
         <div class="form-group">
           <input type="text" name="daily_rate" class="form-control">
         </div>
         <label>Hourly Rate</label>
         <div class="form-group">
           <input type="text" name="hourly_rate" class="form-control">
         </div>

       </div>
       <div class="modal-footer">
        <button type="SUBMIT" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" id="modal_close">Close</button>
      </div>
    </div>
  </form>
</div>
</div>

<script >
  $(document).on('click', '#modal_close', function () {
    $('#smallModal').modal('hide');

  });

</script>
@endsection








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




