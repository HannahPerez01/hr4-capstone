<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class timeandattendance extends Controller
{
        public function index()
  {

      $attendance = DB::table('hr3_attendance')
            ->leftJoin('hr1_employee_info', 'hr1_employee_info.employee_id', '=', 'hr3_attendance.employee_id')
            ->get();
      return view('content.timeandattendance.time-and-attendance',['attendance' => $attendance]);
  }


}


?>