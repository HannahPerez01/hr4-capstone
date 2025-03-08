<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift_and_schedule;
class ShiftandschedulingController extends Controller
{
    



    

    public function store(Request $request){
        // dd($request->all());

        Shift_and_schedule::create([
            'employee_id' => $request->employee_id,
             'shift_start' => $request->shift_start,
             'shift_end' => $request->shift_end,
            'shift_type' => $request->shift_type,
        ]);

        return back();
    }


    public function destroy($id){
        $Leave=  Shift_and_schedule::find($id);

        if(!$Leave){
            return abort(404);
        }


        $Leave->delete();


        return back();
    }


public function update(Request $request){
$ids=$request->employee_id_update;
$gg=$request->shift_start_update;
 $Shift_and_schedule = Shift_and_schedule::where('employee_id',$ids)->first();
        if(!$Shift_and_schedule){

        }
        $Shift_and_schedule->update([
            'shift_start' => $request->shift_start_update,
            'shift_end' => $request->shift_end_update,
            'shift_type' => $request->shift_type_update,
        ]);
    return back();
    }




}


