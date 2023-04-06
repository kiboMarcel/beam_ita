<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignClasse;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentBranch;
use App\Models\User;


class AssignClassController extends Controller
{
    public function ViewAssignClass(){
        $data['allData'] =  AssignClasse::select('class_id', 'branch_id')
        ->groupBy('class_id', 'branch_id')
        ->leftjoin('student_classes', 'class_id', '=', 'student_classes.id')
        ->orderBy('student_classes.name')->get();
        return view('backend.setup.assign_class.view_assign_class', $data);

    }

    public function AssignClassAdd(){
        
        $data['classes'] = StudentClass::orderBy('name')->get();
        $data['branchs'] = StudentBranch::orderBy('name')->get();
        $data['groups'] = StudentGroup::orderBy('name')->get();
        $data['teachers'] = User::where('designation_id', 1)->orderBy('name')->get();
        return view('backend.setup.assign_class.add_assign_class', $data);

    }

    public function AssignClassStore(Request $request){
        
        $countBranch = count($request->group_id);
        if($countBranch != NULL){
            for($i=0; $i< $countBranch; $i++) {
                $assign_class = new AssignClasse();
                $assign_class-> class_id = $request->class_id;
                $assign_class->branch_id = $request->branch_id[$i];
                $assign_class->pass_mark = $request->pass_mark[$i];
                $assign_class->teacher_id = $request->teacher_id[$i];
                $assign_class->group_id = $request->group_id[$i];

                $assign_class->save();
            }
        }

        return redirect()-> route('assign.class.view')->with('success', '');

    }

    public function  AssignClassEdit( $class_id, $branch_id=null){
        
        $data['editData'] =  AssignClasse::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('class_id', 'asc')->get();
        //dd($data['editData']->toArray());
        $data['classes'] = StudentClass::all();
        $data['branchs'] = StudentBranch::all();
        $data['teachers'] = User::where('designation_id', 1)->get();
        $data['groups'] = StudentGroup::all();
        return view('backend.setup.assign_class.edit_assign_class', $data);

    }

    public function AssignClassUpdate(Request $request, $class_id , $jsonId, $branch_id=null){
        $idArray=json_decode($jsonId);
        if($request->group_id == NULL){
            dd('Error');
        }else{
             
            $countClass = count($request->group_id);
            $class_Record = AssignClasse::where( [
                [ 'class_id' ,$class_id], 
                ['branch_id', $branch_id]
                ])->get();

            $countRecord = count($class_Record);
            
            if($countClass == $countRecord){
                for($i=0; $i< $countClass; $i++) {
                    $assign_class =  AssignClasse::find($idArray[$i]);
                    $assign_class->class_id = $request->class_id;
                    $assign_class->branch_id = $request->branch_id[$i];
                    $assign_class->pass_mark = $request->pass_mark[$i];
                    $assign_class->teacher_id = $request->teacher_id[$i];
                    $assign_class->group_id = $request->group_id[$i];
    
                    $assign_class->save();
                }
            }else{
                for($i=0; $i< $countRecord; $i++) {
                    $assign_class = AssignClasse::find($idArray[$i]);
                    $assign_class->class_id = $request->class_id;
                    $assign_class->branch_id = $request->branch_id[$i];
                    $assign_class->pass_mark = $request->pass_mark[$i];
                    $assign_class->teacher_id = $request->teacher_id[$i];
                    $assign_class->group_id = $request->group_id[$i];
    
                    $assign_class->save();
                }
               
                
                for($j=$countRecord; $j< $countClass; $j++) {
                    $new_assign_class = new AssignClasse();
                    $new_assign_class->class_id = $request->class_id;
                    $new_assign_class->branch_id = $request->branch_id[$j];
                    $new_assign_class->pass_mark = $request->pass_mark[$j];
                    $new_assign_class->teacher_id = $request->teacher_id[$j];
                    $new_assign_class->group_id = $request->group_id[$j];
    
                    $new_assign_class->save();
                }
            }
        }
        return redirect()-> route('assign.class.view')->with('successUpdate', '');

   
    }

    public function  AssignClassDetail(Request $request, $class_id, $branch_id=null){

        $data['detailData'] =  AssignClasse::where([
            [ 'class_id' ,$class_id], 
            ['branch_id', $branch_id]
            ])->
        orderBy('class_id', 'asc')->get();

        
        

        return view('backend.setup.assign_class.detail_assign_class', $data);

    }

    public function AssignClassDeleteSingle( $id){

       
        $assign_class = AssignClasse::find($id);
        
        $assign_class->delete();

        return redirect()->back();
    }


    public function AssignClassDeleteAll( $id){

       
    }
}
