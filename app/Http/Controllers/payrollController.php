<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class payrollController extends Controller
{
    public function index()
  {


   return view('content.payroll.payroll-view');
}
}
