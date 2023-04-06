<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\AssignClasse;
use App\Models\StudentGroup;
use App\Models\AssignStudent;
use App\Models\StudentAttendance;
use App\Models\SchoolSeason;
use App\Models\Slice;
use App\Models\User;
use DB;
use PDF;

class StudentAttendanceController extends Controller
{
    
    public function StudentAttendanceView(){
        //$data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        $data['seasons'] = SchoolSeason::all();
        $data['allData'] = StudentAttendance::all();

        return view('backend.s_report.student_attendance.view_attendance', $data);
    }


    public function StudentAttendanceAdd(){
        
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] = StudentBranch::all();
        $data['groups'] = StudentGroup::all();
        $data['seasons'] = SchoolSeason::where('id', 1)->get();
        $data['allData'] = StudentAttendance::all();


        return view('backend.s_report.student_attendance.attendance_add', $data);
    }


    public function StudentAttendanceGet(Request $request){
        
        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

        if ($request->season_id == null) {
            $student = null;
        }else {
            if($request->branch_id == null){
          

                $student =  AssignStudent::select('assign_students.*')->with(['student'])->
                where('year_id', $findYear->id)->
                where('class_id', $request->class_id)->
                where('group_id', $request->group_id)->
                leftjoin('users', 'assign_students.student_id', '=', 'users.id')
                ->orderBy('users.name', 'asc')->get();
               
            }elseif($request->group_id == null){
                
    
                $student =  AssignStudent::select('assign_students.*')->with(['student'])->
                where('year_id', $findYear->id)->
                where('class_id', $request->class_id)->
                where('branch_id', $request->branch_id)->
                leftjoin('users', 'assign_students.student_id', '=', 'users.id')
                ->orderBy('users.name', 'asc')->get();
                
    
            }else{
    
                $student =  AssignStudent::select('assign_students.*')->with(['student','student_class','student_branch', 'student_group'])->
                where('year_id', $findYear->id)->
                where('class_id', $request->class_id)->
                where('branch_id', $request->branch_id)->
                where('group_id', $request->group_id)->
                leftjoin('users', 'assign_students.student_id', '=', 'users.id')
                ->orderBy('users.name', 'asc')->get();
        
            }


        

        

       

            $html['thsource']  = '<th rowspan="2" class="vert-align">List Eleves</th>';
            $html['thsource'] .= '<th colspan="4" class="text-center">Status</th>';

            $html['thsource2'] = '<th  class="text-center">Retard</th>';
            $html['thsource2'] .= '<th  class="text-center">Absence</th>';
            $html['thsource2'] .= '<th  class="text-center">Punition</th>';
            

            

            foreach ($student as $key => $v) {
                
                $student_attendance = StudentAttendance::where('year_id',  $findYear->id)
                ->where('student_id', $v->student_id)->where('class_id', $v->class_id)
                ->where('branch_id',  $v->branch_id)
                ->where('season_id', $request->season_id)
                ->where('group_id',  $v->group_id)->first();
                //dd($student_attendance);
                $check=1;
                if($student_attendance== null){
                    $check = 0;
                }

                
                $retardValue = $check==1 ? $student_attendance->retard : 0;
                $absenceValue = $check==1 ? $student_attendance->absences : 0;
                $punitionValue = $check==1 ? $student_attendance->punition : 0;

                

                $html[$key]['tdsource'] = '<td class="text-center">'
                .$v['student']['name'].
            
                '</td>';

                //dd($v['student_class']['id']);

                $html[$key]['tdsource'] .= '<td class="text-center">'.
                '<input type="hidden" value="'.$v['student']['id'].'" name="student_id[]">'.
                '<input type="hidden" value="'.$v['student_class']['id'].'" name="class_id[]">'.
                '<input type="hidden" value="'.$v['student_branch']['id'].'" name="branch_id[]">'.
                '<input type="hidden" value="'.$v['student_group']['id'].'" name="group_id[]">'.
                '<input type="hidden" value="'.$request->season_id.'" name="season_id">'
                .'<input type="text" style="width:70px; margin: auto"value="'.$retardValue.'"
                class="form-control form-control-sm" name="retard[]">'.
                
                '</td>';

                
                $html[$key]['tdsource'] .= '<td class="text-center">'
                .'<input type="text" style="width:70px; margin: auto" value="'.$absenceValue.'" 
                class="form-control form-control-sm" name="absence[]">'.
                '</td>';

                $html[$key]['tdsource'] .= '<td class="text-center">'
                .'<input type="text" style="width:70px; margin: auto" value="'.$punitionValue.'"
                class="form-control form-control-sm" name="punition[]">'.
                '</td>';

                
            } 
            if($request->class_id != null){
           
                $html['inputsource'] = '<input type="submit" class="btn btn-outline-info search mb-2" value="Enregistrer" id="">';
            }
        }

      

        

        return response()->json(@$html); 
      
    }

    public function StudentAttendanceStore(Request $request){
       
        $countstudent = count($request->student_id);
      
        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

       if($request->season_id == null){
        return redirect()->route('student.attendance.view')->with('error', '');
       }

        for($i=0 ;$i<$countstudent; $i++){

            $student_attendance = StudentAttendance::where('year_id',  $findYear->id)
            ->where('student_id', $request->student_id[$i])->where('class_id', $request->class_id[$i])
            ->where('branch_id',  $request->branch_id[$i])
            ->where('season_id', $request->season_id)
            ->where('group_id',  $request->group_id[$i])->get();

            

            if($student_attendance->toArray() == null){
                $newattendance = new StudentAttendance();
    
                $newattendance->year_id = $findYear->id;
                $newattendance->student_id = $request->student_id[$i];
                $newattendance->class_id = $request->class_id[$i];
                $newattendance->branch_id = $request->branch_id[$i];
                $newattendance->group_id = $request->group_id[$i];
                $newattendance->season_id = $request->season_id;

                $newattendance->retard = $request->retard[$i];
                $newattendance->absences = $request->absence[$i];
                $newattendance->punition = $request->punition[$i];
    
                $newattendance->save();
            }else {
                
                 StudentAttendance::where('year_id',  $findYear->id)
                ->where('student_id', $request->student_id[$i])->where('class_id', $request->class_id[$i])
                ->where('branch_id',  $request->branch_id[$i])
                ->where('season_id', $request->season_id)
                ->where('group_id',  $request->group_id[$i])->delete();

                $attendance = new StudentAttendance();
    
                $attendance->year_id = $findYear->id;
                $attendance->student_id = $request->student_id[$i];
                $attendance->class_id = $request->class_id[$i];
                $attendance->branch_id = $request->branch_id[$i];
                $attendance->group_id = $request->group_id[$i];
                $attendance->season_id = $request->season_id;

                $attendance->retard = $request->retard[$i];
                $attendance->absences = $request->absence[$i];
                $attendance->punition = $request->punition[$i];
    
                $attendance->save();
            }
        }
        

        return redirect()->route('student.attendance.view')->with('success', '');
    }
    
}
