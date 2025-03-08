<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@php
$customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')


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
   <a class="navbar-brand" href="javascript:void(0)">CLIENT</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
   <span class="navbar-toggler-icon"></span>
   </button>
    @csrf
   <div class="collapse navbar-collapse justify-content-center mt-3" id="navbar-ex-7">
   <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{url('/')}}" style="font-size:20px">Home</a>
      <a class="nav-item nav-link" href="{{url('/about') }}"  style="font-size:20px">About</a>
      <a class="nav-item nav-link" href="{{url('/contact')}}"  style="font-size:20px">Contact</a>
       <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px;position:relative;top:-5px;"><button class="btn btn-success ">Sign up</button></a>
       <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px;position:relative;top:-5px;"><button class="btn btn-success" id="login">Login</button></a>

   </div>
   </div>
  </div>
</nav> 


<div class="container-fluid">


        <form method="POST" action="{{route('signup.store')}}">
           @csrf
            @method('POST')
<div class="row " style="margin-top:5%;" >
  <div class="col-md-5">

<p style="color:blue;text-align:center;font-size:30px;">CLIENT REGISTER AN ACCOUNT</p>
   <div class="form-group mt-3 ">
    <label>Email Address</label>
  <input type="text" name="email" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;">
</div>



<div class="form-group m-3" style="">
    <label>Password</label>
  <input type="password" name="password" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required> 
</div>

<div class="form-group m-3">
    <label>First Name</label>
  <input type="text" name="first" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>

</div>

<div class="form-group m-3">
    <label>Middle Name</label>
  <input type="text" name="middle" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>

</div>

<div class="form-group m-3">
    <label>Last Name</label>
  <input type="text" name="last" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>
</div>

<div class="form-group m-3">
    <label>Company</label>
  <input type="text" name="company" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>
</div>

<div class="form-group m-3">
    <label>Contact</label>
  <input type="text" name="contact" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>
</div>



   <div class="form-group mt-3 ">
    <label>Company Address</label>
  <input type="text" name="address" class="form-control" style="background-color: inherit; border-top: none; border-left: none; border-right: none; box-shadow: none !important; border-color: #000 !important;" required>
</div>



   <div class="form-group mt-3 ">
  <button type="submit" name="submit" class="form-control btn btn-primary"  style="color:white;">Register</button>
</div>








  </div>


  <div class="col-md-6">
    
<img src="{{asset('assets/img/jobportal.png')}}" style="width:100%;height:400px;">
  </div>


</div>
</form>

  </div>






</div>





<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->

    <!-- Right -->
    <!-- Right -->
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
            <i class="fas fa-gem me-3"></i>CORE SYSTEM
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
          <p><i class="fas fa-home me-3"></i> blank</p>
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

  <!-- Copyright -->

</footer>
<!-- Footer -->


</div>
@endsection


  <script >
    $(document).on('click', '#login', function () {
      $('#login_modal').modal('show');
    });
    $(document).on('click', '#modal_close', function () {
      $('#login_modal').modal('hide');
    });
  </script>


  <script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }
</script>