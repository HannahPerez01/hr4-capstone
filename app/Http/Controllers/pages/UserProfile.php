<?php

namespace App\Http\Controllers\pages;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserProfile extends Controller
{
  public function index()
  {
  $id=Auth::user()->id;
  $profiles = DB::select("select  * FROM  users where  id='$id' ");   return view('content.pages.pages-profile-user', ['profiles' =>$profiles]);
  }


//Store image
    public function storeImage(Request $request){
  
        if($request->file('image')){
            $file= $request->file('image');
            $filename=$file->getClientOriginalName();
            $file-> move(public_path('assets\img'), $filename);
            $data['image']= $filename;
            $get=$_FILES["image"]["name"];
             $id=Auth::user()->id;
            $app = User::where('id',$id);
        if(!$app){
               return abort(404);
             }
        $app->update([
            'image' =>$get,
        ]);
        }
    return back();  
    }
public function update(Request $request){
$user_id=Auth::user()->id;
  $update = User::where('id',$user_id)->first();
        if(!$update){
               return abort(404);
             }
        $update->update([
            'name' => $request->first,
            'email' => $request->email,
        ]);
    return back();
    }
}
