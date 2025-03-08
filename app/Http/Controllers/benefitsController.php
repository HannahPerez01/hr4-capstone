<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\benefits;
use Illuminate\Support\Facades\DB;
class benefitsController extends Controller
{
      public function index()
    {
   
    $benefits = DB::select("select  * FROM `hr4_benefits` where  position_id='' ");
            return view('content.compensation.benefit-view',['benefits' =>$benefits]);
    }



    public function store(Request $request){
        // dd($request->all());

        benefits::create([
            'component' => $request->component,
             'detail' => $request->detail,
                'position_id'=>$request->position,
     
     
   
        ]);

        return back();
    }



    public function showdata(Request $request){
        // dd($request->all());
$id=$request->position;
      $benefits = DB::select("select  * FROM `hr4_benefits` where  position_id='$id' ");
    return view('content.compensation.benefit-view',['benefits' =>$benefits]);

    }


}
