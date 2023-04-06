<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\LeavePurpose;
use App\Models\EmployeeLeave;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;

use DB;
use PDF;

class EmployeeLeaveController extends Controller
{
    //

    public function ViewLeave(){
       
        $data['allData'] = EmployeeLeave::orderBy('id', 'desc')->cursorPaginate(20);

        return view('backend.employee.employee_leave.view_emp_leave', $data);

    }


    public function LeaveAdd(){
       
        $data['employees'] = User::where('usertype','employee')->orderBy('name')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.employee_leave.add_emp_leave', $data);

    }

    

    public function LeaveStore(Request $request){
       
     
      if ($request->leave_purpose_id == "0"){
        $leavePurpose = new LeavePurpose();
        $leavePurpose->name = $request->name;

        $leavePurpose->save();

        $leave_purpose_id = $leavePurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }

      $data = new EmployeeLeave();
      $data->employee_id = $request->employee_id;
      $data->leave_purpose_id = $leave_purpose_id;
      $data->start_date =  date('Y-m-d', strtotime($request->start_date));
      $data->end_date =  date('Y-m-d', strtotime($request->end_date));

      $data->save();


      return redirect()-> route('employee.leave.view');
    }


    public function LeaveEdit($id){
       
      $data['editData'] = EmployeeLeave::find($id);
      $data['employees'] = User::where('usertype', 'employee')->get();
      $data['leave_purpose'] = LeavePurpose::all();

      return view('backend.employee.employee_leave.edit_emp_leave', $data);

  }

    
  public function LeaveUpdate(Request $request, $id){
       
     
      if ($request->leave_purpose_id == "0"){
        $leavePurpose = new LeavePurpose();
        $leavePurpose->name = $request->name;

        $leavePurpose->save();

        $leave_purpose_id = $leavePurpose->id;
      }else{
        $leave_purpose_id = $request->leave_purpose_id;
      }

      $data = EmployeeLeave::find($id);
      $data->employee_id = $request->employee_id;
      $data->leave_purpose_id = $leave_purpose_id;
      $data->start_date =  date('Y-m-d', strtotime($request->start_date));
      $data->end_date =  date('Y-m-d', strtotime($request->end_date));

      $data->save();


      return redirect()-> route('employee.leave.view');
    }

    public function LeaveDelete($id){
       
      $leave = EmployeeLeave::find($id);
      
      $leave->delete();

      return redirect()-> route('employee.leave.view');

  }
}
