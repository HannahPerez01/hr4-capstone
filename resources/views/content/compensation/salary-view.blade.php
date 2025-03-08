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

<div class="form-group " style="margin-top:1.70%">
    <select name="jobposition" class="form-control  bg-primary text-white">
          <option class="form-control">TRAINING STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">HR STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">FINANCE STAFF</option>
          <option class="form-control">Training and development specialist</option>
        </select>
</div>
      
  </div>

  <div class="card-datatable table-responsive">
    <table class="datatables-projects table border-top">
      <thead>
        <tr>
          <th>Level Id</th>
         <th>Step1</th>
         <th>Step2</th>
         <th>step3</th>
         <th>Step4</th>
         <th>Step5</th>
         <th>Step6</th>
         <th>Step7</th>
         <th>Step8</th>
         <th>Action</th>
       </tr>
     </thead>


     <tbody>
      @foreach($salarylevel as $level)
       <tr>
         <td>{{$level->salarylevel_id}}</td>
         <td>{{$level->step1}}</td>
         <td>{{$level->step2}}</td>
         <td>{{$level->step3}}</td>
         <td>{{$level->step4}}</td>
         <td>{{$level->step5}}</td>
         <td>{{$level->step6}}</td>
         <td>{{$level->step7}}</td>
         <td>{{$level->step8}}</td>
          <td>
            <form action="{{url('/deleted')}}" method="POST">
              @METHOD('POST')
              @csrf
              <input type="hidden" name="salaryid" value="{{$level->salarylevel_id}}">
                  <button type="submit" class="btn btn-danger btn-sm btn-flat">Delete</button>

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
    <form  action="{{url('/salarystore')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">SALARY LEVEL</h5>

        </div>
        <div class="modal-body">

          <label>JOB POSITION</label>
     <div class="form-group " style="margin-top:1.70%">
          <select name="jobposition" class="form-control  bg-primary text-white">
          <option class="form-control">TRAINING STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">HR STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">FINANCE STAFF</option>
          <option class="form-control">Training and development specialist</option>
        </select>
     </div>
      

        <label>LEVEL NAME</label>
        <div class="form-group">
         <input type="text" name="levelname" class="form-control" required>
       </div>
       
       <label>STEP 1</label>
       <div class="form-group">
         <input type="number" name="step1" class="form-control" required>
       </div>

       <label>STEP 2</label>
       <div class="form-group">
         <input type="number" name="step2" class="form-control" required>
       </div>
       
       <label>STEP 2</label>
       <div class="form-group">
         <input type="number" name="step3" class="form-control" required>
       </div>

       <label>STEP 4</label>
       <div class="form-group">
         <input type="number" name="step4" class="form-control" required>
       </div>
       <label>STEP 5</label>
       <div class="form-group">
         <input type="number" name="step5" class="form-control" required>
       </div>
       <label>STEP 6</label>
       <div class="form-group">
         <input type="number" name="step6" class="form-control" required>
       </div>
       <label>STEP 7</label>
       <div class="form-group">
         <input type="number" name="step7" class="form-control" required>
       </div>
       <label>STEP 8</label>
       <div class="form-group">
         <input type="number" name="step8" class="form-control" required>
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




