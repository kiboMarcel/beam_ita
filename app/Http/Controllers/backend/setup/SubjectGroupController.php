<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SubjectGroup;

class SubjectGroupController extends Controller
{
    //
    public function ViewSubjectGroup(){
        $data['allData'] = SubjectGroup::all();
        return view('backend.setup.school_subject_group.view_subject_group', $data);

    }

    public function SubjectGroupAdd(){

        return view('backend.setup.school_subject_group.add_subject_group');

    }


    public function SubjectGroupStore(Request $request){

                $data =  new SubjectGroup();               
                $this->validate($request, [
                    'name' => 'required|unique:subject_groups,name',
                ]);

                $data->name = $request->name;

                $data->save();
          
        
        return redirect()->route('subject.group.view')->with('success', '');

    }


    public function SubjectGroupEdit($id){

        $data['editSubjectGroup'] =  SubjectGroup::find($id);
        
        return view('backend.setup.school_subject_group.edit_subject_group', $data);

    }

    public function SubjectGroupUpdate(Request $request, $id){

        $subjectType =  SubjectGroup::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:subject_groups,name',
        ]);
        
        $subjectType->name = $request->name;

        $subjectType->save();
  
        return redirect()->route('subject.group.view')->with('successUpdate', '');

    }

    public function  SubjectGroupDelete(Request $request, $id){

        $subjectType =  SubjectGroup::find($id);
        
        $subjectType -> delete();
        

        return redirect()-> route('subject.group.view');

    }
}
