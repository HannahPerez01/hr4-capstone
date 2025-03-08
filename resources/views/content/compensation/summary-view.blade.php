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
        <th>SUMMARY TABLE</th>
       <th>BASIC PAY RANGE</th>
       <th>REST DAY OVERTIME</th>
       <th>REGULAR OVERTIME</th>
       <th>ALLOWANCE</th>
       <th>BONUSES</th>
       <th>FRINGE BENEFITS</th>
       <th>TOTAl COMPENSATION</th>
       <th>ACTION</th>
     </tr>
   </thead>


   <tbody>
    @foreach($summary as $summary)
     <tr>
       <td>{{$summary->summary_id}}</td>
       <td>{{$summary->basic_pay}}</td>
       <td>{{$summary->restday}}</td>
       <td>{{$summary->regularday}}</td>
       <td>{{$summary->allowance}}</td>
       <td>{{$summary->bonuses}}</td>
       <td>{{$summary->fringe_benefit}}</td>
       <td>{{$summary->totalcompensation}}</td>
   
       <td>
    <form action="{{url('/deleted')}}" method="POST">
    @METHOD('POST')
      @csrf
          <input type="hidden" name="summary_id" value="{{$summary->summary_id}}">
        <button  type="submit" class="btn  btn-danger btn-sm btn-flat mb-2">DELETE</button>
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
  <form  action="{{url('/summarystore')}}" id="formAuthentication" class="mb-3" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SALARY LEVEL</h5>

      </div>
      <div class="modal-body">
        <label>JOB POSITION</label>
        <div class="form-group">
         <select name="jobposition" class="form-control">
          <option class="form-control">TRAINING STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">HR STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">FINANCE STAFF</option>
          <option class="form-control">Training and development specialist</option>
        </select>
      </div>

      <label>BASIC PAY</label>
      <div class="form-group">
       <input type="text" name="basic_pay" class="form-control" required>
     </div>
     
     <label>REST DAY RANGE</label>
     <div class="form-group">
       <input type="number" name="restday" class="form-control" required>
     </div>

     <label>REGULAR DAY RANGE</label>
     <div class="form-group">
       <input type="number" name="regularday" class="form-control" required>
     </div>
     
     <label>ALLWONCE</label>
     <div class="form-group">
       <input type="number" name="allowance" class="form-control" required>
     </div>

         <label>BONUSES</label>
     <div class="form-group">
       <input type="number" name="bonuses" class="form-control" required>
     </div>

     <label>FRINGE BENEFIT</label>
     <div class="form-group">
       <input type="number" name="fringe_benefit" class="form-control" required>
     </div>
     <label>TOTAL COMPENSATION</label>
     <div class="form-group">
       <input type="number" name="totalcompensation" class="form-control" required>
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




