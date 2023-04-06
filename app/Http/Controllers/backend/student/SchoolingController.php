<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use App\Models\AssignStudent;
use App\Models\Schooling;
use App\Models\FeeDetail;
use App\Models\Slice;
use App\Models\User;
use App\Models\schoolInfo;

use Carbon\Carbon;
use Cache;
use DB;
use PDF;

class SchoolingController extends Controller
{
    //
    public function ViewSchooling(){


        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['years'] =  StudentYear::all();

        return view('backend.student.schooling_fee.view_schooling_fee', $data);
    }
    

    public function SchoolingData(Request $request){
        
       /*  $year_id = $request->year_id;
        $class_id = $request->class_id; */
        //dd($request->searchText);
        /* if ($search !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        } */
        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

        $student =  AssignStudent::select('assign_students.*')->with(['student'])->
        where('users.usertype', 'Student')->where('assign_students.year_id', $findYear->id)->
        where('users.name',  'like', '%' . $request->searchText . '%' )->
        leftjoin('users', 'assign_students.student_id', '=', 'users.id')->get();
        //dd($student);

        if($student->toArray() == null || $request->searchText== '' ){

            $html['h5source']  = '<h5>Pas de correspondance</h5>';
            return response()->json(@$html); 
        }
        else{
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

            $schooling = Schooling::where('student_id',$v->student_id)
            ->where('year_id', $findYear->id)->first();
             //dd($student);
            $color = 'success';
            $color2nd = 'info';

            if($schoolingfee == null){
                $html1['h5source']  = '<h5>La scolarité de la
                 classe d\'un ou plusieurs elèves n\'a pas été attribué- Veuillez le faire dans
                 \'Gestion Globale/ Montant de payment\' </h5>';
                return response()->json(@$html1); 
            }

           $amount = number_format($schoolingfee->amount, 0, ',', '.');
           

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
                $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color2nd.'" 
            title="Pay" target="_blanks" href="'.route("student.schooling.pay",[$v->student_id, ]).'?student_id='.$v->student_id.'">Payer</a>';
            }
            
            $html[$key]['tdsource'] .= '</td>';

        } 
        return response()->json(@$html); 
    }
       
    }

    public function SchoolingPaymentView(Request $request, $student_id){


        $data['student'] =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();
        //dd($student);
        $data['classes'] =  StudentClass::orderBy('name', 'asc')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['years'] =  StudentYear::all();

        return view('backend.student.schooling_fee.pay_schooling', $data);
    }
   
    public function SchoolingPayementStore(Request $request, $student_id ){

        switch ($request->action) {
            case 'payer':

                $findYear = StudentYear::where('active', 1)->first();
                $findYear->id;
        
                $data['student'] =  AssignStudent::with(['student'])
                ->where('student_id', $student_id)->where('year_id', $findYear->id)
                ->first();
        
                $data['class_id'] = $data['student']->class_id;
                $data['branch_id'] = $data['student']->branch_id;
                
                
        
                $data['schoolingfee'] = FeeCategoryAmount::where('fee_category_id','2')
                ->where('class_id',$data['student']->class_id)->first();
                
                //$schoolingfee->amount
                $data['paying'] =$request->schooling_fee;
        
               
        
                $data['get_paid_fee'] = Schooling::where('student_id', $student_id)
                ->where('class_id', $data['student']->class_id)
                ->where('year_id',$findYear->id)->first();
        
                
                $data['new_fee'] = $data['get_paid_fee']->payed + $data['paying'];
        
        
                if(($data['paying'] > $data['schoolingfee']->amount) || ($data['new_fee'] > $data['schoolingfee']->amount)){
                    dd('montant supérieur à la somme restante ');
                }else{
        
                    //GLOBAL FEE ADD
                    $check_fee = FeeDetail::where('feeCategory_id', '2')->first();
        
                    
                    if($check_fee != null){
                        
                        $check_fee->amount =  $check_fee->amount + $data['paying'] ; 
                        $check_fee->total_operation = $check_fee->total_operation + 1 ;
            
                        $check_fee->save();
                    }else {
                        $fee_detail = new FeeDetail();
            
                        $fee_detail->feeCategory_id = '2' ;
                        $fee_detail->amount = $data['paying'] ;
                        $fee_detail->total_operation = 1 ;
            
                        $fee_detail->save();
                    }
        
        
                    $data['school_info'] =  schoolInfo::where('id', 1)->first();
        
                    //dd($data['get_paid_fee']->payed );
        
                    $get_paid_fee = Schooling::where('student_id', $student_id)
                    ->where('class_id', $data['student']->class_id)
                    ->where('year_id',$findYear->id)->first();
        
                    $get_paid_fee->payed = $data['new_fee'];
                    
                    $get_paid_fee->save();
                     
                    //dd($get_paid_fee );

                    $data['get_paid_fee'] = Schooling::where('student_id', $student_id)
                    ->where('class_id', $data['student']->class_id)
                    ->where('year_id',$findYear->id)->first();

                    $pdf = PDF::loadView('backend.student.schooling_fee.bill_schooling', $data);
                    $pdf->SetProtection(['copy', 'print'], '', 'pass');
                    return $pdf->stream('document.pdf');
                  
                   
                }
                break;

            case 'payer sans reçu':
                $findYear = StudentYear::where('active', 1)->first();
                $findYear->id;

                $data['student'] =  AssignStudent::with(['student'])
                ->where('student_id', $student_id)->where('year_id', $findYear->id)
                ->first();

                $data['class_id'] = $data['student']->class_id;
                $data['branch_id'] = $data['student']->branch_id;
                
                

                $data['schoolingfee'] = FeeCategoryAmount::where('fee_category_id','2')
                ->where('class_id',$data['student']->class_id)->first();
                
                //$schoolingfee->amount
                $data['paying'] =$request->schooling_fee;

       

                $data['get_paid_fee'] = Schooling::where('student_id', $student_id)
                ->where('class_id', $data['student']->class_id)
                ->where('year_id',$findYear->id)->first();

                
                $data['new_fee'] = $data['get_paid_fee']->payed + $data['paying'];


                if(($data['paying'] > $data['schoolingfee']->amount) || ($data['new_fee'] > $data['schoolingfee']->amount)){
                    dd('montant supérieur à la somme restante ');
                }else{

                    //GLOBAL FEE ADD
                    $check_fee = FeeDetail::where('feeCategory_id', '2')->first();

                    
                    if($check_fee != null){
                        
                        $check_fee->amount =  $check_fee->amount + $data['paying'] ; 
                        $check_fee->total_operation = $check_fee->total_operation + 1 ;
            
                        $check_fee->save();
                    }else {
                        $fee_detail = new FeeDetail();
            
                        $fee_detail->feeCategory_id = '2' ;
                        $fee_detail->amount = $data['paying'] ;
                        $fee_detail->total_operation = 1 ;
            
                        $fee_detail->save();
                    }


                    $data['school_info'] =  schoolInfo::where('id', 1)->first();

                    //dd($data['get_paid_fee']->payed );

                    $get_paid_fee = Schooling::where('student_id', $student_id)
                    ->where('class_id', $data['student']->class_id)
                    ->where('year_id',$findYear->id)->first();

                    $get_paid_fee->payed = $data['new_fee'];
                    
                    $get_paid_fee->save();
                    
                    return redirect()->back()->with('success', '');

                }
                break;
            
         
        }
    }

    public function SchoolingPayementStore__backup(Request $request, $student_id ){

        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

        $data['student'] =  AssignStudent::with(['student'])
        ->where('student_id', $student_id)->where('year_id', $findYear->id)
        ->first();

        $data['class_id'] = $data['student']->class_id;
        $data['branch_id'] = $data['student']->branch_id;
        
        

        $data['schoolingfee'] = FeeCategoryAmount::where('fee_category_id','2')
        ->where('class_id',$data['student']->class_id)->first();
        
        //$schoolingfee->amount
        $data['paying'] =$request->schooling_fee;

       

        $data['get_paid_fee'] = Schooling::where('student_id', $student_id)
        ->where('class_id', $data['student']->class_id)
        ->where('year_id',$findYear->id)->first();

        
        $data['new_fee'] = $data['get_paid_fee']->payed + $data['paying'];


        if(($data['paying'] > $data['schoolingfee']->amount) || ($data['new_fee'] > $data['schoolingfee']->amount)){
            dd('montant supérieur à la somme restante ');
        }else{

            //GLOBAL FEE ADD
            $check_fee = FeeDetail::where('feeCategory_id', '2')->first();

            
            if($check_fee != null){
                
                $check_fee->amount =  $check_fee->amount + $data['paying'] ; 
                $check_fee->total_operation = $check_fee->total_operation + 1 ;
    
                $check_fee->save();
            }else {
                $fee_detail = new FeeDetail();
    
                $fee_detail->feeCategory_id = '2' ;
                $fee_detail->amount = $data['paying'] ;
                $fee_detail->total_operation = 1 ;
    
                $fee_detail->save();
            }

            //dd( $get_paid_fee->payed);
            Cache::put('key', 0, $seconds = 10);
            
            
          

            //CACHING DAY OPERATION
            /* $day_operation = Cache::get('countschoolingpayment');

            $date = Carbon::now();
            //Get date and time
            $date->toDateTimeString();
            $time = 24 - $date->hour;
            $time;

            if($day_operation==null){
                Cache::put('countschoolingpayment', 1, now()->addMinutes($time));
            }else{
           
                Cache::increment('countschoolingpayment');
            } */

            $data['school_info'] =  schoolInfo::where('id', 1)->first();

            //dd($data['get_paid_fee']->payed );

            $get_paid_fee = Schooling::where('student_id', $student_id)
            ->where('class_id', $data['student']->class_id)
            ->where('year_id',$findYear->id)->first();

            $get_paid_fee->payed = $data['new_fee'];
            
            $get_paid_fee->save();
            

            if ($request->action == 'payer') {
                
                $pdf = PDF::loadView('backend.student.schooling_fee.bill_schooling', $data);
                $pdf->SetProtection(['copy', 'print'], '', 'pass');
                return $pdf->stream('document.pdf');
            }else{
                dd($get_paid_fee );
                return redirect()->back()->with('success', '');
            }

           
        }

        
       
        /* $data->payed = $request->group_id; */

       /*  $pdf = PDF::loadView('backend.student.schooling_fee.bill_schooling', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    */
        

    } 


    public function SchoolingPaymentDelete( $id){

        //dd($id);
        $schoolingfee = FeeCategoryAmount::find($id);

        $schoolingfee->delete();
        return redirect()->back();
    }

    
    public function ViewSchoolingClassFee(){


        $data['years'] = StudentYear::all();
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();

        return view('backend.student.schooling_class_fee.view_schooling_class_fee', $data);
    }


    public function SchoolingClassList($year_id, $class_id, $group_id, $branch_id = null){
        
        $data['allData'] =  Schooling::select('schoolings.*')
        ->with(['student_class', 'student_branch', 'student_group', 'student_year'])
        ->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('branch_id', $branch_id)->where('group_id', $group_id)
        ->where('fee_category_id', 2)
        ->get();

        $data['schoolingfee'] = FeeCategoryAmount::where('fee_category_id','2')
            ->where('class_id',$class_id)
            ->where('branch_id',$branch_id)
            ->first();
        

        $data['school_info'] =  schoolInfo::where('id', 1)->first();

        $pdf = PDF::loadView('backend.student.schooling_class_fee.schooling_class_list_pdf', $data, 
        [], 
        [ 
          'title' => 'Classement ', 
          
        ]);
        
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document','.pdf');
    }
}
