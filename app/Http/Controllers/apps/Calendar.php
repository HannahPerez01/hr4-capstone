<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;

class Calendar extends Controller
{
  public function index(Request $request)
  {

    $claims = Claim::all(); 

    return view('content.apps.app-calendar', ['claims' => $claims]);
    // return view('content.apps.app-calendar', compact('claims'));
  }
}
