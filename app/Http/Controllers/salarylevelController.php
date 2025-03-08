<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\salarylevel;
class salarylevelController extends Controller
{
      public function index()
    {
   

       $salarylevel = salarylevel::all(); 
        return view('content.compensation.salary-view',['salarylevel' =>$salarylevel]);
    }



    public function store(Request $request){
        // dd($request->all());

        salarylevel::create([
            'levelname' => $request->levelname,
            'step1' => $request->step1,
             'step2' => $request->step2,
            'step3' => $request->step3,
             'step4' => $request->step4,
             'step5' => $request->step5,
            'step6' => $request->step6,
             'step7' => $request->step7,
             'step8' => $request->step8,
   
        ]);

        return back();
    }



  public function destroy(Request $request)
  {
    $id=$request->salaryid;
    DB::delete("DELETE FROM `hr4_salarylevel`   WHERE salarylevel_id='$id'");

    return back();

  }


}
