<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentYear;

class StudentYearController extends Controller
{
    //

    
    public function ViewStudentYear(){
        $data['allData'] =  StudentYear::all();
        return view('backend.setup.student_year.view_year', $data);

    }


    public function StudentYearAdd(){
        
        return view('backend.setup.student_year.add_year');

    }


    public function StudentYearStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);
        
        $data =  new StudentYear();

        $data->name = $request->name;
        $data->save();


        return redirect()-> route('student.year.view')->with('success', '');

    }


    public function  StudentYearEdit( $id){

        $editYear =  StudentYear::find($id);
        

        return view('backend.setup.student_year.edit_year', compact('editYear'));

    }

    public function StudentYearUpdate(Request $request, $id){

        $year =  StudentYear::find($id);
        
        $year -> name = $request->name;
        $year -> save();

        return redirect()-> route('student.year.view')->with('successUpdate', '');

    }


    public function  StudentYearActive(Request $request, $id){

        $class =  StudentYear::find($id);

        $class_deactivate =  StudentYear::where('active', 1)->first();

        
        if($class_deactivate != null){
            $class_deactivate ->active = 0; 
            $class_deactivate -> save();
        }

        $class ->active = 1;

       
        $class -> save();

        return redirect()-> route('student.year.view')->with('successActive', '');

    }

    public function  StudentYearDelete(Request $request, $id){

        $class =  StudentYear::find($id);
        
        $class -> delete();
        

        return redirect()-> route('student.year.view');

    }
}
