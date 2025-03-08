<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingManegementController extends Controller
{
  
       public function index(){
       return view('content.corehuman.Trainingmanagement-view');
   }

}
