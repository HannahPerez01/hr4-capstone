<link rel=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
      type="text/css" />
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

@extends('layouts/layoutMaster')
@section('title', 'TIMESHEET MANAGEMENT')
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

    <div class="card">
      <div class="card-datatable table-responsive">
 
 <div class="container">
      <div class="row">

        <div class="col-md-3">
           <label style="font-family:bold;margin-top:5%;">NUMBER OF EMPLOYEE</label>
             <p>Manager  10</p> 
             <p>Hr   10</p>  
             <p>Logistic  10</p>  
             <p>Finance Staff  10</p>  
             <p>Training  10</p>  
             <p>Development Specialist  10</p>   
        </div>
         <div class="col-md-3">
            <div class="row">
                <div class="col-md-12" style="background-color:#1ab7ea;height:100px;"><p style="text-align:center;margin-top:15%;color:black;">HR DEPARTMENT</p></div>

                  <div class="col-md-6" style="background-color:#0076b3cc;height:150px;"><p style="text-align:center;margin-top:50%;color:black;">FINANCE DEPARTMENT</p></div>
                  <div class="col-md-6" style="background-color:#0076b3cc;height:150px;">
                     <div class="row">
                         <div class="col-md-12" style="height:90px;background-color:#00cfe8d1;">
                             <p style="margin-top:30%;color:black">Logistic Department</p>
                         </div>
                         <div class="col-md-12" style="background-color:#7367f0;">
                              <p style="color:black;">Training Department</p>
                         </div>
                     </div>

                  </div>

            </div>
        </div>
         <div class="col-md-3">
            
        </div>
         <div class="col-md-3">
            
        </div>
</div>


          </div>


      </div>
    </div>


@endsection
