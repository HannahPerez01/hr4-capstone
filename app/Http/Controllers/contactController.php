<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactController extends Controller
{
            public function index()
  {



      $pageConfigs = ['myLayout' => 'blank'];
          return view('content.applicant.client-contact',['pageConfigs' => $pageConfigs]);

        }

}
