<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\schoolInfo;
use App\Models\StudentGroup;
use App\Models\FeeCategoryAmount;
use DB;
use PDF;

use App\Models\EmployeeSalaryLog;
use App\Models\Designation;


class EmployeeRegController extends Controller
{
    //
    public function ViewEmployee(){
        $data['allData'] = User::where('usertype', 'Employee')->orderBy('name')->cursorPaginate(15);
        $data['count'] = User::where('usertype', 'Employee')->count();
        return view('backend.employee.employee_reg.view_emp', $data);
    }

    public function EmployeeAdd(){
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.add_emp', $data);
    }


    public function EmployeeStore(Request $request){
        
        DB::transaction(function () use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            //dd($checkYear);
            $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first();

            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if ($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee+1;
                if ($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }

            $final_id_no = $checkYear.$id_no;
            $user= new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->contrat = $request->contrat;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->nationality = $request->nationality;
            $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );
            $user->join_date = date('Y-m-d', strtotime( $request->join_date) );
            


            $user->save();


            

            $employee_salary =  new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d', strtotime( $request->join_date) );
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';

            $employee_salary->save();

           
        });

        return redirect()-> route('employee.registration.view')->with('success', '');
    }

    public function EmployeeEdit($id){
        $data['editData'] = User::find($id);
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.edit_emp', $data);
    }

    public function EmployeeUpdate(Request $request ,$id){
       
            $user=  User::find($id);
            
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->designation_id = $request->designation_id;
            $user->nationality = $request->nationality;
            $user->contrat = $request->contrat;
            $user->salary = $request->salary;
            $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );
            $user->join_date = date('Y-m-d', strtotime( $request->join_date) );
            

            $user->save();

        return redirect()-> route('employee.registration.view')->with('successUpdate', '');
    }

    public function EmployeeDetail(Request $request ,$id){
       
        $data['details'] =  User::find($id);
        /* $data['details'] =  User::with(['student'])->
        where('student_id', $id)->first(); */


        //SCHOOL DATA
        $data['school_info'] =  schoolInfo::where('id', 1)->first();

        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }
}
