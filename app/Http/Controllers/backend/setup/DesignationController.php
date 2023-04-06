<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Designation;

class DesignationController extends Controller
{
    //
    public function ViewDesignation(){
        $data['allData'] =  Designation::all();
        return view('backend.setup.designation.view_designation', $data);

    }


    public function DesignationAdd(){
        
        return view('backend.setup.designation.add_designation');

    }


    public function DesignationStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        
        $data =  new Designation();

        $data->name = $request->name;
        $data->save();


        return redirect()-> route('designation.view');

    }


    public function  DesignationEdit( $id){

        $editDesignation =  Designation::find($id);
        

        return view('backend.setup.designation.edit_designation', compact('editDesignation'));

    }

    public function DesignationUpdate(Request $request, $id){

        $designation =  Designation::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:designations,name'.$designation->$id,
        ]);
        
        $designation -> name = $request->name;
        $designation -> save();


        return redirect()-> route('designation.view')->with('success', '');  

    }


    public function  DesignationDelete(Request $request, $id){

        $designation =  Designation::find($id);
        
        $designation -> delete();
        

        return redirect()-> route('designation.view');

    }
}
