<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@extends('layouts/layoutMaster')
@section('title', 'PLACEMENT MANAGEMENT')
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

    <div style="display:flex;margin-bottom:3%;">
      <button class="btn  btn-primary btn-sm btn-flat mt-3 " style="margin-left:7px;font-size:15px;width:13%;height:38px;"  id="openmodels"><i class="fas fa-plus-square"></i>Insert Info</button>

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
           <th>Applicant Name</th>
           <th>Applicant Code</th>
           <th>Contact</th>
           <th>Email</th>
           <th>Training Fee</th>
           <th>Status</th>
           <th>Action</th>
         </tr>
         <tbody>
          @foreach($employee as $emp)
          <tr class="contents">
            <td class="titles">{{$emp->firstname}}</td>
            <td>{{$emp->employee_code}}</td>
            <td>{{$emp->contact}}</td>
            <td>{{$emp->email}}</td>
            <td>{{$emp->trainee_fee}}</td>
            <td>
             <?php 
             $status=$emp->status;
             if($status=='post'){?>
               <span class="badge bg-primary">{{$emp->status}}</span>
             <?php }?>
           </td>
           <td>
            <?php 
            $status=$emp->status;
            if($status=='post'){?>
            <?php }else{ ?>
              <form  action="{{route('applicant.update')}}" id="formAuthentication" class="mb-3" method="POST">
                @csrf
                <input type="text" name="employee_id" value="{{$emp->employee_id}}" style="display:none;">
                <button class="btn  btn-primary btn-flat btn-sm">POST</button>
              </form>
            <?php }?>
          </td>
        </tr>
        @endforeach
      </tbody>
    </thead>
  </table>
</div>
</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="smallModal">
  <div class="modal-dialog" role="document">
    <form  action="{{route('applicant.store')}}" id="formAuthentication" class="mb-3" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">ADD APPLICANT</h5>
        </div>
        <div class="modal-body">
            <label>PICTURE</label>
         <div class="form-group">
           <input type="file" name="image" class="form-control">
         </div>

         <label>FIRST NAME</label>
         <div class="form-group">
           <input type="text" name="first" class="form-control">
         </div>
         <label>MIDDLE NAME</label>
         <div class="form-group">
           <input type="text" name="middle" class="form-control">
         </div>

         <label>LAST NAME</label>
         <div class="form-group">
           <input type="text" name="last" class="form-control">
         </div>

         <label>EMAIL</label>
         <div class="form-group">
           <input type="email" name="email" class="form-control">
         </div>

         <label>CONTACT</label>
         <div class="form-group">
           <input type="number" name="contact" class="form-control">
         </div>

         <label>TRAINING FEE</label>
         <div class="form-group">
           <input type="number" name="training_fee" class="form-control">
         </div>
         <label>JOB ROLES</label>
         <div class="form-group">
           <select name="role" class="form-control">
             <option class="form-control">HR STAFF</option>
             <option class="form-control">TRAINER</option>
             <option class="form-control">SECRUITY GUARD</option>
             <option class="form-control">JANITOR</option>
           </select>
         </div>

             <label>Description</label>
         <div class="form-group">
          <textarea class="form-control" name="description"></textarea>
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


<script >
  $(document).on('click', '#openmodels', function () {
    $('#smallModal').modal('show');


  });

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


@endsection


