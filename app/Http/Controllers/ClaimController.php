<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;

class ClaimController extends Controller
{
    

    // index | List

    // store | Save
    public function store(Request $request){
        // dd($request->all());

        Claim::create([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
            'claim_date' => $request->claim_date,
            'claim_type' => $request->employee_type,
            'amount' => $request->amount,
        ]);

        return back();
    }

    public function edit($id){

        // $claim = Claim::where('id',$id)->first();
        $claim = Claim::find($id);

        if(!$claim){
            return abort(404);
        }

       return view('content.pages.claims-edit', ['claim' => $claim]);

    }

    // create | page create


    // update | update
    public function update($id, Request $request){
        $claim = Claim::find($id);

        if(!$claim){
            return abort(404);
        }

        $claim->update([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
            'claim_date' => $request->claim_date,
            'claim_type' => $request->employee_type,
            'amount' => $request->amount,
        ]);

        return back();
    }


    // destroy | delete
    public function destroy($id){
        $claim = Claim::find($id);

        if(!$claim){
            return abort(404);
        }


        $claim->delete();


        return back();
    }

}
