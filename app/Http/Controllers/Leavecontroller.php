<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
class Leavecontroller extends Controller
{
    

    public function store(Request $request){
        // dd($request->all());

        Leave::create([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name,
             'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return back();
    }
    
public function Leaveupdate(Request $request){
$id=$request->employee_id;
 $leave = Leave::where('id',$id)->first();
        if(!$leave){
               return abort(404);
             }
        $leave->update([
            'employee_id' => $request->employee_id,
            'employee_name' => $request->employee_name_update,
             'leave_type' => $request->leave_type_update,
            'start_date' => $request->start_date_update,
            'end_date' => $request->end_date_update,
        ]);
    return back();
    }

    public function destroy($id){
        $Leave=  Leave::find($id);

        if(!$Leave){
            return abort(404);
        }


        $Leave->delete();


        return back();
    }


}
