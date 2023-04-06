<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    //
    
        
    public function ViewStudentGroup(){
        $data['allData'] =  StudentGroup::all();
        return view('backend.setup.student_group.view_group', $data);

    }


    public function StudentGroupAdd(){
        
        return view('backend.setup.student_group.add_group');

    }


    public function StudentGroupStore(Request $request){
        
        $countGroup = count($request->name);
        if($countGroup != NULL){
            for($i=0; $i< $countGroup; $i++) {
                $data =  new StudentGroup();
               
                $this->validate($request, [
                    'name.'.$i => 'required|unique:student_groups,name',
                ]);

                $data->name = $request->name[$i];

                $data->save();
            }
        }
        



        return redirect()-> route('student.group.view')->with('success', '');

    }


    public function  StudentGroupEdit( $id){

        $editGroup =  StudentGroup::find($id);
        

        return view('backend.setup.student_group.edit_group', compact('editGroup'));

    }

    public function StudentGroupUpdate(Request $request, $id){

        $year =  StudentGroup::find($id);
        
        $year -> name = $request->name;
        $year -> save();

        return redirect()-> route('student.group.view')->with('successUpdate', '');

    }


    public function  StudentGroupDelete(Request $request, $id){

        $class =  StudentGroup::find($id);
        
        $class -> delete();
        

        return redirect()-> route('student.group.view');

    }
}
