<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\deduction;
class DeductionController extends Controller
{
    public function index()
  {



    $deduction = deduction::all(); 

   return view('content.payroll.deduction',['deduction' => $deduction]);

}



    public function store(Request $request){
        // dd($request->all());

        deduction::create([
            'employee_id' => $request->employee_id,
            'sss' => $request->sss,
            'pagibig' => $request->pagibig,
            'philhealth' => $request->philhealth,
        ]);

        return back();
    }
    



}
