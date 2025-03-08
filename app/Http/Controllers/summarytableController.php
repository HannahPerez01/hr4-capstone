<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\summarytable ;
use Illuminate\Support\Facades\DB;
class summarytableController extends Controller
{
    

      public function index()
    {
   

       $summary= summarytable::all(); 
        return view('content.compensation.summary-view',['summary' =>$summary]);
    }



    public function store(Request $request){
        // dd($request->all());

    summarytable ::create([
            'basic_pay' => $request->basic_pay,
            'restday' => $request->restday,
             'regularday' => $request->regularday,
            'allowance' => $request->allowance,
             'bonuses' => $request->bonuses,
             'fringe_benefit' => $request->fringe_benefit,
            'totalcompensation' => $request->totalcompensation,
              'position_id' => $request->jobposition,
   
        ]);

        return back();
    }


      public function destroy(Request $request)
  {
    $id=$request->summary_id;
    DB::delete("DELETE FROM `hr4_summary_table`   WHERE summary_id='$id'");

    return back();

  }

}
