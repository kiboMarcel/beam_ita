<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use DB;
use PDF;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;


class EmployeeSalaryController extends Controller
{
    //
    public function ViewEmployeeSalary(){
       
        $data['allData'] = User::where('usertype', 'employee')->orderBy('name')->cursorPaginate(15);

        return view('backend.employee.employee_salary.view_salary', $data);

    }

    public function EmployeeSalaryInrement($id){
       
        $data['editData'] = User::find($id);

        return view('backend.employee.employee_salary.employee_salary_increment', $data);

    }



    public function SalaryInrementStore( Request $request ,$id){

        if ($request->action == 'retirer') {
            $user = User::find($id);
            $previous_salary = $user->salary;
            $present_salary =  (float)$previous_salary - (float)$request->increment_salary ;
            $user->salary = $present_salary;

            $user->save();

            $salaryData =  new EmployeeSalaryLog();
            $salaryData->employee_id =  $id;
            $salaryData->previous_salary = $previous_salary;
            $salaryData->present_salary = $present_salary;
            $salaryData->increment_salary = $request->increment_salary;
            $salaryData->effected_salary =  date('Y-m-d' , strtotime( $request->effected_salary ) ) ;

            $salaryData->save();

            return redirect()-> route('employee.salary.view');
           
       }else{
            $user = User::find($id);
            $previous_salary = $user->salary;
            $present_salary =  (float)$previous_salary + (float)$request->increment_salary ;
            $user->salary = $present_salary;

            $user->save();

            $salaryData =  new EmployeeSalaryLog();
            $salaryData->employee_id =  $id;
            $salaryData->previous_salary = $previous_salary;
            $salaryData->present_salary = $present_salary;
            $salaryData->increment_salary = $request->increment_salary;
            $salaryData->effected_salary =  date('Y-m-d' , strtotime( $request->effected_salary ) ) ;

            $salaryData->save();

            return redirect()-> route('employee.salary.view');
           
       }
       
        
    }

    public function SalaryDetail($id){
       
        $data['detail'] = User::find($id); 

        $data['salary_log'] =  EmployeeSalaryLog::where('employee_id', $data['detail']->id)->get();

        //dd( $data['salary_log']->toArray());
        
        return view('backend.employee.employee_salary.employee_salary_detail', $data);

    }
}
