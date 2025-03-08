<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')
@section('title','PROFILE')


@section('vendor-style')
@vite([
'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
'resources/assets/js/pages-auth.js'
])
@endsection


<style type="text/css">

  body{
    background-color:white;
  }




</style>
@section('content')
<div class="container-xxl  " style="padding:0;">
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary  " style="padding:0px;" >
  <div class="container-fluid">
   <a class="navbar-brand" href="javascript:void(0)">CLIENT PROFILE</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
     <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse justify-content-center mt-3" id="navbar-ex-7">
     <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{url('/') }}" style="font-size:20px">Home</a>
      <a class="nav-item nav-link" href="{{url('/about') }} "  style="font-size:20px">About</a>
      <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px">Contact</a>
      <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px">Profile Account</a>

      <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px;position:relative;top:-5px;">    
      </a>
      <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  style="font-size:20px;position:relative;top:-5px;"><button class="btn btn-success" >Logout</button></a>
      <form method="POST" id="logout-form" action="{{route('logout') }}">
        @csrf
      </form>

    </div>
  </div>
</div>
</nav> 



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

{{$prof->firstname}} {{$prof->middlename}} {{$prof->lastname}}

                     </p>
                   </div>
                 </div>
                 <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Address:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$prof->company_address}}</p>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Contact:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{$prof->contact}}</p>
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
     <form method="POST"   action="{{route('jobportal.storeImage')}}" enctype="multipart/form-data">
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

          <input  type="text" class="form-control" name="applicant_id" value="{{$prof->client_id}}"style="display:none;">

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
   <form method="POST"   action="{{route('client.update')}}">
    @csrf
    @method('POST')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" style="text-align:center;">UPDATE INFO</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>First Name</label>
          <input  type="text" class="form-control" name="first" value="{{$prof->firstname}}" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input  type="text" class="form-control" name="middle" value="{{$prof->middlename}}">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input  type="text" class="form-control" name="last" value="{{$prof->lastname}}">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input  type="text" class="form-control" name="company_address" value="{{$prof->company_address}}">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input  type="email" class="form-control" name="email" value="{{$prof->email}}">
        </div>
        <div class="form-group">
          <label>Contact</label>
          <input  type="number" class="form-control" name="contact" value="{{$prof->contact}}">
        </div>

          <div class="form-group" style="display:none;">
          <label>Contact</label>
          <input  type="number" class="form-control" name="client_id" value="{{$prof->client_id}}">
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





<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">


  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>core SYSTEM
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            LINK
          </h6>
          <p>
            <a href="#!" class="text-reset">ABOUT</a>
          </p>
          <p>
            <a href="#!" class="text-reset">CONTACT</a>
          </p>


        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>

          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>

          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i>blank</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            @gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->



</footer>
<!-- Footer -->


</div>
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