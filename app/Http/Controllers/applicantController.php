<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class applicantController extends Controller
{
    public function index(){

         $profiles = DB::select("select  * FROM `hr1_applicant` where  code='$id' ");
         return view('content.core.applicant-view');
   }




}
