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

       <form action="{{url('/showdata')}}" method="Post">
             @METHOD('POST')
          @csrf

           <div class="form-group " style="margin-top:6%">
    <select name="position"  class="form-control btn-primary" style="width:100%;" onchange="this.form.submit()">
              <option>--SELECT POSITION--</option>
          <option class="form-control">TRAINING STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">HR STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">FINANCE STAFF</option>
          <option class="form-control">Training and development specialist</option>
        </select>
</div>
  </form>
 </div>

  </div>
  </div>

      <div class="card-datatable table-responsive">
        <table class="datatables-projects table border-top">
          <thead>
    <tr>
          <th>Benefit id</th>
         <th>Component</th>
         <th>Detail</th>
         <th>Action</th>
       </tr>
          </thead>


            <tbody>
      @foreach($benefits as $bene)
      <tr class="contents">
        <td>{{ $bene->benefits_id}}</td>
        <td>{{ $bene->component}}</td>
        <td>{{ $bene->detail}}</td>
        <td>
        <form  action=""  class="mb-3" method="POST">
          @METHOD('POST')
          @csrf
          <input type="hidden" name="user_id" value="">
          <button  type="submit" class="btn  btn-danger btn-sm btn-flat">Delete</button>
          </form>
          <button class="btn  btn-primary btn-flat btn-sm">Update</button></td>
      </tr>
      @endforeach
    </tbody>
        </table>


      </div>
    </div>
  </div>


<div class="modal" tabindex="-1" role="dialog" id="smallModal">
  <div class="modal-dialog" role="document">
    <form  action="{{url('/benefitstore')}}" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">BENEFITS INFO</h5>

        </div>
        <div class="modal-body">  
 <label>JOB POSITION</label>
           <div class="form-group ">
    <select name="position"  class="form-control btn-primary">
              <option>--SELECT POSITION--</option>
          <option class="form-control">TRAINING STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">HR STAFF</option>
          <option class="form-control">LOGISTIC</option>
          <option class="form-control">FINANCE STAFF</option>
          <option class="form-control">Training and development specialist</option>
        </select>
</div>

         <label>COMPONENT</label>
         <div class="form-group">
           <input type="text" name="component" class="form-control">
         </div>
         <label>DETAIL</label>
         <div class="form-group">
           <input type="text" name="detail" class="form-control">
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




