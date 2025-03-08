<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift_and_schedule;
class InvoiceAdd extends Controller
{
  public function index()
  {


       $Shift_and_schedule = Shift_and_schedule::all(); 
    return view('content.apps.app-invoice-add', ['Shift_and_schedule' => $Shift_and_schedule]);
  }
}
