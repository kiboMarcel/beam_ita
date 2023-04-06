<?php

namespace App\Http\Controllers\backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentMarks;

use App\Models\User;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\AssignClasse;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\SchoolSeason;
use App\Models\Student_final_mark;
use App\Models\StudentFinalAVG;
use App\Models\StudentAttendance;
use App\Models\schoolInfo;
use App\Models\Responsible;
use App\Models\annualAVG;
use App\Models\SubjectTeacher;

use DB;
use PDF;


class ClassMarkSheetController extends Controller
{
    public function ClassMarkSheetView(){
        $data['years'] = StudentYear::all();
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        $data['exam_types'] = ExamType::all();
        $data['seasons'] = SchoolSeason::all();

        return view('backend.s_report.class_marksheet.view_class_marksheet', $data);
    }


    public function ClassMarkSheetList($year_id, $class_id, $group_id, $season_id, $branch_id= null){
        
        ini_set('max_execution_time', 180); //3 minutes
        
        if ($branch_id == 'null') {
            $branch_id = null;
        }

        $data['allData'] = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('branch_id', $branch_id)->where('season_id', $season_id)
        ->leftjoin('users', 'student_marks.student_id', '=', 'users.id')->orderBy('users.name')
        ->groupBy('student_id')->get();
       
        

        $data['year_id'] =  $year_id;
        $data['class_id'] =  $class_id;
        $data['branch_id'] =  $branch_id;
        $data['group_id'] =  $group_id;
        $data['season_id'] =  $season_id;
        


        //ClassTeacher
        $data['classTeacher'] = AssignClasse::where('class_id',$class_id)->
        where('branch_id',$branch_id)->where('group_id',$group_id)->first();

       
        

        //count student
        
        $data['totalStudent'] = AssignStudent::where('class_id', $class_id)
        ->where('branch_id', $branch_id)->where('group_id', $group_id)->where('year_id', $year_id)->count();
        
      
        //get subject
        $data['subjects'] = AssignSubject::select('assign_subjects.*')->with('school_subject')
        ->where( 'class_id' ,$class_id)->where('branch_id', $branch_id)
        ->leftjoin('school_subjects', 'assign_subjects.subject_id', '=', 'school_subjects.id')
        ->orderBy('school_subjects.type', 'desc')->orderBy('school_subjects.group')
        ->orderBy('school_subjects.name')->get();

        $getStudents = AssignStudent::where('class_id',$class_id)
        ->where('branch_id',$branch_id)->where('group_id',$group_id)
        ->where('year_id', $year_id)->get();

        //dd($getStudents);
       

         //max avg of the class -- Moyenne Max du trimestre de la classe
         $data['marks_avg_max'] = StudentFinalAVG::where('year_id', $year_id)
         ->where('class_id', $class_id)->where('branch_id', $branch_id)
         ->where('group_id', $group_id)->where('season_id', $season_id)->max('final_avg');
 
         //min avg of the class -- Moyenne Min du trimestre de la classe
         $data['marks_avg_min'] = StudentFinalAVG::where('year_id', $year_id)
         ->where('class_id', $class_id)->where('branch_id', $branch_id)
         ->where('group_id', $group_id)->where('season_id', $season_id)->min('final_avg');
         
         $data['class_avg'] = ($data['marks_avg_min'] + $data['marks_avg_max']) /2;

        

        //get coef sum
        $data['coefSum'] = AssignSubject::where('class_id', $class_id)
        ->where('branch_id', $branch_id)->sum('coef');

        
        

            $data['school_info'] =  schoolInfo::where('id', 1)->first();

            $data['responsible'] =  Responsible::where('id', 1)->first();
           
            //PORTRAIT FORMAT
            $pdf = PDF::loadView('backend.s_report.class_marksheet.class_marksheet_list_pdf', $data, 
            [], 
            [ 
              'title' => 'Releve de note', 
              
            ]);
            
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        
        
    
    }

  
}

