<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\Slice;

class SlicePaymentController extends Controller
{
    //

    public function ViewSlice(){
        //$data['allData'] =  FeeCategoryAmount::all();
        /* $data['allData'] =  Slice::select('slice_amount')->
        with(['student_class'])->groupBy('class_id')->get(); */
        
        $data['allData'] =  Slice::select('class_id')->groupBy('class_id')->get();

        //dd($data['allData']);
        return view('backend.setup.slice.view_slice', $data);

    }

    public function SliceAdd(){
        
        $data['fee_categories']= FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.slice.add_slice', $data);

    }

    public function SliceStore(Request $request){
        
        $class_id = $request->class_id;
        $countslice = count($request->slice_amount);
        $amount = FeeCategoryAmount::where('fee_category_id', 2)->where('class_id',$class_id)->first();
        //$val = floatval($amount);
        $sum=0;

        for($i=0; $i< $countslice; $i++) {
            $sum = $sum +  $request->slice_amount[$i];
            }
        //dd($amount->amount);
            if(floatval($sum) > floatval($amount->amount)){
                dd('la somme des tranches est superieur a lEcollage');
            }elseif( floatval($sum) < floatval($amount->amount) ){
                dd('la somme des tranche est inferieur a lEcollage');
            }else {
                if($class_id != NULL){
                    for($i=0; $i< $countslice; $i++) {
                    $slice = new Slice();
                    $slice-> fee_category_id = $request->category_id;
                    $slice->class_id = $request->class_id;
                    $slice->slice_amount = $request->slice_amount[$i];
                    $sum = $sum +  $request->slice_amount[$i];
        
                    $slice->save();
                    }
                    //dd( $sum );
                }
            }

       

        return redirect()-> route('slice.view')->with('success', '');

    }

    public function SliceDetail(Request $request, $class_id){
        
        $data['detailData'] =  Slice::where( 'class_id' ,$class_id)->
        orderBy('class_id', 'asc')->get();
  

        return view('backend.setup.slice.detail_slice', $data);
    }

}
