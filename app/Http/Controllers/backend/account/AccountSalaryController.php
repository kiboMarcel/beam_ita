<?php

namespace App\Http\Controllers\backend\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AccountEmployeeSalary;

use App\Models\User;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;

use App\Models\EmployeeAttendance;

use DB;
use PDF;


class AccountSalaryController extends Controller
{
    //

    public function ViewSalary(){
        $data['allData'] = AccountEmployeeSalary::cursorPaginate(25);

        return view('backend.account.emp_salary.view_employee_salary', $data); 
    }


    public function SalaryAdd(){
      

        return view('backend.account.emp_salary.add_employee_salary'); 
    }

  

    public function SalaryEmployeeGet(Request $request){
      
       
        $date = date('Y-m', strtotime($request->date));

        if($date != ''){
            $where[] =  ['date', 'like', $date.'%'];
        }
       
        $data =  EmployeeAttendance::select('employee_id')->groupBy('employee_id') 
        ->with(['user'])->where($where)
        ->leftjoin('users', 'employee_id', '=', 'users.id')->orderBy('users.name')->get();
        //dd($data);

        if($data->toArray() == null || $date== '' ){

            $html['h5source']  = '<h5>Pas de correspondance</h5>';
            return response()->json(@$html); 
        }
        else{
            //dd($student->toArray());
            $html['thsource']  = '<th>#</th>';
            $html['thsource'] .= '<th>ID No</th>';
            $html['thsource'] .= '<th> Nom Employé</th>';
            $html['thsource'] .= '<th> Contrat</th>';
            $html['thsource'] .= '<th>Salaire de Base</th>';
            $html['thsource'] .= '<th>Salaire de ce mois </th>';
            $html['thsource'] .= '<th>Select </th>';


            foreach ($data as $key => $attend) {

                $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)
                ->where($where)->first();

                if($account_salary != null){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }

                $totalattend = EmployeeAttendance::with(['user'])->where($where)
                ->where('employee_id',$attend->employee_id)->get();

                $presencecount = count($totalattend->where('attend_status', 'present'));
                
               

                $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].
                '<input type="hidden" name="date" value="'.$date.'">'.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$attend['user']['contrat'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.number_format($attend['user']['salary'], 0, ',', ' ').' Fcfa' .'</td>';

                $salary = (float)$attend['user']['salary'];
                //$salaryPerDay = $salary/30;
                //$totalSalaryMinus = (float)$absentcount * (float)$salaryPerDay;
                if ($attend['user']['contrat']== 'Vacataire') {
                    $totalSalary = (float)$salary * (float)$presencecount;
                    $round = round($totalSalary, 2);
                }else {
                    $round = round($salary, 2);
                }
               

                $html[$key]['tdsource'] .= '<td>'.number_format($round, 0, ',', ' ').' Fcfa'.
                '<input type="hidden" name="amount[]" value="'.$round.'">'.'</td>';

                $html[$key]['tdsource'] .='<td>'.
                '<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">
                <label class="new-control new-checkbox checkbox-outline-success">
                <input type="checkbox" name="checkmanage[]" value="'.$key.'"
                '.$checked.' class="new-control-input">
                <span class="new-control-indicator"></span>Déjà payer
              </label>'.'</td>';
                
            

            } 
            return response()->json(@$html); 

        }
    }

    public function SalaryStore(Request $request){
      
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();

        $checkdata = $request->checkmanage;
        
        if($checkdata != null){
            for ($i=0; $i < count($checkdata)  ; $i++) { 
                $data = new AccountEmployeeSalary();

                $data->date = $date;
                $data->employee_id = $request->employee_id[ $checkdata[$i]];
                $data->amount = $request->amount[ $checkdata[$i]];
                //dd($request->employee_id[ $checkdata[$i]]);
                $data->save();

            }
        }

        if (!empty(@data) ||  empty($checkdata) ){
            return redirect()->route('account.salary.view')->with('success', '');
        }else{
            //dd('error');
            return redirect()->back()->with('error', '');
        }
    }
}
