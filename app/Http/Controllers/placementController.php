<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\applicant;
use Illuminate\Support\Facades\DB;
class placementController extends Controller
{
        public function index()
  {

  $employee = DB::select("select  * FROM core1_employee");

   return view('content.core.placement-view',['employee' => $employee]);

}


       public function store(Request $request){
        // dd($request->all());


            if($request->file('image')){
            $file= $request->file('image');
            $filename=$file->getClientOriginalName();
            $file-> move(public_path('assets\img'), $filename);
            $data['image']= $filename;
            $get=$_FILES["image"]["name"];


 $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

   $random =substr(str_shuffle(str_repeat($pool, 5)), 0, 8);
        applicant::create([
            'employee_code' => $random,
            'firstname' => $request->first,
            'lastname' => $request->last,
            'middlename' => $request->middle,
            'email'=> $request->email,
            'contact' => $request->contact,
            'description' => $request->description,
            'image' => $get,
            'position' => $request->role,
            'trainee_fee' => $request->training_fee,]);
        }


        return back();




    }

public function update(Request $request){
$id=$request->employee_id;
 $app = applicant::where('employee_id',$id);
        if(!$app){
               return abort(404);
             }
        $app->update([
            'status' =>'post',
   
        ]);
    return back();
    }


}
