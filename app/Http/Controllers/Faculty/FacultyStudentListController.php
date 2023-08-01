<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentList;
use App\Models\AcademicYear;


class FacultyStudentListController extends Controller
{
    //

    public function index($sid, $fid){
        return view('faculty.faculty-student-list')
            ->with('sid', $sid)
            ->with('fid', $fid);
    }

    public function getStudentLists(Request $req){
        $sort = explode('.', $req->sort_by);

        $sId = $req->sid;
        $fId = $req->fid;

        $ay = AcademicYear::where('active', 1)->first();

        return StudentList::with(['academicYear', 'schedule', 'faculty', 'student', 'student.program'])
            ->where('academic_year_id', $ay->academic_year_id)
            ->where('faculty_id', $fId)
            ->where('schedule_id', $sId)
            ->whereHas('student', function($q) use ($req){
                $q->where('lname', 'like', '%' . $req->name . '%')
                    ->orderBy('lname',  'asc');
            })
            ->get();
    }

    public function addStudent(Request $req){
        $ay = AcademicYear::where('active', 1)->first();

        StudentList::updateOrCreate([
            'academic_year_id' => $ay->academic_year_id,
            'schedule_id' => $req->schedule_id,
            'student_id' => $req->student_id,
        ],
        [
            'academic_year_id' => $ay->academic_year_id,
            'schedule_id' => $req->schedule_id,
            'faculty_id' => $req->faculty_id,
            'student_id' => $req->student_id,
        ]);
       

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
