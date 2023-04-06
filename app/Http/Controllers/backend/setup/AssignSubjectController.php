<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignSubject;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\SchoolSubject;
use App\Models\StudentBranch;
use App\Models\AssignClasse;
use App\Models\User;

class AssignSubjectController extends Controller
{
    //
    public function ViewAssignSubject(){
        //$data['allData'] =  AssignSubject::all();
        $data['allData'] =  AssignSubject::with('student_class')->select('class_id', 'branch_id')
        ->groupBy('class_id', 'branch_id')
        ->leftjoin('student_classes', 'class_id', '=', 'student_classes.id')
        ->orderBy('student_classes.name')->get();

        return view('backend.setup.assign_subject.view_assign_subject', $data);

    }

    public function AssignSubjectAdd(){
        
        $data['subjects']= SchoolSubject::orderBy('name')->get();
        
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');

        $data['branchs'] = StudentBranch::orderBy('name')->get();

        $data['teachers'] = User::where('designation_id', 1)->orderBy('name')->get();

        return view('backend.setup.assign_subject.add_assign_subject', $data);

    }

    public function AssignSubjectStore(Request $request){
        
        $countSubject = count($request->subject_id);
        if($countSubject != NULL){
            for($i=0; $i< $countSubject; $i++) {

                $check = AssignSubject::where('class_id', $request->class_id)
                ->where('branch_id', $request->branch_id)
                ->where('subject_id', $request->subject_id[$i])->first();
                if ($check  != null) {
                    continue;
                }else {
                    $assign_subject = new AssignSubject();
                    $assign_subject-> class_id = $request->class_id;
                    $assign_subject-> branch_id = $request->branch_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->teacher_id = $request->teacher_id[$i];
                    $assign_subject->coef = $request->subjective_mark[$i];
    
                    $assign_subject->save();
                }
               
            }
        }

        return redirect()-> route('assign.subject.view')->with('success', '');

    }

    public function  AssignSubjectEdit( $class_id, $branch_id=null){

       /*  $data['editData'] =  AssignSubject::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('subject_id', 'asc')->get(); */

        $data['editData'] =  AssignSubject::select('assign_subjects.*')->with('school_subject')
        ->where( 'class_id' ,$class_id)->where('branch_id', $branch_id)
        ->leftjoin('school_subjects', 'assign_subjects.subject_id', '=', 'school_subjects.id')
        ->orderBy('school_subjects.name')->get();
        
        //dd($data['editData']->toArray());
        $data['subjects']= SchoolSubject::orderBy('name')->get();
        $data['teachers'] = User::where('designation_id', 1)->get();
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);

    }

    public function AssignSubjectUpdate(Request $request, $class_id, $jsonId, $branch_id=null){

        $idArray=json_decode($jsonId);
        
        if($request->subject_id == NULL){
            dd('Error');
        }else{
             
            $countSubject = count($request->subject_id);

            $subject_Record =  AssignSubject::where( 'class_id' ,$class_id)
            ->where('branch_id', $branch_id)->get();

           /*  $subject_Record =  AssignSubject::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->get();
 */
            $countRecord = count($subject_Record);

            //dd($request->subject_id);

            if($countSubject == $countRecord){
                for($i=0; $i< $countSubject; $i++) {
                    $assign_subject =  AssignSubject::find($idArray[$i]);
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->branch_id = $request->branch_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->teacher_id = $request->teacher_id[$i];
                    $assign_subject->coef = $request->subjective_mark[$i];
    
                    $assign_subject->save();
                }
            }else{
                
                for($i=0; $i< $countRecord; $i++) {
                    $assign_subject =  AssignSubject::find($idArray[$i]);
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->branch_id = $request->branch_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->teacher_id = $request->teacher_id[$i];
                    $assign_subject->coef = $request->subjective_mark[$i];
    
                    $assign_subject->save();
                }

                for($j=$countRecord; $j< $countSubject; $j++) {

                    $check = AssignSubject::where('class_id', $request->class_id)
                    ->where('branch_id', $request->branch_id)
                    ->where('subject_id', $request->subject_id[$j])->first();
                    if ($check  != null) {
                        continue;
                    }else {
                        $new_assign_subject = new AssignSubject();
                        $new_assign_subject-> class_id = $request->class_id;
                        $new_assign_subject-> branch_id = $request->branch_id;
                        $new_assign_subject->subject_id = $request->subject_id[$j];
                        $new_assign_subject->full_mark = $request->full_mark[$j];
                        $new_assign_subject->teacher_id = $request->teacher_id[$j];
                        $new_assign_subject->coef = $request->subjective_mark[$j];
        
                        $new_assign_subject->save();
                    }
                    
                }
            }
        }
        return redirect()-> route('assign.subject.view')->with('successUpdate', '');

   
    }


    public function  AssignSubjectDetail(Request $request, $class_id, $branch_id=null){


        $data['detailData'] =  AssignSubject::select('assign_subjects.*')->with('school_subject')
        ->where( 'class_id' ,$class_id)->where('branch_id', $branch_id)
        ->leftjoin('school_subjects', 'assign_subjects.subject_id', '=', 'school_subjects.id')
        ->orderBy('school_subjects.type', 'desc')
         ->orderBy('school_subjects.group')->orderBy('school_subjects.name')->get();
         
       /*  $data['detailData'] =  AssignSubject::with('school_subject')->where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        get()->sortBy('school_subject.name' ); */

        
        

        return view('backend.setup.assign_subject.detail_assign_subject', $data);

    }


    public function AssignSubjectDelete($class_id , $branch_id=null){

        AssignSubject::where('class_id' ,$class_id)->where('branch_id', $branch_id)->delete();
           
        return redirect()->route('assign.subject.view');

    }

    public function AssignSubjectDeleteSingle($id){

        $assignsubject = AssignSubject::find($id);
    
        $assignsubject->delete();

     
      /*   $getStudent = AssignStudent::where('class_id',$assignsubject->class_id )->
        where('branch_id',$assignsubject->branch_id )->count('student_id');


        for ($i=0; $i < $getStudent ; $i++) { 
            $getStudents = AssignStudent::where('class_id',$assignsubject->class_id )->
                where('branch_id',$assignsubject->branch_id )->get();

            dd($getStudents[$i]->student_id);
        }
        dd($getStudent);
 */

        return redirect()->back();
    }

}
