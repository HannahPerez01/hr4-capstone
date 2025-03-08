<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Recruite;
use App\Models\job_qualification;


class RecruitmentController extends Controller
{

    public function index()
    {
        $Recruite = Recruite::all();
        return view('content.recruitment.recruitment-view', ['Recruite' => $Recruite]);
    }

    public function store(Request $request)
    {
        Recruite::create([
            'jobrole' => $request->jobrole,
            'status' => $request->status,
            'salary' => $request->salary,
            'time' => $request->time,
            'department' => $request->department,
        ]);

        return back();
    }

    public function Recruiteupdate(Request $request)
    {
        $id = $request->recruitment_id_insert;
        $Recruite_update = Recruite::where('recruitment_id', $id);
        if (!$Recruite_update) {
            return abort(404);
        }
        $Recruite_update->update([
            'status' => $request->status_insert,
        ]);
        job_qualification::create([
            'job_request_id' => $request->recruitment_id_insert,
            'status' => $request->status_insert,
        ]);


        return back();
    }

    public function update_request(Request $request)
    {
        $id = $request->recruitment_id_update;
        $Recruite_updates = Recruite::where('recruitment_id', $id);
        if (!$Recruite_updates) {
            return abort(404);
        }
        $Recruite_updates->update([
            'salary' => $request->salary_update,
            'time' => $request->time_update,
            'jobrole' => $request->jobrole_update,
            'department' => $request->department_update,
        ]);

        return back();
    }
}
