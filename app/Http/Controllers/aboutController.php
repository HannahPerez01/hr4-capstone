<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutController extends Controller
{

  public function  index(){
      $pageConfigs = ['myLayout' => 'blank'];
          return view('content.applicant.client-about',['pageConfigs' => $pageConfigs]);

        }
}