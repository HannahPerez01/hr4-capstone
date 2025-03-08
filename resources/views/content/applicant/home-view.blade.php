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
</style>
@section('content')


<style type="text/css">

  body{
    background-color:white;
  }
</style>

<div class="container-xxl  " style="padding:0;">
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary  " style="padding:0px;" >
  <div class="container-fluid">
   <a class="navbar-brand" href="javascript:void(0)">APPLICANT</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
     <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse justify-content-center mt-3" id="navbar-ex-7">
     <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{url('/') }}" style="font-size:20px">Home</a>
      <a class="nav-item nav-link" href="{{url('/about') }}"  style="font-size:20px">About</a>
      <a class="nav-item nav-link" href="{{url('/contact') }}"  style="font-size:20px">Contact</a>


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


<div class="container-fluid">
  <div style="text-align:center;margin-top:9%;">
    <p style="font-style:Sans-serif;font-size:50px;margin-bottom:0;">We connect people to bring projects to life</p>
    <p style="font-style:Sans-serif;font-size:40px;padding:0;margin:0;">EASY AND FAST</p>
  </div>




  <div class="row " style="margin-top:5%;" >
    <div class="col-md-5" style="margin-top:10%">
       <p style="text-align:center;">FIND HIGH QUALITY TALENTED EMPLOYEE</p>
      <button class="btn  btn-primary mb-4" style="margin-left:39%;">
          HIRE ME
      </button>
   
    </div>


    <div class="col-md-6">

      <img src="{{asset('assets/img/find.jpg')}}" style="width:100%;height:400px;">
    </div>

<div class="col-md-4">
  
</div>

   <div class="col-md-4" style="margin-top:5%">
      <p style="text-align:center;">FIND APPLICANT </p>

      <form class=" mt-3 ml-3 mw-100 navbar-search"  style="margin-left:7px" autocomplete="off">
        <div class="input-group">
          <input type="text"  id="myInput" onkeyup="myFunction()" class="form-control bg-light border-1 small" placeholder="Search Applicant..." aria-label="Search" aria-describedby="basic-addon2" >
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" style="height:40px;">
              <i class="fas fa-search fa-sm" ></i>
            </button>
          </div>
        </div>
      </form>
    </div>

<div class="col-md-4">
  
</div>


</div>


  <div class="contents">
     <div class="row" style="margin-top:10%;">
   
@foreach($post as  $pos)
   <div class="col-md-4 mt-2 mb-2 titles"> 
    <div class="card" style="width: 25rem;">
      <img class="card-img-top" src="{{ asset('assets/img/'.$pos->image) }}" alt="Card image cap" style="height:300px;">
      <div class="card-body">
        <h5 class="card-title " style="color:blue"></h5>
        <p class="card-text fw-bold text-center" style="text-transform:uppercase;">{{$pos->firstname}} {{$pos->middlename}} {{$pos->lastname}}</p>
          <p class="card-text fw-bold text-center text-primary" style="text-transform:uppercase;">{{$pos->position}}</p>
           <p class="card-text text-center" style="text-transform:uppercase;">{{$pos->description}}</p>
        <div style="text-align:center;">
          <form method="POST" action="" style="margin-left:4px;font-family:sans-serif;">
            @csrf
          <input type="text" value="" name="getid" style="display:none;">
            <button type="submit" class="btn btn-primary ml-3">VIEW</button>
          </form>

        </div>


      </div>
    </div>

  </div>
  @endforeach
</div>
</div>

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
 
    <!-- Left -->

    <!-- Right -->
 
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
            <i class="fas fa-gem me-3"></i>core
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