<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')
@section('title','contact')


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


@section('content')

<style type="text/css">
  
  body{
    background-color:white;
  }
.get-in-touch {
  max-width: 800px;
  margin: 50px auto;
  position: relative;

}
.get-in-touch .title {
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-size: 3.2em;
  line-height: 48px;
  padding-bottom: 48px;
     color: #5543ca;
    background: #5543ca;
    background: -moz-linear-gradient(left,#f4524d  0%,#5543ca 100%) !important;
    background: -webkit-linear-gradient(left,#f4524d  0%,#5543ca 100%) !important;
    background: linear-gradient(to right,#f4524d  0%,#5543ca  100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
}

.contact-form .form-field {
  position: relative;
  margin: 32px 0;
}
.contact-form .input-text {
  display: block;
  width: 100%;
  height: 36px;
  border-width: 0 0 2px 0;
  border-color: #5543ca;
  font-size: 18px;
  line-height: 26px;
  font-weight: 400;
}
.contact-form .input-text:focus {
  outline: none;
}
.contact-form .input-text:focus + .label,
.contact-form .input-text.not-empty + .label {
  -webkit-transform: translateY(-24px);
          transform: translateY(-24px);
}
.contact-form .label {
  position: absolute;
  left: 20px;
  bottom: 11px;
  font-size: 18px;
  line-height: 26px;
  font-weight: 400;
  color: #5543ca;
  cursor: text;
  transition: -webkit-transform .2s ease-in-out;
  transition: transform .2s ease-in-out;
  transition: transform .2s ease-in-out, 
  -webkit-transform .2s ease-in-out;
}
.contact-form .submit-btn {
  display: inline-block;
  background-color: #000;
   background-image: linear-gradient(125deg,#a72879,#064497);
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 16px;
  padding: 8px 16px;
  border: none;
  width:200px;
  cursor: pointer;
}


</style>
<div class="container-xxl  " style="padding:0;">
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary  " style="padding:0px;" >
  <div class="container-fluid">
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
     <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse justify-content-center mt-3" id="navbar-ex-7">
     <div class="navbar-nav">
      <a class="nav-item nav-link " href="{{url('/') }}" style="font-size:20px">Home</a>
      <a class="nav-item nav-link" href="{{url('/about') }} "  style="font-size:20px">About</a>
      <a class="nav-item nav-link active" href="{{url('/contact') }}"  style="font-size:20px">Contact</a>
       <?php   if (Auth::user()) {?>
        <a class="nav-item nav-link" href="{{url('/client')}}"  style="font-size:20px">Client Account</a>
        <a class="nav-item nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  style="font-size:20px;position:relative;top:-5px;"><button class="btn btn-success" >Logout</button></a>
        <form method="POST" id="logout-form" action="">
          @csrf
        </form>
      <?php } else {?>
       <a class="nav-item nav-link" href="{{url('/signup')}}"  style="font-size:20px;position:relative;top:-5px;">    
        <form method="POST" action="{{url('/signup')}}">
          @csrf
          @method('GET')
          <button type="submit" name="submit" class=" btn btn-success" id="update_btn">Sign Up</button>
        </form> 
      </a>
      <a class="nav-item nav-link" href="javascript:void(0) "  style="font-size:20px;position:relative;top:-5px;"><button class="btn btn-success" id="login">Login</button></a>
    <?php  }?>

    </div>
  </div>
</div>
</nav> 


<div class="container-xxl flex-grow-1 container-p-y">

  <div id="content">


<section class="get-in-touch">
   <h1 class="title">Get in touch</h1>
   <form class="contact-form row">
      <div class="form-field col-lg-6">
         <input id="name" class="input-text js-input" type="text" required>
         <label class="label" for="name">Name</label>
      </div>
      <div class="form-field col-lg-6 ">
         <input id="email" class="input-text js-input" type="email" required>
         <label class="label" for="email">E-mail</label>
      </div>
      <div class="form-field col-lg-6 ">
         <input id="company" class="input-text js-input" type="text" required>
         <label class="label" for="company">Company Name</label>
      </div>
       <div class="form-field col-lg-6 ">
         <input id="phone" class="input-text js-input" type="text" required>
         <label class="label" for="phone">Contact Number</label>
      </div>
      <div class="form-field col-lg-12">
         <input id="message" class="input-text js-input" type="text" required>
         <label class="label" for="message">Message</label>
      </div>
      <div class="form-field col-lg-12">
         <input class="submit-btn" type="submit" value="Submit">
      </div>
   </form>
</section>
     



<div class="modal" tabindex="-1" role="dialog" id="login_modal">
  <div class="modal-dialog" role="document">
   <form method="POST" action="{{route('login')}}">
    @csrf
    @method('POST')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" style="text-align:center;">LOGIN TO YOUR ACCOUNT</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Email</label>
          <input  type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input  type="password" class="form-control" name="password">
        </div>

        <div class="modal-footer">
          <button type="SUBMIT" class="btn btn-primary">Log in</button>
          <button type="button" class="btn btn-danger" id="modal_close">Close</button>
        </div>
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
            <i class="fas fa-gem me-3"></i>
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
            @example.com
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


