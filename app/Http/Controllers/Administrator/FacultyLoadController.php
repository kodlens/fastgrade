<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\User;
use App\Models\Schedule;

class FacultyLoadController extends Controller
{
    //
    public function index(){
        return view('administrator.faculty_load.faculty-load');
    }


    public function getData(Request $req){
        $ay = AcademicYear::where('active', 1)->first();

        $sort = explode('.', $req->sort_by);

        $data = User::with(['faculty_loads'])
            ->where('lname', 'like', $req->lname . '%')
            ->where('role', 'FACULTY')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function getModalSchedules(Request $req){
        
        $ayid = $req->ayid;
        $sort = explode('.', $req->sort_by);

        $sched = Schedule::where('academic_year_id', $ayid)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $sched;
    }

}
