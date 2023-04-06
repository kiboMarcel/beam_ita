<?php

namespace App\Http\Controllers\backend\accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\AssignStudent;
use App\Models\FeeDetail;
use App\Models\Schooling;
use App\Models\Slice;
use App\Models\User;
use App\Models\schoolInfo;

use Carbon\Carbon;
use Cache;
use DB;
use PDF;



class StudentFeeController extends Controller
{
    
    //
    public function ViewStudentFee(){


        $data['feeCategories'] =  FeeCategory::all();
        $data['branchs'] =  StudentBranch::all();
        $data['years'] =  StudentYear::all();

        return view('backend.accounting.student.view_accounting', $data);
    }

    


    public function StudentFeeData(Request $request){
       
      
         $findYear = StudentYear::where('active', 1)->first();
         $findYear->id;
         
         $student =  AssignStudent::select('assign_students.*')->with(['student'])->
         where('users.usertype', 'Student')->where('assign_students.year_id', $findYear->id)->
         where('users.name',  'like', '%' . $request->searchText . '%' )->
         leftjoin('users', 'assign_students.student_id', '=', 'users.id')->get();
         //dd($student);
         if($request->feeCategory == null  ){
 
            $html['h5source']  = '<h5>Sélectionner une option</h5>';
            return response()->json(@$html); 
        }

        if($student->toArray() == null || $request->searchText== '' ){
 
            $html['h5source']  = '<h5>Pas de correspondance</h5>';
            return response()->json(@$html); 
         }
        
        else{
            if ($request->feeCategory == 2 ) {
                 //dd($student->toArray());
                $html['thsource']  = '<th>#</th>';
                $html['thsource'] .= '<th>ID No</th>';
                $html['thsource'] .= '<th> Nom</th>';
                $html['thsource'] .= '<th>Classe</th>';
                $html['thsource'] .= '<th>Ecollage </th>';
                $html['thsource'] .= '<th>Deja payer </th>';
                /* $html['thsource'] .= '<th>Discount </th>'; */
                $html['thsource'] .= '<th>Reste a payer </th>';
                $html['thsource'] .= '<th>Action</th>';
        
    
                foreach ($student as $key => $v) {
                    $schoolingfee = FeeCategoryAmount::where('fee_category_id','2')
                    ->where('class_id',$v->class_id)->first();
        
                    $schooling = Schooling::where('student_id',$v->student_id)->first();
                    //dd($student);
                    $color = 'success';
                    $color2nd = 'info';
        
                    if($schoolingfee == null){
                        $html1['h5source']  = '<h5>Le montant de la
                        classe d\'un ou plusieurs elèves n\'a pas  été attribué- Veuillez le faire dans
                        \'Gestion Globale/ Montant de payment\' </h5>';
                        return response()->json(@$html1); 
                    }
    
                    $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student_class']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.number_format($schoolingfee->amount, 0, ',', ' ').' Fcfa'.'</td>';
                    $html[$key]['tdsource'] .= '<td>'.number_format($schooling->payed,  0, ',', ' ').' Fcfa'.'</td>';
                    /* $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>'; */
                    
                    /*  $originalfee = $registrationfee->amount;
                    $discount = $v['discount']['discount'];
                    $discounttablefee = $discount/100*$originalfee;
                    $finalfee = (float)$originalfee-(float)$discounttablefee; */
        
                    $mustpayed = $schoolingfee->amount -  $schooling->payed;
                    
                    $html[$key]['tdsource'] .='<td>'.number_format($mustpayed, 0, ',', ' ').' Fcfa'.'</td>';
                    $html[$key]['tdsource'] .='<td>';
                    if( $schooling->payed == $schoolingfee->amount){
                        $html[$key]['tdsource'] .='<a class="btn btn-sm disabled btn-'.$color.'" 
                        title="Pay" target="_blanks" >En regle</a>';
                    }else{
                        $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color2nd.' disabled" 
                    title="Pay" target="_blanks" href="#">Payer</a>';
                    }
                    
                    $html[$key]['tdsource'] .= '</td>';
 
                } 

                return response()->json(@$html); 
            }else {
                
                $html['thsource']  = '<th>#</th>';
                $html['thsource'] .= '<th>ID No</th>';
                $html['thsource'] .= '<th> Nom</th>';
                $html['thsource'] .= '<th>Classe</th>';
                $html['thsource'] .= '<th>Montant </th>';
                /* $html['thsource'] .= '<th>Discount </th>'; */
                $html['thsource'] .= '<th>Action</th>'; 

                foreach ($student as $key => $v) {
                    $studentfee = FeeCategoryAmount::where('fee_category_id',$request->feeCategory)
                    ->where('class_id',$v->class_id)->first();
        
                   // $schooling = Schooling::where('student_id',$v->student_id)->first();
                    //dd($student);
                    $color2nd = 'info';
                    
                    if($studentfee == null){
                        $html1['h5source']  = '<h5>La montant de la
                         classe d\'un ou plusieurs elèves n\'a pas  été attribué- Veuillez le faire dans
                         \'Gestion Globale/ Montant de payment\' </h5>';
                        return response()->json(@$html1); 
                    }
                   
                   
                    $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student_class']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'. number_format($studentfee->amount, 0, ',', ' ').' Fcfa'.'</td>';
                             
                    $html[$key]['tdsource'] .='<td>'. '<a class="btn btn-sm btn-'.$color2nd.'" 
                    title="Pay" target="_blanks" 
                     href="'.route("student.fee.pay",[$v->student_id, $request->feeCategory ]).'?student_id='.$v->student_id.
                     '?feeCategory_id='.$request->feeCategory.'">Payer</a>' . '</td>';
                   
                   
                   
 
                } 
            }  
            return response()->json(@$html); 
          
        }
        
    }

    public function StudentOtherFeePayment(Request $request, $student_id, $feeCategory_id ){


        $data['student'] =  AssignStudent::with(['student'])->where('student_id', $student_id)
        ->first();

        $data['class_id'] = $data['student']->class_id;
        $data['branch_id'] = $data['student']->branch_id;
        
        

        $data['studentOtherfee'] = FeeCategoryAmount::where('fee_category_id',$feeCategory_id)
        ->where('class_id',$data['student']->class_id)->first();

        $check_fee = FeeDetail::where('feeCategory_id', $feeCategory_id)->first();

      
        if($check_fee != null){
            
            $check_fee->amount = $check_fee->amount + $data['studentOtherfee']->amount ; 
            $check_fee->total_operation = $check_fee->total_operation + 1 ;

            $check_fee->save();
        }else {
            $fee_detail = new FeeDetail();

            $fee_detail->feeCategory_id = $feeCategory_id ;
            $fee_detail->amount = $data['studentOtherfee']->amount ;
            $fee_detail->total_operation = 1 ;

            $fee_detail->save();
        }
        
        //CACHING DAY OPERATION
        $day_operation = Cache::get('countpayment');
        $date = Carbon::now();
        //Get date and time
        $date->toDateTimeString();
        $time = 24 - $date->hour;
        $time;
        if($day_operation==null){
            Cache::put('countpayment', 1, now()->addMinutes($time));
        }else{
           
            Cache::increment('countpayment');
        }
      
        
       

            $data['school_info'] =  schoolInfo::where('id', 1)->first();

            $pdf = PDF::loadView('backend.accounting.student.payment_pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
     
        

    }

}
