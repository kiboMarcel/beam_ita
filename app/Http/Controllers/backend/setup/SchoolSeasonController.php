<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SchoolSeason;

class SchoolSeasonController extends Controller
{
    public function ViewSeason(){
        $data['allData'] =  SchoolSeason::where('id', 1)->get();
        return view('backend.setup.season.view_season', $data);

    }


    public function SeasonAdd(){
        
        return view('backend.setup.season.add_season');

    }


    public function SeasonStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|unique:school_seasons,name',
        ]);
        
        $data =  new SchoolSeason();
        $data->name = $request->name;

        $data->save();


        return redirect()-> route('season.view')->with('success', '');

    }


    public function  SeasonEdit( $id){

        $editSeason =  SchoolSeason::find($id);
        

        return view('backend.setup.season.edit_season', compact('editSeason'));

    }

    public function SeasonUpdate(Request $request, $id){

        $season =  SchoolSeason::find($id);

        $validateData = $request->validate([
            'name' => 'required|unique:school_seasons,name'.$season->$id,
        ]);
        
        $season -> name = $request->name;
        $season -> save();

        return redirect()-> route('season.view')->with('successUpdate', '');

    }


    public function  SeasonDelete(Request $request, $id){

        $season =  SchoolSeason::find($id);
        
        $season -> delete();
        

        return redirect()-> route('season.view');

    }
}
