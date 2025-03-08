@extends('layouts/layoutMaster')

@section('title', 'Analytics')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss',
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss'
])
@endsection

@section('page-style')
<!-- Page -->
@vite(['resources/assets/vendor/scss/pages/cards-advance.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/apex-charts/apexcharts.js',
  'resources/assets/vendor/libs/swiper/swiper.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  ])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/dashboards-analytics.js'
])
@endsection

@section('content')


     <div class="container-xxl flex-grow-1 container-p-y">


       <div class="card-body">
         <div class="container" style="margin-top:3%;">

           <div class="row">
            <div class="col-md-3 bgd-warning mr-2" style="height:150px;border-radius:5px;margin-right:1%;margin-bottom:1%;">
              <div class="row">
                <div class="col-md-6">

                 <p style="font-size:30px;color:white;margin-top:15%;"></p>
               <p style="font-size:20px;color:white;margin-top:15%;">TOTAL EMPLOYEE</p>
             </div>

             <div class="col-md-6">
               <i class="fas fa-user-tie" style="font-size:50px;color:white;margin-top:30%;"></i>
             </div>
           </div>
         </div>

         <div class="col-md-3 bg-primary mr-2" style="height:150px;border-radius:5px;margin-right:1%;margin-bottom:1%;">
           <div class="row">
            <div class="col-md-6">

              <p style="font-size:30px;color:white;margin-top:15%;"></p>
            <p style="font-size:20px;color:white;margin-top:15%;">Present Today</p>
          </div>
          <div class="col-md-6">
           <i class="far fa-calendar-alt" style="font-size:50px;color:white;margin-top:40%;"></i>
         </div>
       </div>
     </div>

     <div class="col-md-3 bg-warning  mr-2" style="height:150px;border-radius:5px;margin-right:1%;margin-bottom:1%;">
       <div class="row">
        <div class="col-md-6">

         <p style="font-size:30px;color:white;margin-top:15%;">  
         <p style="font-size:20px;color:white;margin-top:15%;">TOTAL ABSENT</p>
       </div>
       <div class="col-md-6">
        <i class="fas fa-flag"  style="font-size:50px;color:white;margin-top:30%;"></i>
      </div>
    </div>
  </div>
</div>

</div>
</div>











</div>


@endsection
