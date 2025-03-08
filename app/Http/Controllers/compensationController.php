<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\compensation;
class compensationController extends Controller
{
   
   public function index()
  {


    $compensation = compensation::all(); 

   return view('content.compensation.compensation-view',['compensation' => $compensation]);
}

    public function store(Request $request){
        // dd($request->all());

        compensation::create([
            'employee_id' => $request->employee_id,
            'project_name' => $request->project_name,
             'compensation_type' => $request->compensation_type,
            'amount' => $request->amount,
        ]);

        return back();
    }
    


   }
