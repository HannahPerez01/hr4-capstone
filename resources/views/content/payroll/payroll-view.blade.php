
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@extends('layouts/layoutMaster')
@section('title', 'Payroll')
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
  <div class="card">
    <div style="display:flex;">
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
         <th>Employee ID</th>
         <th>Employee Name</th>
         <th>Pagibig Contrib</th>
         <th>Philhealth Contrib</th>
         <th>SSS Contrib</th>
         <th>TOTAL</th>
         <th>Action</th>
       </tr>
     </thead>

     <tbody>
      <?php
           $host="localhost"; // Host name
           $username="root"; // Mysql username
           $password="password"; // Mysql password
           $db_name="hr4_db"; // Database name
           $tbl_name="information"; // Table name
           $conn = mysqli_connect("$host","$username","$password")or die("cannot connect");
           mysqli_select_db($conn,"$db_name")or die("cannot select DB");
           $select="SELECT * FROM hr1_employee_info  INNER JOIN hr4_deduction on hr4_deduction.employee_id=hr1_employee_info.employee_id";
           $fetch=mysqli_query($conn,$select);?>
           <?php while($row=mysqli_fetch_assoc($fetch)){?>
            <tr class="contents">
             <td class="titles"><?php echo $row['employee_id'];?></td>
             <td><?php echo $row['employee_name'];?></td>
             <td><?php echo $row['pagibig'];?></td>
             <td><?php echo $row['philhealth'];?></td>
             <td><?php echo $row['sss'];?></td>
             <td><?php $id=$row['employee_id'];
             $get_total="SELECT *,SUM(total_hrs) as  total,sum(over_time) as  overtime FROM `hr3_attendance`  WHERE date_time_in BETWEEN '2024-1-23' AND '2024-30-23' and employee_id='$id'";
             $fetch_total=mysqli_query($conn,$get_total);
             $mysql_total=mysqli_fetch_assoc($fetch_total);
             $total= $mysql_total['total']*86;
             echo number_format($total,2);
           ?></td>
           <td>
             <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ti ti-dots-vertical"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item">
                  <button class="btn  btn-danger btn-sm btn-flat mb-3" style="font-size:15px;"><i class="fas fa-print"></i></button>
                Print Payslip</a>
                <a class="dropdown-item">
                  <button class="btn  btn-success btn-sm btn-flat mb-3" style="font-size:15px;" id="update"><i class="far fa-edit"></i></button>
                Update</a>
              </div>
            </div></td>
          </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="payroll_edit">
  <div class="modal-dialog" role="document">
    <form  action="" id="formAuthentication" class="mb-3" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">UPDATE INFO</h5>

        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <label>EARNINGS</label>
            </div>

            <div class="col-md-4">
              <label>HOURS</label>
            </div>

            <div class="col-md-4">
              <label>AMOUNT</label>
            </div>


            <div class="col-md-4">
              <div>BASIC SALARY</div>
            </div>

            <div class="col-md-4">
              <div class="form-group"><input type="number" class="form-control
                "></div>
              </div>

              <div class="col-md-4">
                <label>00.00</label>
              </div>


              <div class="col-md-4">
                <div>RED OT</div>
              </div>

              <div class="col-md-4">
                <div class="form-group"><input type="number" class="mt-1 form-control
                  "></div>
                </div>

                <div class="col-md-4">
                  <label>00.00</label>
                </div>
                <div class="col-md-4">
                  <div>RG OT</div>
                </div>

                <div class="col-md-4">
                  <div class="form-group"><input type="number" class="mt-1 form-control
                    "></div>
                  </div>

                  <div class="col-md-4">
                    <label>00.00</label>
                  </div>


                  <div class="col-md-4">
                  </div>

                  <div class="col-md-4">
                    <label class="mt-1">TOTAL EARNING</label>
                  </div>


                  <div class="col-md-4">

                  </div>



                  <div class="col-md-4">
                    <label>PAGIBIG CONTRIBUTION</label>
                  </div>

                  <div class="col-md-4">

                  </div>

                  <div class="col-md-4">
                    <label>00.00</label>
                  </div>



                  <div class="col-md-4">
                    <label>PHILHEALTH CONTRIBUTION</label>
                  </div>

                  <div class="col-md-4">

                  </div>

                  <div class="col-md-4">
                    <label>00.00</label>
                  </div>



                  <div class="col-md-4">
                   <label>SSS CONTRIBUTION</label>
                 </div>

                 <div class="col-md-4">

                 </div>

                 <div class="col-md-4">
                  <label>00.00</label>
                </div>



                  <div class="col-md-4 mt-1" >
                             </div>

                 <div class="col-md-4 mt-3">
                  <label>Total Deduction</label>
                 </div>

                 <div class="col-md-4 mt-3">
                  <label>00.00</label>
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

      @endsection



      <script >
        $(document).on('click', '#modal_close', function () {
          $('#payroll_edit').modal('hide');

        });

      </script>


      <script >
        $(document).on('click', '#update', function () {
          $('#payroll_edit').modal('show');

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
