<?php

namespace App\Http\Controllers\backend\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AssignClasse;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\AssignSubject;
use App\Models\Decision;


class ExamDecisionController extends Controller{
    //

    public function DecisionAdd(){

        $data['years'] = StudentYear::all();
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();

        return view('backend.s_report.exam_decision.exam_decision_add', $data);
    }


    public function DecisionGetSutudents(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;
        $allData;

        $check =  Decision::select('decisions.*')
            ->with(['student', 'student_class', 'student_branch', 'student_group'])
            ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
            ->where('branch_id', $branch_id)
            ->leftjoin('users', 'decisions.student_id', '=', 'users.id')
            ->orderBy('users.name')->get();

        if(count($check->toArray()) != null) {
            //dd('not null');
            $allData = $check;
        }else{
            $allData =  AssignStudent::select('assign_students.*')
            ->with(['student', 'student_class', 'student_branch', 'student_group'])
            ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
            ->where('branch_id', $branch_id)
            ->leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name')->get();
        }

            
      
        
        return response()->json($allData);
    }

    public function DecisionStore(Request $request){
        $studenCount = $request->student_id;

        //dd($request->decision);
        if($studenCount){
            for ($i=0 ; $i<count($studenCount) ; $i++){
                
                $checkdecision =  Decision::where('year_id', $request->year_id)
                    ->where('student_id', $request->student_id[$i])
                    ->where('class_id', $request->class_id)
                    ->where('group_id', $request->group_id)
                    ->where('branch_id', $request->branch_id)->get(); //CHECK IF NOT EXIT

                if($checkdecision->toArray() != null){

                    $update = Decision::where('year_id', $request->year_id)
                    ->where('student_id', $request->student_id[$i])
                    ->where('class_id', $request->class_id)
                    ->where('group_id', $request->group_id)
                    ->where('branch_id', $request->branch_id)->delete();

                    $data = new Decision();
                    $data->year_id = $request->year_id;
                    $data->class_id = $request->class_id;
                    $data->branch_id = $request->branch_id;
                    $data->group_id = $request->group_id;
                    $data->student_id = $request->student_id[$i];
                    $data->decision = $request->decision[$i];
    
                    $data->save();

                }else{
                    
                    $data = new Decision();
                    $data->year_id = $request->year_id;
                    $data->class_id = $request->class_id;
                    $data->branch_id = $request->branch_id;
                    $data->group_id = $request->group_id;
                    $data->student_id = $request->student_id[$i];
                    $data->decision = $request->decision[$i];
    
                    $data->save();
                }

               
            }
        }

        return redirect()->back()->with('success', '');
    }


}
