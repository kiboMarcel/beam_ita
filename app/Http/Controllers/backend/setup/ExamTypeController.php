<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamType;

class ExamTypeController extends Controller
{
    //
    public function ViewExamType(){
        $data['allData'] =  ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);

    }


    public function ExamTypeAdd(){
        
        return view('backend.setup.exam_type.add_exam_type');

    }


    public function ExamTypeStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name',
        ]);
        
        $data =  new ExamType();

        $data->name = $request->name;
        $data->save();


        return redirect()-> route('exam.type.view')->with('success', '');

    }


    public function  ExamTypeEdit( $id){

        $editExamType =  ExamType::find($id);
        

        return view('backend.setup.exam_type.edit_exam_type', compact('editExamType'));

    }

    public function ExamTypeUpdate(Request $request, $id){

        $examType =  ExamType::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name'.$examType->$id,
        ]);
        
        $examType -> name = $request->name;
        $examType -> save();

        return redirect()-> route('exam.type.view')->with('successUpdate', '');

    }


    public function  ExamTypeDelete(Request $request, $id){

        $examType =  ExamType::find($id);
        
        $examType -> delete();
        

        return redirect()-> route('exam.type.view');

    }
}
