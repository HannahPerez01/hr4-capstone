<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class clientmanagementController extends Controller
{
     


      public function index()
  {

 $client = DB::select("select  * FROM core_client_account");

      return view('content.core.client-view',['client'=>$client]);


}


}
