<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class homeController extends Controller
{
     public function index()
  {
     

  $post = DB::select("select  * FROM core1_employee where  status='post'");


      $pageConfigs = ['myLayout' => 'blank'];
          return view('content.applicant.home-view',['pageConfigs' => $pageConfigs],['post' => $post]);

        }



public function login(Request $request){

// dd('test post', $request->all());

  $user = User::where('email', $request->email)->first();

  // dd($user);

  if(!$user){

    // TODO:
    return back()->with('error', 'user not found');
  }



  if(!Hash::check($request->password, $user->password)){
    return back()->with('error', 'incorrect credential');
  }


if($user->role=='admin'){
  Auth::login($user);
  return redirect('/dashboard/crm');
}else{
  Auth::login($user);
   return redirect('/');
   }
 }


}
