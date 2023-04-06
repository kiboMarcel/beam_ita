<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignClasse;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\Schooling;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\schoolInfo;
use App\Models\Student_final_mark;
use App\Models\StudentMarks;
use App\Models\StudentFinalAVG;
use App\Models\StudentAttendance;
use App\Models\annualAVG;
use DB;
use PDF;

class StudentRegistrationController extends Controller
{
    //
    public function ViewRegistration(){
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] =  StudentBranch::orderBy('name')->get();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();
        $data['count'] = 0;

        if($data['classes']->toArray()== null || $data['years']->toArray()== null){
           // return view('admin.index')->with('error', '');
           dd('error');
        }
            $data['year_id'] =  StudentYear::orderBy('id', 'asc')->first()->id;
            $data['class_id'] =  StudentClass::orderBy('id', 'desc')->first()->id;
            $data['class_search'] = StudentClass::find($data['class_id']);

            $findYear = StudentYear::where('active', 1)->first();
            
            
            $data['allData'] =  AssignStudent::where('year_id',$findYear->id)
            ->where('class_id', $data['class_id'])
            ->cursorPaginate(10);
          
            return view('backend.student.student_reg.view_stud_reg', $data);
        
        

    }

    public function StudentSearch(Request $request){
        $data['classes'] =  AssignClasse::groupBy('class_id')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $data['year_id'] =  $request->year_id;
        $data['class_id'] =   $request->class_id;
        $data['branch_id'] =   $request->branch_id;
        $data['group_id'] =   $request->group_id;
        $count = 0;

        /* $data['allData'] =  AssignStudent::with(['student'])->where('year_id', $request->year_id)->
        where('class_id', $request->class_id)->where('branch_id', $request->branch_id)->get(); */

        if($request->branch_id == null && $request->group_id == null){
            $data['countstudent'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get();

            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->simplepaginate(20);
            $count = count($data['countstudent']);

            $data['class_search'] = StudentClass::find($request->class_id);

        }elseif ($request->branch_id == null) {
            $data['countstudent'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('group_id', $request->group_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get();

            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('group_id', $request->group_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->simplepaginate(20);
            $count = count($data['countstudent']);

            $data['class_search'] = StudentClass::find($request->class_id);
            $data['group_search'] = StudentGroup::find($request->group_id);
        }
        elseif($request->group_id == null){
            $data['countstudent'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('branch_id', $request->branch_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get();

            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('branch_id', $request->branch_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->simplepaginate(20);
            $count = count($data['countstudent']);

            $data['class_search'] = StudentClass::find($request->class_id);
            $data['branch_search'] = StudentBranch::find($request->branch_id);

        }else{
            $data['countstudent'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('branch_id', $request->branch_id)->
            where('group_id', $request->group_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get();

            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $request->year_id)->
            where('class_id', $request->class_id)->
            where('branch_id', $request->branch_id)->
            where('group_id', $request->group_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->simplepaginate(20);

            $count = count($data['countstudent']);
            

            $data['class_search'] = StudentClass::find($request->class_id);
            $data['branch_search'] = StudentBranch::find($request->branch_id);
            $data['group_search'] = StudentGroup::find($request->group_id);
        }
        $data['count'] = $count;
        //dd($data['allData']);
        return view('backend.student.student_reg.view_stud_reg', $data);

    }


    public function RegistrationAdd(){
        $data['classes'] =  AssignClasse::groupBy('class_id')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();
        return view('backend.student.student_reg.add_stud_reg', $data);

    }


    public function RegistrationStore(Request $request){
        
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();

            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId.'ITA';
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId.'ITA';
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId.'ITA';
                }
            }else{
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student+1;
                if ($studentId < 10){
                    $id_no = '000'.$studentId.'ITA';
                }elseif($studentId < 100){
                    $id_no = '00'.$studentId.'ITA';
                }elseif($studentId < 1000){
                    $id_no = '0'.$studentId.'ITA';
                }
            }

            $year = substr($checkYear, 0, 4);
           
            $final_id_no = $year.$id_no;

            
            //CHECK IF STUDENT ALREADY EXIST
            $checkstudent = User::where('usertype', 'Student')->where('name',$request->name )->first();

            if($checkstudent != null){
                $checkstudentClass = AssignStudent::where('year_id',$request->year_id )
                ->where('class_id', $request->class_id)
                ->where('student_id', $checkstudent->id)->first();
            }


            if($request->nmat == null){
                $final_id = $final_id_no;
            }else {
                $final_id = $request->nmat;
            }


            if(!($checkstudent == null) and !($checkstudentClass == null)){
                dd('Un eleve a deja ete enregistré sous ce nom pour cette classe');
            }else {
                $user= new User();
                $code = rand(0000, 9999);
                $user->id_no = $final_id;
                $user->password = bcrypt($code);
                $user->usertype = 'Student';
                $user->code = $code;
                $user->name = $request->name;
                $user->fname = $request->fname;
                $user->mname = $request->mname;
                $user->mobile = $request->mobile;
                $user->address = $request->address;
                $user->gender = $request->gender;
                $user->nationality = $request->nationality;
                $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );
                $user->place_of_birth = $request->place_of_birth;

                
                $user->save();


                $assign_student= new AssignStudent();
                $assign_student->student_id = $user->id;
                $assign_student->class_id = $request->class_id;
                $assign_student->branch_id = $request->branch_id;
                $assign_student->group_id = $request->group_id;
                $assign_student->status = $request->status;
                $assign_student->year_id = $request->year_id;

                $assign_student->save();


                $schooling =  new Schooling();
                $schooling->student_id = $user->id;
                $schooling->payed = 0;
                $schooling->class_id = $request->class_id;
                $schooling->branch_id = $request->branch_id;
                $schooling->group_id = $request->group_id;
                $schooling->year_id = $request->year_id;
                $schooling->fee_category_id = '2';

                $schooling->save();
            }
            

           /*  $discount_student= new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;

            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view')->with('success', '');

    }


    public function  RegistrationEdit( $student_id){

        $data['classes'] =   AssignClasse::groupBy('class_id')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

        $data['editData'] =  AssignStudent::with(['student'])
        ->where('year_id', $findYear->id)
        ->where('student_id', $student_id)->first();
        
        $student_marks = StudentMarks::where('student_id',$student_id)
        ->where('year_id',$findYear->id)->get();
        
        if($student_marks->toArray()== null){
            $data['active'] = 1;
        }else{
            $data['active'] = 0;
        }
        
       // dd($data['editData']->toArray());

        return view('backend.student.student_reg.edit_stud_reg', $data);

    }


    public function RegistrationUpdate(Request $request, $student_id){

        DB::transaction(function () use ($request, $student_id) {
           

            $user=  User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->id_no = $request->nmat;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->nationality = $request->nationality;
            $user->date_of_birth = date('Y-m-d', strtotime( $request->date_of_birth) );
            $user->place_of_birth = $request->place_of_birth;


            $user->save();


            $assign_student=  AssignStudent::where('id', $request->id)->
            where('student_id', $student_id)->first();
            
            $assign_student->class_id = $request->class_id;
            $assign_student->branch_id = $request->branch_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->status = $request->status;
            $assign_student->year_id = $request->year_id;

            $assign_student->save();

          /*   $discount_student= new DiscountStudent::where('assign_student_id', $request->id)->
            first();

            $discount_student->discount = $request->discount;

            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view')->with('successUpdate', '');
    }


    
    public function  StudentPromoSearchView(){

        $data['years'] =  StudentYear::all();
        return view('backend.student.student_reg.promotion_search', $data);
    }


    public function  StudentPromoSearch(Request $request){

       $student =  AssignStudent::select('assign_students.*')->with(['student'])->
         where('users.usertype', 'Student')->where('assign_students.year_id', $request->year_id)->
         where('users.name',  'like', '%' . $request->searchText . '%' )->
         leftjoin('users', 'assign_students.student_id', '=', 'users.id')->get();
         //dd($student);
         if($request->year_id == null  ){
 
            $html['h5source']  = '<h5>Sélectionner une année</h5>';
            return response()->json(@$html); 
        }

        if($student->toArray() == null || $request->searchText== '' ){
 
            $html['h5source']  = '<h5>Pas de correspondance</h5>';
            return response()->json(@$html); 
         }
        
        else{
            
                
                $html['thsource']  = '<th>#</th>';
                $html['thsource'] .= '<th>ID No</th>';
                $html['thsource'] .= '<th> Nom</th>';
                $html['thsource'] .= '<th>Classe</th>';
                $html['thsource'] .= '<th>Serie/Branch </th>';
                $html['thsource'] .= '<th>Action</th>'; 

                foreach ($student as $key => $v) {
                  
                    $color2nd = 'info';
                    
                   
                   
                    $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student_class']['name'].'</td>';
                    $html[$key]['tdsource'] .= '<td>'.$v['student_branch']['name'].'</td>';
                             
                    $html[$key]['tdsource'] .='<td>'. '<a class="btn btn-sm btn-'.$color2nd.'" 
                    title="Pay" target="_blanks" 
                     href="'.route("student.registration.promotion",[$v->student_id ]).'?student_id='.$v->student_id.
                     '">Promotion</a>' . '</td>';
                   
                } 
             
            return response()->json(@$html); 
          
        }
    }


    public function  StudentPromotionView(Request $request, $student_id){


        $data['classes'] =  AssignClasse::groupBy('class_id')->get();
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['years'] =  StudentYear::all();

        $data['editData'] =  AssignStudent::with(['student'])->where('student_id', $student_id)->first();

        return view('backend.student.student_reg.promotion_stud_reg', $data);
    }


    public function StudentPromotion(Request $request, $student_id){
        DB::transaction(function () use ($request, $student_id) {
           

            $user=  User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->gender = $request->gender;
          


            $user->save();

            $checkPromotion = AssignStudent::where('year_id', $request->year_id)->
            where('student_id',$user->id )->first();
            
            if($checkPromotion != null){
                dd('Eleve deja promus pour cette année');
            }else{

                
            $assign_student = new AssignStudent();
            
            $assign_student->student_id = $request->student_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->branch_id = $request->branch_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->status = $request->status;
            $assign_student->year_id = $request->year_id;

            $assign_student->save();


            $schooling =  new Schooling();
            $schooling->student_id = $user->id;
            $schooling->payed = 0;
            $schooling->class_id = $request->class_id;
            $schooling->branch_id = $request->branch_id;
            $schooling->group_id = $request->group_id;
            $schooling->year_id = $request->year_id;
            $schooling->fee_category_id = '2';

            $schooling->save();

            }


          /*   $discount_student=  DiscountStudent();

            $discount_student->discount = $request->discount;
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->save(); */
        });

        return redirect()-> route('student.registration.view');
    }


    public function StudentListPrint(Request $request ,$year_id, $class_id, $group_id=null, $branch_id=null){
        
        $data['year_id'] =  $year_id;
        $data['class_id'] =   $class_id;
        $data['branch_id'] =   $branch_id;
        $data['group_id'] =   $group_id;
       
        if($group_id == null){
            //dd('group is null');
            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_isd', $year_id)->
            where('class_id', $class_id)->
            where('branch_id', $branch_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get(); 
            
       
        }else{
            $data['allData'] =  AssignStudent::select('assign_students.*')->with(['student'])->
            where('year_id', $year_id)->
            where('class_id', $class_id)->
            where('branch_id', $branch_id)->
            where('group_id', $group_id)->
            leftjoin('users', 'assign_students.student_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')->get(); 
       
        }
            
       
        $data['school_info'] =  schoolInfo::where('id', 1)->first();
        

        $pdf = PDF::loadView('backend.student.student_reg.class_print', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


        //Landscape mode
       /*  $pdf = PDF::loadView('backend.student.student_reg.landscape', 
        $data, 
        [], 
        [ 
          'title' => 'Certificate', 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf'); */
       // return view('backend.student.student_reg.student_details_pdf');
    }


    public function StudentDetail(Request $request, $student_id){

        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;


        $data['details'] =  AssignStudent::with(['student'])->
        where('student_id', $student_id)->
        where('year_id', $findYear->id)->first();

        $data['school_info'] =  schoolInfo::where('id', 1)->first();

        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


        //Landscape mode
        /* $pdf = PDF::loadView('certificates.show', 
        $data, 
        [], 
        [ 
          'title' => 'Certificate', 
          'format' => 'A4-L',
          'orientation' => 'L'
        ]); */
       // return view('backend.student.student_reg.student_details_pdf');
    }

    public function RegistrationDelete( $id){
        
        $findYear = StudentYear::where('active', 1)->first();
        $findYear->id;

        $student_class = AssignStudent::where('student_id',$id)->where('year_id', $findYear->id)
        ->delete();


        $student_schooling = Schooling::where('student_id',$id)->where('year_id', $findYear->id)->delete();

        $student_marks = StudentMarks::where('student_id',$id)->where('year_id', $findYear->id);
        
        $student_marks->delete();

        $student_f_m = Student_final_mark::where('student_id',$id)->where('year_id', $findYear->id);
        
        $student_f_m->delete();

        $student_f_avg = StudentFinalAVG::where('student_id',$id)->where('year_id', $findYear->id);
        
        $student_f_avg->delete();

        $student_attdce = StudentAttendance::where('student_id',$id)->where('year_id', $findYear->id);
        
        $student_attdce->delete();

        $student_avg = annualAVG::where('student_id',$id)->where('year_id', $findYear->id);;
        
        $student_avg->delete();

        return redirect()->back();
    }
    /* public function RegistrationDelete( $id){

        $student_class = User::find($id);

        $student_class->delete();

        $student_schooling = Schooling::where('student_id',$id)->delete();

        $student_marks = StudentMarks::where('student_id',$id);
        
        $student_marks->delete();

        $student_f_m = Student_final_mark::where('student_id',$id);
        
        $student_f_m->delete();

        $student_f_avg = StudentFinalAVG::where('student_id',$id);
        
        $student_f_avg->delete();

        $student_attdce = StudentAttendance::where('student_id',$id);
        
        $student_attdce->delete();

        $student_avg = annualAVG::where('student_id',$id);
        
        $student_avg->delete();

        return redirect()->back();
    } */
}
