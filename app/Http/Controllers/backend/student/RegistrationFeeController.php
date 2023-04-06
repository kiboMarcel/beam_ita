<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use DB;
use PDF;

class RegistrationFeeController extends Controller
{
    //

    public function ViewRegistrationFee(){


        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        return view('backend.student.reg_fee.view_reg_fee', $data);
    }

    public function RegistrationFeeData(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        if ($branch_id !='') {
            $where[] = ['branch_id','like',$branch_id.'%'];
        }
        $allStudent = AssignStudent::with(['student_branch'])->where($where)->get();
         //dd($allStudent);
        $html['thsource']  = '<th>#</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        /* $html['thsource'] .= '<th>Roll No</th>'; */
        $html['thsource'] .= '<th>Frais </th>';
        /* $html['thsource'] .= '<th>Discount </th>'; */
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $registrationfee = FeeCategoryAmount::where('fee_category_id','1')
            ->where('class_id',$v->class_id)->first();
             //dd($registrationfee);
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
            /* $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>'; */
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'</td>';
            /* $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>'; */
            
           /*  $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee-(float)$discounttablefee; */

            $originalfee = $registrationfee->amount;
            $html[$key]['tdsource'] .='<td>'.$originalfee.' Fcfa'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" 
            title="PaySlip" target="_blanks" href="'.route("student.registration.fee.paySlip").'?class_id='.$v->class_id.'?branch_id='.$v->branch_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }  
       return response()->json(@$html);
    }

    public function RegistrationFeePay(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;

        /* $allStudent['details'] = AssignStudent::with(['student'])
        ->where('student4_id',$student_id)->where('class_id',$student_id)
        ->first(); */

        $allStudent['details'] =  AssignStudent::with(['student'])->
        where('student_id', $student_id)->first();

        //dd($data) ;

        $pdf = PDF::loadView('backend.student.reg_fee.reg_fee_pdf', $allStudent);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
