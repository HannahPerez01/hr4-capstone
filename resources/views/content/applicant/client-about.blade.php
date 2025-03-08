<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')
@section('title','About')


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
      <a class="nav-item nav-link" href="{{url('/') }}" style="font-size:20px">Home</a>
      
      <a class="nav-item nav-link  active" href="{{url('/about') }} "  style="font-size:20px">About</a>
      <a class="nav-item nav-link" href="{{url('/contact') }} "  style="font-size:20px">Contact</a>
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


<section class="py-5">
  <div class="container">
    <div class="row align-items-center gx-4">
      <div class="col-md-5">
        <div class="ms-md-2 ms-lg-5"><img class="img-fluid rounded-3" src="https://freefrontend.dev/assets/square.png"></div>
      </div>
      <div class="col-md-6 offset-md-1">
        <div class="ms-md-2 ms-lg-5">
          <span class="text-muted">Our Story</span>
          <h2 class="display-5 fw-bold">About Us</h2>
          <p class="lead">We are revolutionizing the way businesses manage their workforce and client relationships. Our Service Management System: combines advanced technology with intuitive workflows to streamline every aspect of workforce and client management, ensuring your business operates efficiently and effectively.</p>
 
 <p class="lead ">
Data-driven platform that offers a 360° view of your workforce. Our Comprehensive Employment Workforce system ensures you have all the tools needed to manage your team effectively. With secure data management and advanced reporting capabilities, you’ll be able to make informed decisions that drive business growth.
</p>
 <p class="lead">
We understand that finding the right talent for the right role is critical to your success. Our Placement Management system allows you to easily manage recruitment, track job placements, and match candidates with the positions that best align with their skills. With our Position Job Management feature, you can create detailed job descriptions, define role expectations, and track employee progress seamlessly.
</p>

 <p class="lead">
Designed to build and nurture strong client relationships. With Client Management tools, you can track client interactions, monitor service delivery, and ensure your clients receive the personalized attention they deserve. By consolidating all client information into a single platform, we help you foster long-term partnerships and enhance client satisfaction.
  </p>

 <p class="lead ">
To this company, we are committed to providing solutions that are scalable, efficient, and tailored to meet the unique needs of your business. Our service management system not only simplifies operations but also helps you stay ahead in today’s fast-paced, dynamic business environment.
  </p>

 <p class="lead ">
This version of the "About Us" section effectively communicates the various components of the service management system and its value to potential customers or users. It highlights the system's features and explains how they come together to streamline business processes, improve client relations, and manage workforce data effectively.</p>
        </div>
      </div>
    </div>
  </div>
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
          <p><i class="fas fa-home me-3"></i>blank</p>
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

  <!-- Copyright -->

  <!-- Copyright -->
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