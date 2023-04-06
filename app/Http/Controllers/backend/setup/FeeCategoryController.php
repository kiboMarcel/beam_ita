<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    //
    public function ViewFeeCat(){
        $data['allData'] =  FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat', $data);

    }


    public function FeeCatAdd(){
        
        return view('backend.setup.fee_category.add_fee_cat');

    }


    public function FeeCatStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);
        
        $data =  new FeeCategory();

        $data->name = $request->name;
        $data->save();


        return redirect()-> route('fee.category.view')->with('success', '');

    }


    public function  FeeCatEdit( $id){

        $editFeeCat =  FeeCategory::find($id);
        

        return view('backend.setup.fee_category.edit_fee_cat', compact('editFeeCat'));

    }

    public function FeeCatUpdate(Request $request, $id){

        $year =  FeeCategory::find($id);
        
        $year -> name = $request->name;
        $year -> save();

        return redirect()-> route('fee.category.view')->with('successUpdate', '');

    }


    public function  FeeCatDelete(Request $request, $id){

        $class =  FeeCategory::find($id);
        
        $class -> delete();
        

        return redirect()-> route('fee.category.view');

    }
}
