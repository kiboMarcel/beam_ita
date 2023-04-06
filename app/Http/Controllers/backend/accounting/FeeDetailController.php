<?php

namespace App\Http\Controllers\backend\accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\AssignClasse;
use App\Models\StudentGroup;
use App\Models\FeeDetail;
use App\Models\SchoolSeason;
use App\Models\Slice;
use App\Models\User;
use Cache;

class FeeDetailController extends Controller
{
    //
    public function ViewFeeDetail(){

      
        $data['feeDetails'] = FeeDetail::with('fee_category')->get();
        $data['today_payment_opreation'] = Cache::get('countpayment');
        $data['today_schooling_opreation'] = Cache::get('countschoolingpayment');

        return view('backend.accounting.global_fee.view_fee', $data);
    }

    public function ResetOperationCount($id){

        $resetOperation = FeeDetail::find($id);
        $resetOperation->total_operation = 0;

        $resetOperation->save();
       

        return redirect()->back();
    }

    public function ResetAmountCount($id){

        $resetAmount = FeeDetail::find($id);
        $resetAmount->amount = 0;

        $resetAmount->save();
       

        return redirect()->back();
    }

}
