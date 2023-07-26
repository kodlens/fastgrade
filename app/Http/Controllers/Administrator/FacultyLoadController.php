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
    public function index($id){
        $user = user::where('user_id', $id)->first();
        $acadYears = AcademicYear::orderBy('academic_year_code', 'desc')->get();

        return view('administrator.faculty.faculty-load')
            ->with('user', $user)
            ->with('acadYears', $acadYears);

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

        $sched = Schedule::with(['course', 'program'])
            ->where('academic_year_id', $ayid)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $sched;
    }

}
