<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
class Kanban extends Controller
{
  public function index()
  {

    $Leaves = Leave::all(); 

    return view('content.apps.app-kanban', ['Leaves' => $Leaves]);

  }
}
