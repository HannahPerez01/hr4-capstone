<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\basicrate;
class basicController extends Controller
{
      public function index()
    {
   
        $basic= basicrate::all(); 
        return view('content.compensation.basicrate-view',['basic'=>$basic]);
    }


        public function store(Request $request){
        // dd($request->all());
        basicrate::create([
       'basic_pay_range'=>$request->basic_pay_range,
       'daily_rate'=>$request->daily_rate,
       'hourly_rate'=>$request->hourly_rate ,
       'position_id'=>$request->position,  
        ]);
        return back();
    }



public function destroy(Request $request){
    $id=$request->basicrate_id;
    DB::delete("DELETE FROM hr4_basicrate  WHERE basicrate_id='$id'");
    return back();
  }

}
