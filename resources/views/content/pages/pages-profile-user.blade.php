
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-profile.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/pages-profile.js'])
@endsection

@section('content')


<!-- Header -->
<div class="row">
 
@foreach($profiles as $prof)
<div class="container-xxl flex-grow-1 container-p-y">

  <div id="content">

      <section>
        <div class="container py-5">
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="{{ asset('assets/img/'.$prof->image) }}" alt="avatar"
                  class="rounded-circle img-fluid" style="width: 150px;height:150px;">
                  <h5 class="my-3"></h5>
                  <p class="text-muted mb-1"></p>
                  <p class="text-muted mb-4"></p>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" id="open_profile" class="btn btn-primary" style="width:100%;">UPDATE PROFILE</button>
                  </div>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" data-mdb-button-init data-mdb-ripple-init  class="btn btn-primary" style="width:100%;" id="edit_profile">UPDATE INFO</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Full Name:</p>
                    </div>
                    <div class="col-sm-9">

                      <p class="text-muted mb-0">

{{$prof->name}}

                     </p>
                   </div>
                 </div>
                 <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$prof->email}}</p>
                </div>
              </div>
              <hr>

              


              
            </div>
          </div>




        </div>
      </div>
    </div>
  </section>


  <div class="modal" tabindex="-1" role="dialog" id="login_modal">
    <div class="modal-dialog" role="document">
     <form method="POST"   action="{{route('storeImage')}}" enctype="multipart/form-data">
      @csrf
      @method('POST')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" style="text-align:center;">UPLOAD PROFILE PICTURE</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Upload Profile</label>
            <input  type="file" class="form-control" name="image">
          </div>

          <input  type="text" class="form-control" name="applicant_id" value="{{$prof->id}}"style="display:none;">

          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">SAVE</button>
            <button type="button" class="btn btn-danger" id="modal_close">Close</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="profile_modal">
  <div class="modal-dialog" role="document">
   <form method="POST"   action="{{route('userupdate')}}">
    @csrf
    @method('POST')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" style="text-align:center;">UPDATE INFO</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>First Name</label>
          <input  type="text" class="form-control" name="first" value="{{$prof->name}}" required>
        </div>
   

        <div class="form-group">
          <label>Email</label>
          <input  type="email" class="form-control" name="email" value="{{$prof->email}}">
        </div>

       

        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary">SAVE</button>
          <button type="button" class="btn btn-danger" id="applicant_close">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>
</div>






</div>


</div>

@endforeach


</div>
<!--/ User Profile Content -->
@endsection


<script >
  $(document).on('click', '#open_profile', function () {
    $('#login_modal').modal('show');
  });
  $(document).on('click', '#modal_close', function () {
    $('#login_modal').modal('hide');
  });
</script>



<script >
  $(document).on('click', '#edit_profile', function () {
    $('#profile_modal').modal('show');
  });
  $(document).on('click', '#applicant_close', function () {
    $('#profile_modal').modal('hide');
  });
</script>