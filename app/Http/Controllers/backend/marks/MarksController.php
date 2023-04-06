<?php

namespace App\Http\Controllers\backend\marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AssignClasse;
use App\Models\StudentMarks;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentBranch;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\ExamType;
use App\Models\SchoolSeason;
use App\Models\AssignSubject;
use App\Models\Student_final_mark;
use App\Models\StudentFinalAVG;
use App\Models\annualAVG;

use DB;
use PDF;

class MarksController extends Controller
{
   
    public function MarksAdd(){

            $data['years'] = StudentYear::all();
            $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
            $data['branchs'] =  StudentBranch::all();
            $data['groups'] =  StudentGroup::all();
            $data['exam_types'] = ExamType::all();
            $data['seasons'] = SchoolSeason::all();

            return view('backend.marks.marks_add', $data);
    }

    public function MarksStore(Request $request){

        $studenCount = $request->student_id;

        if($request->exam_type_id != 3){
           
            if($studenCount){
                for ($i=0 ; $i<count($request->student_id) ; $i++){
                    

                    $checkmarks =  StudentMarks::where('year_id', $request->year_id)
                    ->where('student_id', $request->student_id[$i])
                    ->where('assign_subject_id', $request->assign_subject_id)
                    ->where('exam_type_id',$request->exam_type_id )
                    ->where('season_id', $request->season_id)->get(); //CHECK IF NOT EXIT
                    
                    if($checkmarks->toArray() != null){
                        continue;
                        //return redirect()->back()->with('mark_exist', '');
                    }else {
                        $data = new StudentMarks();
                        $data->year_id = $request->year_id;
                        $data->class_id = $request->class_id;
                        $data->branch_id = $request->branch_id;
                        $data->group_id = $request->group_id;
                        $data->season_id = $request->season_id;
                        $data->assign_subject_id = $request->assign_subject_id;
                        $data->exam_type_id = $request->exam_type_id;
                        $data->student_id = $request->student_id[$i];
                        $data->id_no = $request->id_no[$i];
                        $data->marks = $request->marks[$i];
    
                        $data->save();
                    }

                    
                    
                    //ADD EXAM DEFAULT MARK
                    $findDefaultMArk =  StudentMarks::where('year_id', $request->year_id)
                    ->where('student_id', $request->student_id[$i])
                    ->where('assign_subject_id', $request->assign_subject_id)
                    ->where('exam_type_id', '3')
                    ->where('season_id', $request->season_id)->get();
                
                   

                        if ($findDefaultMArk->toArray() == null) {
                            $defaultMark = new StudentMarks();
                            $defaultMark->year_id = $request->year_id;
                            $defaultMark->class_id = $request->class_id;
                            $defaultMark->branch_id = $request->branch_id;
                            $defaultMark->group_id = $request->group_id;
                            $defaultMark->season_id = $request->season_id;
                            $defaultMark->assign_subject_id = $request->assign_subject_id;
                            $defaultMark->exam_type_id = '3';
                            $defaultMark->student_id = $request->student_id[$i];
                            $defaultMark->id_no = $request->id_no[$i];
                            $defaultMark->marks = '0';
    
                            $defaultMark->save();
                        }else{
                     
                        }

                }
            }
        }else{
            //dd('$findDefaultMArk');
            for ($i=0 ; $i<count($request->student_id) ; $i++){

                //EXAM DEFAULT MARK
                $findDefaultMArk =  StudentMarks::where('year_id', $request->year_id)
                ->where('student_id', $request->student_id[$i])
                ->where('assign_subject_id', $request->assign_subject_id)
                ->where('exam_type_id', $request->exam_type_id)
                ->where('season_id', $request->season_id)->first();
                
                //dd($findDefaultMArk->marks);

                $findDefaultMArk->marks = $request->marks[$i];
    
                $findDefaultMArk->save();

               }
          
           }

           /// MARKS AVERAGE START

        for ($j=0 ; $j<count($request->student_id) ; $j++){
 
            //get subject
            $subjects = AssignSubject::with(['school_subject'])
                ->where('id', $request->assign_subject_id )->first();


            
        
           /*  $marksByDevoirAVG = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', '1')->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)
            ->where('season_id', $request->season_id)->avg('marks');
        
            $marksBysubjectExam = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', '2')->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)
            ->where('season_id', $request->season_id)->first(); */

           /*  //dd($marksByDevoirAVG);
            $examMArk = $marksBysubjectExam->marks;
            $totalAVG =( $examMArk + $marksByDevoirAVG)/2; */

            $totalAVG = StudentMarks::where('assign_subject_id', $request->assign_subject_id)
            ->where('student_id', $request->student_id[$j])
            ->where('year_id', $request->year_id)
            ->where('season_id', $request->season_id)->avg('marks');
            
           
                
            $finalMark =   $totalAVG * $subjects->coef;
            //dd($finalMark);
            $getfinal_marks = Student_final_mark::where( 'student_id', $request->student_id[$j] )
            ->where( 'year_id', $request->year_id )->where( 'season_id', $request->season_id )
            ->where( 'assign_subject_id',$request->assign_subject_id )->get();
            
            if ($getfinal_marks->toArray() == null) {
                //dd($request->student_id[$j]);
                $finalMrk = new Student_final_mark();
                $finalMrk->student_id =  $request->student_id[$j];
                $finalMrk->id_no =  $request->id_no[$j];
                $finalMrk->year_id =   $request->year_id;
                $finalMrk->class_id =  $request->class_id;
                $finalMrk->group_id =  $request->group_id;
                $finalMrk->branch_id =  $request->branch_id;
                $finalMrk->assign_subject_id =  $request->assign_subject_id;
                $finalMrk->season_id = $request->season_id;
                $finalMrk->final_marks = round($finalMark, 2) ;

                $finalMrk->save();


                //UPPDATE FINAL AVG TABLE 
                 //find the sum of all the final mark for the student
                 $sum_final_mark = Student_final_mark::where('student_id', $request->student_id[$j])
                 ->where('year_id', $request->year_id)->where('season_id', $request->season_id)
                 ->sum('final_marks');
 
                 //find the sum of the coef of the current class
                 $coef_sum = AssignSubject::where('class_id', $request->class_id)
                 ->where('branch_id', $request->branch_id)->sum('coef');
         
                  $fmarkAVG = ($sum_final_mark / $coef_sum) ;


                  //check if student final average exist 
                  $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id[$j])
                  ->where('year_id', $request->year_id)->where('season_id', $request->season_id)->get();

                  if($Avgcheck->toArray() == null){
                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $request->year_id;
                    $avg->season_id  = $request->season_id;
                    $avg->class_id  = $request->class_id;
                    $avg->branch_id  = $request->branch_id;
                    $avg->group_id  = $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $request->student_id[$j];
  
                    $avg->save();


                    //ANNUAL AVG
                    if ($request->season_id == 2 ) {


                        $checkannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                        ->where('year_id', $request->year_id)->first();
                        
                           //dd($checkannualAVG);
                           //get  season 1 avg
                           $avg1 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 1)->first();
                   
                           //get  season 2 avg
                           $avg2 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 2)->first();
                   
                           if($avg1 == null){
                                $annual_avg = ( $avg2->final_avg)/2;
                            }elseif($avg2 == null){
                                $annual_avg = ($avg1->final_avg )/2;
                            }else {
                                $annual_avg = ($avg1->final_avg + $avg2->final_avg)/2;
                            }

                           round( $annual_avg, 2);
                        if($checkannualAVG == null){
                         
                            $annualAvg = new annualAVG();
                            $annualAvg->student_id = $request->student_id[$j];
                            $annualAvg->year_id = $request->year_id;
                            $annualAvg->class_id = $request->class_id;
                            $annualAvg->branch_id = $request->branch_id;
                            $annualAvg->group_id = $request->group_id;
                            $annualAvg->annual_avg =  round( $annual_avg, 2);

                            $annualAvg->save();

                        }else {
                            $updateannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                            ->where('year_id', $request->year_id)->first();

                            $updateannualAVG->annual_avg = round( $annual_avg, 2);

                            $updateannualAVG->save();
                        }
                        
                    }
                  }else{
                    $avg = StudentFinalAVG::where('student_id', $request->student_id[$j])
                    ->where('year_id', $request->year_id)
                    ->where('season_id', $request->season_id)->first();

                    //$avg = new StudentFinalAVG();

                    $avg->year_id  = $request->year_id;
                    $avg->season_id  = $request->season_id;
                    $avg->branch_id  = $request->branch_id;
                    $avg->group_id  = $request->group_id;
                    $avg->class_id  = $request->class_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $request->student_id[$j];

                    $avg->save();

                    //ANNUAL AVG
                    if ($request->season_id == 2 ) {


                        $checkannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                        ->where('year_id', $request->year_id)->first();
                        
                           //dd($checkannualAVG);
                           //get  season 1 avg
                           $avg1 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 1)->first();
                   
                           //get  season 2 avg
                           $avg2 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 2)->first();
                   
                          
                           if($avg1 == null){
                                $annual_avg = ( $avg2->final_avg)/2;
                            }elseif($avg2 == null){
                                $annual_avg = ($avg1->final_avg )/2;
                            }else {
                                $annual_avg = ($avg1->final_avg + $avg2->final_avg)/2;
                            }

                           round( $annual_avg, 2);
                        if($checkannualAVG == null){
                         
                            $annualAvg = new annualAVG();
                            $annualAvg->student_id = $request->student_id[$j];
                            $annualAvg->year_id = $request->year_id;
                            $annualAvg->class_id = $request->class_id;
                            $annualAvg->branch_id = $request->branch_id;
                            $annualAvg->group_id = $request->group_id;
                            $annualAvg->annual_avg =  round( $annual_avg, 2);

                            $annualAvg->save();

                        }else {
                            $updateannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                            ->where('year_id', $request->year_id)->first();

                            $updateannualAVG->annual_avg = round( $annual_avg, 2);

                            $updateannualAVG->save();
                        }
                        
                    }
                  }

            }else{
                //find the existing mark to update
                $finalMrk =  Student_final_mark::where( 'student_id', $request->student_id[$j] )
                ->where( 'year_id', $request->year_id )->where( 'season_id', $request->season_id )
                ->where( 'assign_subject_id',$request->assign_subject_id )->first();
                
                $finalMrk->final_marks =  round($finalMark, 2) ;
                
                 $finalMrk->save();
                
                 //UPPDATE FINAL AVG TABLE 
                 //find the sum of all the final mark for the student
                 $sum_final_mark = Student_final_mark::where('student_id', $request->student_id[$j])
                 ->where('year_id', $request->year_id)->where('season_id', $request->season_id)
                 ->sum('final_marks');
 
                 //find the sum of the coef of the current class
                 $coef_sum = AssignSubject::where('class_id', $request->class_id)
                 ->where('branch_id', $request->branch_id)->sum('coef');
         
                  $fmarkAVG = ($sum_final_mark / $coef_sum) ;


                  //check if student final average exist 
                  $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id[$j])
                  ->where('year_id', $request->year_id)->where('season_id', $request->season_id)->get();

                  if($Avgcheck->toArray() == null){
                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $request->year_id;
                    $avg->season_id  = $request->season_id;
                    $avg->class_id  = $request->class_id;
                    $avg->branch_id  = $request->branch_id;
                    $avg->group_id  = $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $request->student_id[$j];
  
                    $avg->save();

                    //ANNUAL AVG
                 if ($request->season_id == 2 ) {

                         
                    $checkannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                    ->where('year_id', $request->year_id)->first();

                      //get  season 1 avg
                      $avg1 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                      ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                      ->where('season_id', 1)->first();
              
                      //get  season 2 avg
                      $avg2 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                      ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                      ->where('season_id', 2)->first();
              
                    

                      if($avg1 == null){
                            $annual_avg = ( $avg2->final_avg)/2;
                        }elseif($avg2 == null){
                            $annual_avg = ($avg1->final_avg )/2;
                        }else {
                            $annual_avg = ($avg1->final_avg + $avg2->final_avg)/2;
                        }

                        round( $annual_avg, 2);

                        //dd(round( $annual_avg, 2));
                    if($checkannualAVG == null){
                       
                        $annualAvg = new annualAVG();
                        $annualAvg->student_id = $request->student_id[$j];
                        $annualAvg->year_id = $request->year_id;
                        $annualAvg->class_id = $request->class_id;
                        $annualAvg->branch_id = $request->branch_id;
                        $annualAvg->group_id = $request->group_id;
                        $annualAvg->annual_avg =  round( $annual_avg, 2);

                        $annualAvg->save();

                    }else {
                        $updateannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                        ->where('year_id', $request->year_id)->first();

                        $updateannualAVG->annual_avg = round( $annual_avg, 2);

                        $updateannualAVG->save();
                    }
                    
                    }
                    
                  }else{
                    $Avgcheck = StudentFinalAVG::where('student_id', $request->student_id[$j])
                  ->where('year_id', $request->year_id)
                  ->where('season_id', $request->season_id)->delete();

                  $avg = new StudentFinalAVG();

                  $avg->year_id  = $request->year_id;
                  $avg->season_id  = $request->season_id;
                  $avg->branch_id  = $request->branch_id;
                  $avg->group_id  = $request->group_id;
                  $avg->class_id  = $request->class_id;
                  $avg->final_avg  = round($fmarkAVG, 2);
                  $avg->student_id  = $request->student_id[$j];

                  $avg->save();

                 //ANNUAL AVG
                 if ($request->season_id == 2 ) {

                         
                    $checkannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                    ->where('year_id', $request->year_id)->first();

                      //get  season 1 avg
                      $avg1 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                      ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                      ->where('season_id', 1)->first();
              
                      //get  season 2 avg
                      $avg2 = StudentFinalAVG::where('student_id', $request->student_id[$j])
                      ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                      ->where('season_id', 2)->first();
              
                     

                      if($avg1 == null){
                            $annual_avg = ( $avg2->final_avg)/2;
                        }elseif($avg2 == null){
                            $annual_avg = ($avg1->final_avg )/2;
                        }else {
                            $annual_avg = ($avg1->final_avg + $avg2->final_avg)/2;
                        }

                        round( $annual_avg, 2);

                        //dd(round( $annual_avg, 2));
                    if($checkannualAVG == null){
                       
                        $annualAvg = new annualAVG();
                        $annualAvg->student_id = $request->student_id[$j];
                        $annualAvg->year_id = $request->year_id;
                        $annualAvg->class_id = $request->class_id;
                        $annualAvg->branch_id = $request->branch_id;
                        $annualAvg->group_id = $request->group_id;
                        $annualAvg->annual_avg =  round( $annual_avg, 2);

                        $annualAvg->save();

                    }else {
                        $updateannualAVG = annualAVG::where('student_id', $request->student_id[$j])
                        ->where('year_id', $request->year_id)->first();

                        $updateannualAVG->annual_avg = round( $annual_avg, 2);

                        $updateannualAVG->save();
                    }
                    
                    }
                  }
                
                //UPPDATE FINAL AVG TABLE 

            }

            
        }
         
           /// MARKS AVERAGE END

            return redirect()->back()->with('success', '');
    }
   

    public function MarksEdit(Request $request){  ///view

        $data['years'] = StudentYear::all();
        $data['classes'] =  AssignClasse::with('student_class')
        ->groupBy('class_id')->get()->sortBy('student_class.name');
        $data['branchs'] =  StudentBranch::all();
        $data['groups'] =  StudentGroup::all();
        $data['exam_types'] = ExamType::all();
        $data['seasons'] = SchoolSeason::all();

        return view('backend.marks.marks_edit', $data);
    }

    public function MarksStudentEditSearch(Request $request){ /// to make a search 
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $branch_id = $request->branch_id;
        $group_id = $request->group_id;
        $season_id = $request->season_id;
        /* $exam_type_id = $request->exam_type_id; */
        $assign_subject_id = $request->assign_subject_id;

        $getStudents =  StudentMarks::select('student_marks.*')
        ->with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)->where('group_id', $group_id)
        ->where('assign_subject_id' ,$assign_subject_id)->where('branch_id', $branch_id)
        ->where('season_id', $season_id)
        ->leftjoin('users', 'student_marks.student_id', '=', 'users.id')->orderBy('users.name')
        ->groupBy('student_id')->get();

        /* $getStudents = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('year_id', $year_id)->where('class_id', $class_id)
        ->where('assign_subject_id' ,$assign_subject_id)
        ->where('group_id', $group_id)->where('branch_id', $branch_id)->groupBy('student_id')->get() */


        //dd($getStudents[0]->season_id);
        return response()->json($getStudents);

    }


    public function MarksStudentDetail($student_id, $assign_subject_id, $season_id){
        
        //dd($assign_subject_id);

        $data['detail'] = StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group'])
        ->where('student_id', $student_id)->get();

      
        $data['intero'] = StudentMarks::select('student_marks.*')->
        with(['student','assign_subject', 'exam_type'])->
        where('student_id', $student_id)->where('assign_subject_id', $assign_subject_id)->
        where('season_id', $season_id)->
        where('exam_types.description', 'Intero')->
        leftjoin('exam_types', 'student_marks.exam_type_id', '=', 'exam_types.id')->get();

        $data['devoirMarks'] = StudentMarks::select('student_marks.*')->
        with(['student','assign_subject', 'exam_type'])->
        where('student_id', $student_id)->where('assign_subject_id', $assign_subject_id)->
        where('season_id', $season_id)->
        where('exam_types.description', 'Devoir')->
        leftjoin('exam_types', 'student_marks.exam_type_id', '=', 'exam_types.id')->get();

        $data['examMarks'] = StudentMarks::select('student_marks.*')->with(['student','assign_subject', 'exam_type'])->
        where('student_id', $student_id)->where('assign_subject_id', $assign_subject_id)->
        where('season_id', $season_id)->
        where('exam_types.description', 'Examen')->
        leftjoin('exam_types', 'student_marks.exam_type_id', '=', 'exam_types.id')->get();

        //dd($data['examMarks']);
        return view('backend.marks.marks_detail', $data);

    }

    public function MarksStudentUpdate(Request $request,  $student_id, $assign_subject_id, $year_id, $season_id ){
        $findYear = StudentYear::where('active', 1)->first();
        $year_id = $findYear->id;
        if($request->i_marks == null  ){
            return redirect()->back()->with('error', '');
        }else{

            $count_i_marks = $request->i_marks != null ? count($request->i_marks) : 'null';
            $count_d_marks = $request->d_marks != null ? count($request->d_marks) : 'null';
            $count_e_marks = $request->e_marks != null ? count($request->e_marks) : 'null';

            
           
            //INTERO MARK UPDATE
            if($count_i_marks != NULL){
                $updateMark = StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['season_id', $season_id],
                    ['year_id', $year_id],
                    ['exam_type_id', '1']
                    ])->first(); 

                    $updateMark->marks = $request->i_marks[0];

                    $updateMark->save();
                    //dd($updateMark); 

                  /*   for($i=0; $i< $count_i_marks; $i++) {
                 
                    $i_mark = new StudentMarks();
                    $i_mark-> student_id = $student_id;
                    $i_mark-> id_no = $request->id_no;
                    $i_mark-> year_id = $year_id;
                    $i_mark-> class_id = $request->class_id;
                    $i_mark-> branch_id = $request->branch_id;
                    $i_mark-> group_id = $request->group_id;
                    $i_mark->assign_subject_id = $assign_subject_id;
                    $i_mark->season_id = $season_id;
                    $i_mark->exam_type_id = '1'; 
                    $i_mark->marks = $request->i_marks[$i];

                    $i_mark->save();
                    } */
                }

            //DEVOIR MARK UPDATE
            if($count_d_marks != NULL){
               
                 StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['season_id', $season_id],
                    ['year_id', $year_id],
                    ['exam_type_id', '2']
                    ])->delete();


                    //dd($updateMark); 

                    for($i=0; $i< $count_d_marks; $i++) {
                 
                    $d_mark = new StudentMarks();
                    $d_mark-> student_id = $student_id;
                    $d_mark-> id_no = $request->id_no;
                    $d_mark-> year_id = $year_id;
                    $d_mark-> class_id = $request->class_id;
                    $d_mark-> branch_id = $request->branch_id;
                    $d_mark-> group_id = $request->group_id;
                    $d_mark->assign_subject_id = $assign_subject_id;
                    $d_mark->season_id = $season_id;
                    $d_mark->exam_type_id = '2'; 
                    $d_mark->marks = $request->d_marks[$i];

                    $d_mark->save();
                    }
                }
            
            //EXAM MARKS UPDATE
            if($count_e_marks != NULL){
               
                $updateExamMark = StudentMarks::where( [
                    [ 'student_id' ,$student_id], 
                    [ 'assign_subject_id' ,$assign_subject_id], 
                    ['season_id', $season_id],
                    ['year_id', $year_id],
                    ['exam_type_id', '3']
                    ])->get();

                    

                for($i=0; $i< $count_e_marks; $i++) {
                   /*  $e_mark = new StudentMarks();
                    $e_mark-> student_id = $student_id;
                    $e_mark-> id_no = $request->id_no;
                    $e_mark-> year_id = $request->year_id;
                    $e_mark-> class_id = $request->class_id;
                    $e_mark-> branch_id = $request->branch_id;
                    $e_mark-> group_id = $request->group_id;
                    $e_mark->assign_subject_id = $assign_subject_id;
                    $e_mark->season_id = $request->season_id;
                    $e_mark->exam_type_id = '2'; */
                    $updateExamMark[$i]->marks = $request->e_marks[$i];
        
                    $updateExamMark[$i]->save();
                    }
                }
           
    
        }

        /// MARKS AVERAGE START
        $updateFinalMark = Student_final_mark::where( [
            [ 'student_id' ,$student_id], 
            [ 'assign_subject_id' ,$assign_subject_id], 
            ['season_id', $season_id],
            ['year_id', $year_id],
            ])->get();

            $subjects = AssignSubject::with(['school_subject'])
            ->where('id', $assign_subject_id )->first();

         /*  
            $marksByDevoirAVG = StudentMarks::where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', '1')->where('student_id', $student_id)
            ->where('year_id', $year_id)
            ->where('season_id', $season_id)->avg('marks');
    
            $marksBysubjectExam = StudentMarks::where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', '2')->where('student_id', $student_id)
            ->where('year_id', $year_id)
            ->where('season_id', $season_id)->first(); 
            
            $examMArk = $marksBysubjectExam->marks; 
            $totalAVG =( $examMArk + $marksByDevoirAVG)/2;*/

            $totalAVG = StudentMarks::where('assign_subject_id', $assign_subject_id)
            ->where('student_id', $student_id)
            ->where('year_id', $year_id)
            ->where('season_id', $season_id)->avg('marks');


            
          
            
            $finalMark =   $totalAVG * $subjects->coef ;
            //dd($subjects->coef);
            if ($updateFinalMark->toArray() == null) {
                
                $finalMrk = new Student_final_mark();
                $finalMrk->student_id =  $student_id;
                $finalMrk->id_no =  $request->id_no;
                $finalMrk->year_id =   $year_id;
                $finalMrk->class_id =  $request->class_id;
                $finalMrk->group_id =  $request->group_id;
                $finalMrk->branch_id =  $request->branch_id;
                $finalMrk->assign_subject_id = $assign_subject_id;
                $finalMrk->season_id = $season_id;
                $finalMrk->final_marks = round($finalMark, 2) ;

                $finalMrk->save();


            }else{
                //find the existing mark to update
                $finalMrk =  Student_final_mark::where( 'student_id', $student_id )
                ->where( 'year_id', $year_id )->where( 'season_id', $season_id )
                ->where( 'assign_subject_id',$assign_subject_id )->first();
               
                $finalMrk->final_marks =  round($finalMark, 2) ;
                
                 $finalMrk->save();

            }

           
            //dd($updateFinalMark);

            /// MARKS AVERAGE END


             //UPDATE FINAL AVG TABLE 
                 //find the sum of all the final mark for the student
                 $sum_final_mark = Student_final_mark::where('student_id', $student_id)
                 ->where('year_id', $year_id)->where('season_id', $season_id)
                 ->sum('final_marks');
 
                 //find the sum of the coef of the current class
                 $coef_sum = AssignSubject::where('class_id', $request->class_id)
                 ->where('branch_id',  $request->branch_id)->sum('coef');
         
                  $fmarkAVG = ($sum_final_mark / $coef_sum) ;
                

                  //check if student final average exist
                  $Avgcheck = StudentFinalAVG::where('student_id', $student_id)
                  ->where('year_id', $year_id)->where('season_id', $season_id)->get();

                  if($Avgcheck->toArray() == null){
                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $year_id;
                    $avg->season_id  = $season_id;
                    $avg->class_id  =  $request->class_id;
                    $avg->branch_id  =  $request->branch_id;
                    $avg->group_id  =  $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $student_id;
  
                    $avg->save();
                  }else{
                    $Avgcheck = StudentFinalAVG::where('student_id', $student_id)
                    ->where('year_id', $year_id)
                    ->where('season_id', $season_id)->delete();
  

                    $avg = new StudentFinalAVG();

                    $avg->year_id  = $year_id;
                    $avg->season_id  = $season_id;
                    $avg->class_id  =  $request->class_id;
                    $avg->branch_id  =  $request->branch_id;
                    $avg->group_id  =  $request->group_id;
                    $avg->final_avg  = round($fmarkAVG, 2);
                    $avg->student_id  = $student_id;
  
                    $avg->save();

                    //ANNUAL AVG
                    if ($request->season_id == 2 ) {

                         
                        $checkannualAVG = annualAVG::where('student_id', $request->student_id)
                        ->where('year_id', $request->year_id)->first();

                           //get  season 1 avg
                           $avg1 = StudentFinalAVG::where('student_id', $request->student_id)
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 1)->first();
                   
                           //get  season 2 avg
                           $avg2 = StudentFinalAVG::where('student_id', $request->student_id)
                           ->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                           ->where('season_id', 2)->first();
                   
                           

                           if($avg1 == null){
                                $annual_avg = ( $avg2->final_avg)/2;
                            }elseif($avg2 == null){
                                $annual_avg = ($avg1->final_avg )/2;
                            }else {
                                $annual_avg = ($avg1->final_avg + $avg2->final_avg)/2;
                            }

                           round( $annual_avg, 2);

                        if($checkannualAVG == null){
                         
                            $annualAvg = new annualAVG();
                            $annualAvg->student_id = $request->student_id;
                            $annualAvg->year_id = $request->year_id;
                            $annualAvg->class_id = $request->class_id;
                            $annualAvg->branch_id = $request->branch_id;
                            $annualAvg->group_id = $request->group_id;
                            $annualAvg->annual_avg =  round( $annual_avg, 2);

                            $annualAvg->save();

                        }else {
                            $updateannualAVG = annualAVG::where('student_id', $request->student_id)
                            ->where('year_id', $request->year_id)->first();

                            $updateannualAVG->annual_avg = round( $annual_avg, 2);

                            $updateannualAVG->save();
                        }
                        
                    }
                  }

                
                //UPPDATE FINAL AVG TABLE
            
             return redirect()->back()->with('update', '');
        }

 
    /* public function MarksStudentUpdate(Request $request){

        StudentMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)
        ->where('branch_id', $request->branch_id)->where('group_id', $request->group_id)
        ->where('exam_type_id', $request->exam_type_id)
        ->where('assign_subject_id', $request->assign_subject_id)->delete();

        $studenCount = $request->student_id;

        if($studenCount){
            for ($i=0 ; $i<count($request->student_id) ; $i++){

             $data = new StudentMarks();
             $data->year_id = $request->year_id;
             $data->class_id = $request->class_id;
             $data->branch_id = $request->branch_id;
             $data->group_id = $request->group_id;
             $data->assign_subject_id = $request->assign_subject_id;
             $data->exam_type_id = $request->exam_type_id;
             $data->student_id = $request->student_id[$i];
             $data->id_no = $request->id_no[$i];
             $data->marks = $request->marks[$i];

             $data->save();

            }
        }

         return redirect()->back();
 } */

}
