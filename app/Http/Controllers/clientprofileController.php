<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\signup;
use App\Models\User;
class clientprofileController extends Controller
{


        public function index()
  {

    $id=Auth::user()->code_id;

  $profiles = DB::select("select  * FROM  core_client_account where  client_code='$id' ");

      $pageConfigs = ['myLayout' => 'blank'];
          return view('content.applicant.client-profile',['profiles' =>$profiles],['pageConfigs' => $pageConfigs]);

        }



//Store image
    public function storeImage(Request $request){
  
        if($request->file('image')){
            $file= $request->file('image');
            $filename=$file->getClientOriginalName();
            $file-> move(public_path('assets\img'), $filename);
            $data['image']= $filename;
            $get=$_FILES["image"]["name"];
$id=$request->applicant_id;

$app = signup::where('client_id',$id);
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
$id=$request->client_id;
 $update = signup::where('client_id',$id);
  $user = User::where('id',$user_id)->first();
        if(!$update){
               return abort(404);
             }
        $update->update([
            'firstname' => $request->first,
            'middlename' => $request->middle,
            'lastname' => $request->last,
            'company_address' => $request->company_address,
            'email' => $request->email,
            'contact' => $request->contact,
   
        ]);

   $user->update([
            'email' =>$request->email,
        ]);
    return back();


    }

  


}
