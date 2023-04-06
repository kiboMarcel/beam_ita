<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SchoolSubject;
use App\Models\SubjectGroup;

class SchoolSubjectController extends Controller
{
    //
    public function ViewSubjectType(){
        $data['allData'] =  SchoolSubject::orderBy('name')->get();
        return view('backend.setup.school_subject.view_subject_type', $data);

    }


    public function SubjectTypeAdd(){
        

        $data['subject_group'] = SubjectGroup::all();

        return view('backend.setup.school_subject.add_subject_type', $data);

    }


    public function SubjectTypeStore(Request $request){
        
        $countSubject = count($request->name);
        if($countSubject != NULL){
            for($i=0; $i< $countSubject; $i++) {

              

                $data =  new SchoolSubject();               
                $this->validate($request, [
                    'name.'.$i => 'required|unique:school_subjects,name',
                ]);
                if($request->subject_group_id[$i] == 'null'){
                    $subject_group_id = null ;
                }else {
                    $subject_group_id = $request->subject_group_id[$i];
                }

                $data->name = $request->name[$i];
                $data->type = $request->type[$i];
                $data->group =  $subject_group_id;

                $data->save();
            }
        }
        
        //$flash = 'ok';

        return redirect()-> route('subject.type.view')->with('success', '');

    }


    public function  SubjectTypeEdit( $id){
        $data['subject_group'] = SubjectGroup::all();

        $data['editSubject'] =  SchoolSubject::find($id);
        

        return view('backend.setup.school_subject.edit_subject_type', $data);

    }

    public function SubjectTypeUpdate(Request $request, $id){

        $subjectType =  SchoolSubject::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name'.$subjectType->$id,
        ]);

        if($request->subject_group_id == 'null'){
            $subject_group_id = null ;
        }else {
            $subject_group_id = $request->subject_group_id;
        }
        
        $subjectType -> name = $request->name;
        $subjectType->type = $request->type;
        $subjectType->group = $subject_group_id;
        $subjectType -> save();

        return redirect()-> route('subject.type.view')->with('successUpdate', '');

    }


    public function  SubjectTypeDelete(Request $request, $id){

        $subjectType =  SchoolSubject::find($id);
        
        $subjectType -> delete();
        

        return redirect()-> route('subject.type.view');

    }
}
