<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeprofileController extends Controller
{
 
       public function index(){

                $applicants= DB::select("select  * FROM  hr1_applicant  "); 
       return view('content.corehuman.Employeeprofile-view',['applicants' =>$applicants]);
   }
}
