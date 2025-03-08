<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LeaveManagementController extends Controller
{

       public function index(){
                   $leave= DB::select("select  * FROM  hr3_leave_management  "); 
       return view('content.corehuman.Leavemanagement-view',['leave'=>$leave]);
   }

}
