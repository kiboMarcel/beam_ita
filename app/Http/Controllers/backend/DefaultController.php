<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\StudentMarks;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\AssignClasse;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\StudentFinalAVG;

use DB;

class DefaultController extends Controller
{
    public function MarksGetSubjects(Request $request){

        $class_id = $request->class_id;
        $branch_id = $request->branch_id;

        $allData = AssignSubject::with(['school_subject'])->where('class_id', $class_id)
        ->where('branch_id', $branch_id)->get();

        return response()->json($allData);
    }


    public function GetSutudents(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;

        $allData =  AssignStudent::select('assign_students.*')
            ->with(['student', 'student_class', 'student_branch', 'student_group'])
            ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
            ->where('branch_id', $branch_id)
            ->leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name')->get();

        

       /*  $allData = AssignStudent::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('branch_id', $branch_id)->get(); */
        
        return response()->json($allData);
    }


    public function GetSutudentForMarksheet(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;
        $season_id = $request->season_id;

        $allData = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('branch_id', $branch_id)->where('season_id', $season_id)
        ->leftjoin('users', 'student_marks.student_id', '=', 'users.id')->orderBy('users.name')
        ->groupBy('student_id')->get();

        
       
        return response()->json($allData);
    }


    public function GetClassBranch(Request $request){

        $class_id = $request->class_id;
       

        $check = AssignClasse::with(['student_class', 'student_branch', 'student_group'])
        ->where('class_id', $class_id)/* ->groupBy('branch_id') */->get();
       
       if($check[0]->branch_id== null){
        $allData = AssignClasse::with(['student_class', 'student_branch', 'student_group'])
        ->where('class_id', $class_id)->get();
       }else {
        $allData = AssignClasse::with(['student_class', 'student_branch', 'student_group'])
        ->where('class_id', $class_id)->groupBy('branch_id')->get();
       }
       //dd($allData);
        return response()->json($allData);
    }


    public function GetClassGroup(Request $request){

        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
       

        $allData = AssignClasse::with(['student_class', 'student_branch', 'student_group'])
        ->where('class_id', $class_id)->where('branch_id', $branch_id)->get();
       
        return response()->json($allData);
    }


    public function GetClass(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;
        $season_id = $request->season_id;

        $allData =  StudentFinalAVG::select('class_id','branch_id','group_id')
            ->with(['student_class', 'student_branch', 'student_group'])
            ->where('year_id', $year_id)->where('class_id', $class_id)
            ->where('branch_id', $branch_id)->where('group_id', $group_id)
            ->where('season_id', $season_id)
            /* ->leftjoin('users', 'student_final_a_v_g_s.student_id', '=', 'users.id')
            ->orderBy('final_avg') */
            ->groupBy('class_id')->groupBy('branch_id')->groupBy('group_id')->get();

       

       /*  $allData = AssignStudent::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('branch_id', $branch_id)->get(); */
        
        return response()->json($allData);
    }


    public function GetSeason(Request $request){

        $class_id = $request->class_id;

        $allData =  StudentClass::find($class_id);

        return response()->json($allData);
    }
}
