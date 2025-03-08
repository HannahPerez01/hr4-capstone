<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\signup;

class signupController extends Controller
{

 public function index(){
      $pageConfigs = ['myLayout' => 'blank'];
          return view('content.applicant.signup-view',['pageConfigs' => $pageConfigs]);
        }

public function store(Request $request){
        // dd($request->all());
   $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $random =substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
        signup::create([
            'client_code' => $random,
            'firstname' => $request->first,
            'middlename' => $request->middle,
            'lastname' => $request->last,
            'address' => $request->address,
            'contact' => $request->contact,
            'email' => $request->email,
            'company' => $request->company,
            'company_address' => $request->address,
        ]);
        $gg=$request->first;
          User::create([
            'name' =>$request->first,
            'code_id' =>$random,
            'password' => $request->password,
            'email' => $request->email,
             'role'=>'client',
        ]);
          return redirect()->back()->with('alert', 'SUCCESS REGISTER');
    }

}
