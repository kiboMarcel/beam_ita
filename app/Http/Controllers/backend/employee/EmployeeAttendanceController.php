<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use App\Models\User;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;

use App\Models\EmployeeAttendance;

use DB;
use PDF;

class EmployeeAttendanceController extends Controller
{
    //

    public function AtdceView(){
        //$data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date', 'desc')
        ->cursorPaginate(20);

        return view('backend.employee.employee_attendance.view_emp_atdc', $data);
    }

    public function AtdceAdd(){
        $data['employees'] = User::where('usertype', 'employee')->orderBy('name')->get();


        return view('backend.employee.employee_attendance.add_emp_atdc', $data);
    }
   

    public function AtdceStore(Request $request){
       
        $check = EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->get();
        
        if($check->toArray() != null){
            $status = 'update';
        }else{
            $status = 'create';
        }


        
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);
        
        

        for($i=0; $i<$countemployee; $i++){
            $attend_status = 'attend_status'.$request->employee_id[$i];
            //dd($request->$attend_status);
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;

            $attend->save();
        }

        return redirect()-> route('employee.attendance.view')->with($status, '');
    }

    public function AtdceEdit($date){
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();

        $data['employees'] = User::where('usertype', 'employee')->get();
        

        return view('backend.employee.employee_attendance.edit_emp_atdc', $data);
    }

    public function AtdceDetail($date){
        $data['detail'] = EmployeeAttendance::where('date', $date)->get();

       // $data['employees'] = User::where('usertype', 'employee')->get();
        

        return view('backend.employee.employee_attendance.detail_emp_atdc', $data);
    }
}
