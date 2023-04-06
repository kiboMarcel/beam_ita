@foreach ($allData as $item)
<!DOCTYPE html>

<html>
<head>
    <style>

        @page {
        margin: 30px 15px;
        }

        
        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 10px;

        }

        .text-div {
            float: right;
        }

        .text-div h5,  h6 {            
            font-weight: lighter;
            font-size: 12px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .logo {
            float: left;
            width: 15%;
        }

        .logo-right {
            float: right;
            text-align: center;
            width: 25%;
        }

        body {
            font-family: sans-serif;
            /* background-color: #CFB077; */
        }

        body h2{
            text-align: center;
            font-size: 20px;
            margin: 0;
        }

        .season_div{
            margin: 0 50px 0 60px;
            text-align: center;
            /* width: 78%; */
            border: 2px solid blueviolet;
            padding: 8px;
        }

        .season_div span {
            font-size: 20px;
            font-weight: bold;
        }

        .detail {
            float: left;
            width: 80%;
            margin-top: 15px;
            margin-bottom:20px;
        }

        .detail h5,  h6 {
            
            font-weight: lighter;
            font-size: 16px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .detail table {
            
            font-weight: lighter;
            font-size: 17px;
          
        }

        .student-info {
            float: right;
        }

        .student-info h5,  h6 {     
            font-weight: lighter;
            font-size: 12px;
            padding-left: 12px;
            padding-top: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .location {
            float: right;
            text-align: center;
            width: 60%;
        }

      
        body h3 {
            font-weight: lighter;
            margin-bottom: 5px;
            text-align: center;
        }

        body h4 {
            font-weight: lighter;
        }

        img {
            width: 100px;
        }


        tr,
        td {
            border: 1px solid black;
        }

        table,
        tr,
        td {
            border-collapse: collapse;
        }


        .border_style { 
            border: none !important;
           
        }

        .border_style td {
            border: none !important;
            padding-top: 20px;
            font-size: 20px;
        }

        .border_style2 { 
            border: none !important;
           
        }

        .border_style2 td {
            border: none !important;
            padding-top: 10px;
            font-size: 20px;
           /*  height: 50px; */
        }

        .void_space td{
        }

        .total_style {
            border-bottom: 1px solid black;
            border-left: none;
        }

        .td-text {
            text-align: center;
        }

        .tr-space {
            margin-left: 42px;
        }

        .observation_td, h6 {
            font-size: 14px;
        }
        
        .bilan {
            float: left;
            width: 54%;
            margin-top: 0px;
            margin-bottom:10px;
        }

     

        .marks {
            float: right;
            width: 45%;
        }

        .marks span {
            
            font-weight: lighter;
            font-size: 14px;
            padding-left: 12px;
        }

        .habit{
            float: left;
            width: 15%;
        }

      
        .season-avg {
            float: right;
            margin-left: 100px;
        }

        .final-avg{
            border: 1px solid gray;
            padding: 5px;
            width: 7%;
            display: inline-block;
        }

        .wrapper{
            border: 1px solid;
            float: left;
            width: 54%;
        }

         .attendance {
            float: left;
            width: 45%;
            margin-top: 10px;
            margin-bottom:10px;
            padding-left: 12px;
        }

        .attendance span {
            font-weight: lighter;
            font-size: 13px;
        }

        .attendance h5{
            
            font-weight: lighter;
            font-size: 13px;
            padding-left: 12px;
            padding-top: 5px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .teacher{
            float: left;
            border-left: 1px solid;
            padding-left:12px;
        }

        .teacher span{
            font-weight: lighter;
            font-size: 13px;
            padding-left: 0;
            margin-top: 0;
            margin-bottom: 0;
        }
        .teacher h5{
            font-weight: lighter;
            font-size: 13px;
            text-align: center;
            padding-left: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .remark {
            float: right;
            width: 35%;
            padding-right: 10px;
        }

        .remark h6 {
            text-align: left;
            font-size: 15px;
        }

        .note {
            margin-top:10px;
            float:left;
            width: 60%;
        }
        .note h6{
            font-weight: lighter;
            font-size: 13px;
            padding-left: 20px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .note h5{
            font-size: 18px; 
            width: 75%;
            text-align: center;
            font-style: italic;
            margin-top:12px;
        }

        .warning{
            float: right;
        }

        .warning  h6{
            font-weight: lighter;
            font-size: 11px;
        }

        .footer h4{
            margin-top: 0px;
        }

        .hide-avg{
            display: none;
        }

        footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 0.5cm;

               
            }
            
            </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>


     @php
          //attendance
        $student_attendance = App\Models\StudentAttendance::where('year_id', $item->year_id)
            ->where('student_id', $item->student_id)->where('class_id', $item->class_id)
            ->where('branch_id',  $item->branch_id)
            ->where('season_id',  $season_id)
            ->where('group_id',  $item->group_id)->first();


        for( $i =0 ; $i < count($subjects); $i++ ){
            
            for( $j =0 ; $j < count($allData); $j++ ){

                $duplicateRecords = App\Models\Student_final_mark::where('assign_subject_id',$subjects[$i]->id)
                ->where('student_id', $allData[$j]->student_id)
                ->where('year_id', $allData[$j]->year_id)
                ->where('group_id',$allData[$j]->group_id)
                ->where('season_id',$season_id)
                ->groupBy('student_id',
                'assign_subject_id','year_id','group_id','season_id')
                ->get();

                $recordId = array_column($duplicateRecords ->toArray(), 'id');

                //dd($recordId);

                $deleteRecord = App\Models\Student_final_mark::where('assign_subject_id', $subjects[$i]->id)
                ->where('student_id', $allData[$j]->student_id)
                ->where('year_id', $allData[$j]->year_id)
                ->where('group_id',$allData[$j]->group_id)
                ->where('season_id',$season_id)
                ->whereNotIn('id', $recordId )->delete();
            }

              
        }


        //get marks
        $marks = App\Models\StudentMarks::with(['student', 'student_class', 'student_branch', 'student_group' ,'season'])
        ->where('student_id', $item->student_id)->where('year_id', $item->year_id)
        ->where('class_id', $item->class_id)->where('season_id', $season_id)
        ->where('group_id', $item->group_id)->where('branch_id', $item->branch_id)->get();

        //get Status
        $status = App\Models\AssignStudent::where('student_id', $item->student_id)
        ->where('year_id', $item->year_id)->first();

       
        //total season avg --somme des note definitif du semestre ***** Totale des matieres du trimestre ou semestre
        $seasonAvg = App\Models\Student_final_mark::where('student_id', $item->student_id)
        ->where('year_id', $item->year_id)->where('class_id', $item->class_id)
        ->where('season_id', $season_id)->sum('final_marks');

        //final mark avg -- Moyenne final du trimestre
        $marks_avg = App\Models\StudentFinalAVG::where('student_id', $item->student_id)
        ->where('year_id', $item->year_id)->where('class_id', $item->class_id)
        ->where('season_id', $season_id)->first();



        DB::statement(DB::raw('set @rank:=0'));
                    
        $finalrank = App\Models\StudentFinalAVG::selectRaw('*, @rank:=@rank+1 as rank')
            ->where('year_id', $item->year_id)
            ->where('class_id', $item->class_id)
            ->where('branch_id', $item->branch_id)
            ->where('group_id', $item->group_id)
            ->where('season_id', $season_id)
            ->orderBy('final_avg', 'DESC')
            ->get();
        
        for ($i = 0; $i < count($finalrank->toArray()); $i++) {
            if ($finalrank[$i]->student_id == $item->student_id) {
                $student_rank = $finalrank[$i]->rank;
            }
        }
        DB::statement(DB::raw('set @annualRank:=0'));
        $annualRank = App\Models\annualAVG::selectRaw('*, @annualRank:=@annualRank+1 as annualRank')
        ->where('year_id', $item->year_id)
        ->where('class_id', $item->class_id)
        ->where('branch_id', $item->branch_id)
        ->where('group_id', $item->group_id)
        ->orderBy('annual_avg', 'DESC')
        ->get();
    
    for ($i = 0; $i < count($annualRank->toArray()); $i++) {
        if ($annualRank[$i]->student_id == $item->student_id) {
            $annualRank = $annualRank[$i]->annualRank;
        }
    }
        
        // STORE SEASON RANK FOR THE STUDENT
        $store_rank =  App\Models\StudentFinalAVG::where('year_id', $item->year_id)
        ->where('class_id', $item->class_id)->where('branch_id', $item->branch_id)
        ->where('student_id', $item->student_id)
        ->where('group_id', $item->group_id)->where('season_id', $season_id)->first();

        $store_rank->rank = $student_rank;

        $store_rank->save();

         //get  season 1 avg
         $avg1 = App\Models\StudentFinalAVG::where('student_id', $item->student_id)
         ->where('year_id', $item->year_id)->where('class_id', $item->class_id)
         ->where('season_id', 1)->first();
 
         //get  season 2 avg
         $avg2 = App\Models\StudentFinalAVG::where('student_id', $item->student_id)
         ->where('year_id', $item->year_id)->where('class_id', $item->class_id)
         ->where('season_id', 2)->first();
 
         //get  season 3 avg
         $avg3 = App\Models\StudentFinalAVG::where('student_id', $item->student_id)
         ->where('year_id', $item->year_id)->where('class_id', $item->class_id)
         ->where('season_id', 3)->first();

         $checkLevel = App\Models\StudentClass::find($item->class_id);
         if ($checkLevel->level == 2){
            if ($season_id == 2) {
                $annual_avg =  App\Models\annualAVG::where('student_id', $item->student_id)
                ->where('year_id', $item->year_id)->first();
    
                 
             }
         }else{
            if ($season_id == 3) {
                $annual_avg =  App\Models\annualAVG::where('student_id', $item->student_id)
                ->where('year_id', $item->year_id)->first();
    
                 
             }
         }
        


     @endphp

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpeg')
                : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>

        <div class="logo-right">
           <h6> REPUBLIQUE TOGOLAISE</h6>
           <h6> Travail-Liberté-Patrie</h6>
        </div>

        <div class="text-div">

            <h6> <strong>{{$school_info== null? '': $school_info->name }}</strong> </h6>

            <h6> {{$school_info== null? '': $school_info->Address  }}
                {{$school_info== null? '': $school_info->district}}
                {{$school_info == null? '': $school_info->num}}</h6>
            <h6>Lomé-Togo</h6>
        </div>

    </div>
    @php
        $end = $marks['0']['season']['id']== 1 ? 'er': 'ème'
    @endphp

    <div class="season_div">
         
            @if ($marks['0']['student_class']['level'] == 2)
            <h2> BULLETIN DE NOTE DU  {{ $marks['0']['season']['name'] }}
                {{$end}} Semestre  {{ $marks['0']['student_year']['name'] }} </h2>
            @else
            <h2> BULLETIN DE NOTE DU  {{ $marks['0']['season']['name'] }}
                {{$end}} Trimestre {{ $marks['0']['student_year']['name'] }} </h2>
            @endif
        
    </div>

    <div class="">
     
        <div class="detail">
            <h5>N mat:  <strong>     {{ $marks['0']['student']['id_no'] }} </strong> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nom Prénoms:
                 <strong>  {{ $marks['0']['student']['name'] }}  </strong>   
            </h5>

            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 25%;"  class="td-text">Date de naissance</td>
                        <td style="width: 25%;"  class="td-text">Lieu de naissance</td>
                        <td style="width: 10%;"  class="td-text">Sexe</td>
                        <td style="width: 10%;"  class="td-text">Classe</td>
                        <td style="width: 20%;"  class="td-text">Status</td>
                        <td style="width: 15%;"  class="td-text">Effectif</td>
                    </tr>

                    <tr>
                        <td style="width: 11%;"  class="td-text"> {{ date('d-m-Y', strtotime($marks['0']['student']['date_of_birth'])) }}  </td>
                        
                        <td style="width: 25%;"  class="td-text">  {{ $marks['0']['student']['place_of_birth'] }}  </td>
                        
                        <td style="width: 10%;"  class="td-text"> {{ $marks['0']['student']['gender'] }}</td>
                       
                        <td style="width: 20%;"  class="td-text">{{$marks['0']['student_class']['name'] }} 
                            {{ $marks['0']['student_branch']['name'] }}  {{ $marks['0']['student_group']['name'] }}</td>
                        
                        <td style="width: 20%;"  class="td-text"> {{ $status->status }} </td>
                       
                        <td style="width: 15%;"  class="td-text">  {{ $totalStudent }} </td>
                    </tr>
                   
                 
                </tbody>
            </table> 

        </div>
      
  
       
       
    </div>


    <table style="width: 100%; font-size: 17px;">
        <tbody>
            <tr>
                <td style="width: 25%;" rowspan="2" class="td-text">Matières </td>
                <td style="width: 20%;" colspan="4" class="td-text"> Note sur 20</td>
                <td style="width: 25%;" rowspan="2" class="td-text"> Coef </td>
                <td style="width: 15%;" rowspan="2" class="td-text">Moy </td>
                <td style="width: 5%;"  rowspan="2" class="td-text">Rangs </td>
                <td style="width: 15%;" rowspan="2" class="td-text">Observation</td>
                <td style="width: 15%;" rowspan="2" colspan="2" class="td-text">Nom et signature des Professeurs</td>
            </tr>

            <tr>
                <td class="td-text"> Intero</td>
                <td class="td-text">Dev.</td>
                <td class="td-text">Comp.</td>
                <td class="td-text">Moy</td>
            </tr>

            

            @foreach ($subjects as $subject)

            @php
                $marksBysubjectIntero = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                    ->where('exam_type_id', '1')
                    ->where('student_id', $marks[0]->student_id)
                    ->where('season_id', $marks[0]->season_id)
                    ->where('year_id', $marks[0]->year_id)
                    ->first();
                
                $marksBysubjectDevoir = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                    ->where('exam_type_id', '2')
                    ->where('student_id', $marks[0]->student_id)
                    ->where('season_id', $marks[0]->season_id)
                    ->where('year_id', $marks[0]->year_id)
                    ->first();
                
                $marksBysubjectExam = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                    ->where('exam_type_id', '3')
                    ->where('student_id', $marks[0]->student_id)
                    ->where('season_id', $marks[0]->season_id)
                    ->where('year_id', $marks[0]->year_id)
                    ->first();

                $marksAVG = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                    ->where('student_id', $marks[0]->student_id)
                    ->where('season_id', $marks[0]->season_id)
                    ->where('year_id', $marks[0]->year_id)
                    ->avg('marks');
                
                
                
            @endphp

            {{-- SUBJECT NAME --}}
            
            <tr>
                <td> {{ $subject['school_subject']['name'] }}</td>
               
            </tr>

            
                <td style="width: 3.75%;" class="td-text"> 
                    {{ $marksBysubjectIntero == null ? '-': $marksBysubjectIntero->marks }}
                </td>

                <td style="width: 3.75%;" class="td-text"> 
                    {{ $marksBysubjectDevoir == null ? '-': $marksBysubjectDevoir->marks }}
                </td>

                <td style="width: 3.75%;" class="td-text"> 
                    {{ $marksBysubjectExam == null ? '-': $marksBysubjectExam->marks }}
                </td>

                <td style="width: 3.75%;" class="td-text"> 
                    {{ $marksAVG == null ? '-': round($marksAVG, 2)  }}
                </td>

                <td style="width: 2.75%;" class="td-text"> 
                    {{ $subject == null ? '-':  $subject->coef   }}
                </td>

                @php
                //$finalMark = $totalAVG * $subject->coef;
                
                
                $getfinal_marks = App\Models\Student_final_mark::where('student_id', $marks['0']->student_id)
                    ->where('year_id', $marks['0']->year_id)
                    ->where('season_id', $marks['0']->season_id)
                    ->where('assign_subject_id', $subject->id)
                    ->first();
         
                
                @endphp

                <td style="width: 3.75%;" class="td-text"> 
                    {{ $getfinal_marks == null ? '-': round($getfinal_marks->final_marks, 2)  }}
                </td>

                 {{-- POSITION MARK START --}}
                 @php
                   
            

                 DB::statement(DB::raw('set @rank:=0'));
                 
                 $rank = App\Models\Student_final_mark::selectRaw('*, @rank:=@rank+1 as rank')
                     ->where('assign_subject_id', $subject->id)
                     ->where('year_id', $marks['0']->year_id)
                     ->where('group_id',$marks['0']->group_id)
                     ->where('season_id', $marks['0']->season_id)
                     ->orderBy('final_marks', 'DESC')
                     ->get();
                //dd($rank);
                $subjectrank = '-';
                 for ($i = 0; $i < count($rank->toArray()); $i++) {
                     if ($rank[$i]->student_id == $marks['0']->student_id) {
                         $subjectrank = $rank[$i]->rank;
                     }
                 }
                 //dd(intval($marksAVG));
                 switch ( intval($marksAVG) ) {
                    case 4:
                    case 5:
                        $appreciation = 'Travail faible';
                        break;

                    case 6:
                    case 7:
                        $appreciation = 'Travail très insuffisant';
                        break;

                    case 8:
                    case 9:
                        $appreciation = 'Insuffisant. Doit mieux faire';
                        break;

                    case 10:
                    case 11:
                        $appreciation = 'Passable. Peut mieux faire';
                        break;
                     
                    case 12:
                    case 13:
                        $appreciation = 'Travail assez bien';
                        break;

                    case 14:
                    case 15:
                        $appreciation = 'Bon travail';
                        break;
                     
                    case 16:
                    case 17:
                        $appreciation = 'Très bien. Félicitation';
                        break;

                    case 18:
                    case 19:
                    case 20:
                        $appreciation = 'Excellent. Félicitation';
                        break;
                     
                     default:
                        $appreciation = 'Travail faible';
                         break;
                 }
                 
                @endphp

             <td class="td-text"> {{  $marksAVG == null ? '-':  $subjectrank.'e' }}</td>

             {{-- POSITION MARK END --}}


                   {{-- SUBJECTIVE REMARKS START --}}
               <td class="observation_td"> <h6> {{$appreciation}} </h6></td>
               {{-- SUBJECTIVE REMARKS END --}}

                

               

               @php
                    //get teacher by subjects
                    if ($branch_id == 'null') {
                        $branch_id = null;
                    }

                    $teachers = App\Models\SubjectTeacher::where('year_id', $year_id)->with(['user'])
                    ->where('class_id', $class_id)->where('branch_id', $branch_id)
                    ->where('group_id', $group_id)->where('subject_id', $subject->id)->first();

               @endphp

               {{-- SUGJFECT TEACHER  START --}}
               <td style="width: 8%;"> {{ $teachers['user']['name'] }} </td>
               <td style="width: 5%;">  </td>
               {{-- SUGJFECT TEACHER END --}}




        @endforeach

           <tr class="border_style">
                <td colspan="4" > &emsp;&emsp;&emsp;Total des notes coefficiées:</td>
                {{-- <td class="td-text"> {{ $marks_avg->final_avg }} </td> --}}
                <td>  </td>
                <td colspan="2"> <strong>  {{ round($seasonAvg, 1) }}</strong> </td>
                <td colspan="3"> Moyenne Trimestrielle: <strong>  
                    {{ number_format($marks_avg->final_avg, 2)  }} </strong> sur 20 
                </td>
            </tr>


            @php
                if( $student_rank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                    $ranking = 'ere';
                }elseif ( $student_rank == 1 ) {
                    $ranking = 'er';
                }else{
                    $ranking = 'ème';
                }
            @endphp

            <tr class="border_style2">
                <td colspan="4"> &emsp;&emsp;&emsp;Total des coefficients:</td>
                <td>  </td>
                <td> <strong> {{ $coefSum }}  </strong> </td>
                <td>  </td>
                <td colspan="3"> Rang occupé:  <strong> 
                    {{ $student_rank }}  {{$ranking}} 
                    </strong> sur  {{ $totalStudent }}
                </td>
            </tr>
        
        </tbody>

    </table>

    <hr style="width: 65%" >
    <div class="footer">
        {{-- <h4> <strong> BILAN</strong> </h4> --}}
        <div class="bilan">
            <table style="width: 100%;  font-size: 16px;">
                <tbody>
                    <tr>
                        <td style="width: 25%;" rowspan="2" class="td-text"></td>
                        <td style="width: 50%;" colspan="4" class="td-text">Moyenne</td>
                    </tr>
                    <tr>
                        @if ($marks['0']['student_class']['level'] == 2)
                            <td style="width: 25%;" class="td-text">1er sem</td>
                            <td style="width: 25%;" class="td-text">2er sem</td>
                            <td style="width: 35%;" class="td-text">Moy. Annuelle</td>
                        @else
                       
                            <td style="width: 25%;" class="td-text">1er trim</td>
                            <td style="width: 25%;" class="td-text">2er trim</td>
                            <td style="width: 25%;" class="td-text">3er trim</td>
                            <td style="width: 35%;" class="td-text">Moy. Annuelle</td>
                        @endif
                       
                    </tr>
                    @php
                    if ($avg1 !=null) {
                        if(  ($avg1->rank == 1) && ($marks['0']['student']['gender'] == 'Feminin')){
                            $rank1 = 'ere';
                        }elseif ( $avg1->rank == 1 ) {
                            $rank1 = 'er';
                        }else{
                            $rank1 = 'ème';
                        }
                    }

                    if ($avg2 !=null) {
                        if( $avg2->rank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $rank2 = 'ere';
                        }elseif ( $avg2->rank == 1 ) {
                            $rank2 = 'er';
                        }else{
                            $rank2 = 'ème';
                        }
                    }

                    if ($avg3 !=null) {
                        if( $avg3->rank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $rank3 = 'ere';
                        }elseif ( $avg3->rank == 1 ) {
                            $rank3 = 'er';
                        }else{
                            $rank3 = 'ème';
                        }
                    }
                        
                    

                    $checkLevel = App\Models\StudentClass::find($class_id);
                    
                    if ($checkLevel->level == 2){

                        if ($season_id==2 ) {
                            if( $annualRank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $annualrank = 'ere';
                        }elseif ( $annualRank == 1 ) {
                            $annualrank = 'er';
                        }else{
                            $annualrank = 'ème';
                        }
                        }
                    }else{

                        if ($season_id==3 ) {
                            if( $annualRank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $annualrank = 'ere';
                        }elseif ( $annualRank == 1 ) {
                            $annualrank = 'er';
                        }else{
                            $annualrank = 'ème';
                        }
                        }
                    }

                       

                      
                        
                    @endphp
                    <tr>
                        <td class="td-text" >Moy. géné.</td>

                        {{-- Season Check Semestre/Trimestre --}}
                        @if ($marks['0']['student_class']['level'] == 2)
                        <td class="td-text"> <strong> {{ $avg1==null? '': number_format($avg1->final_avg, 2)  }} </strong> </td>
                        
                        <td class="td-text"> <strong  class=" {{ ( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}"> 
                            {{ $avg2==null? '': number_format($avg2->final_avg, 2)  }} </strong> 
                        </td>


                        <td class="td-text" >  <strong> {{ $season_id==2 ? $annual_avg->annual_avg: '' }} </strong>  </td>

                        @else
                       
                        <td class="td-text"> <strong> {{ $avg1==null? '': number_format($avg1->final_avg, 2)  }} </strong> </td>
                        
                        <td class="td-text"> <strong  class=" {{ ( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}"> 
                            {{ $avg2==null? '': number_format($avg2->final_avg, 2)  }} </strong> 
                        </td>

                        <td class="td-text "> <strong class=" {{ $season_id ==3 ? '': 'hide-avg'  }}"> 
                            {{ $avg3==null? '': number_format($avg3->final_avg, 2)  }} </strong>
                         </td>

                        <td class="td-text" >  <strong> {{ $season_id==3 ? $annual_avg->annual_avg: '' }} </strong>  </td>
                        @endif

                      
                    </tr>

                    <tr>
                        <td class="td-text">Rang</td>


                          {{-- Season Check Semestre/Trimestre --}}
                          @if ($marks['0']['student_class']['level'] == 2)
                          <td class="td-text"> <strong>{{ $avg1==null? '': $avg1->rank }}  {{$rank1}} </strong></td>

                        <td class="td-text"> <strong class=" {{( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}">
                             {{ $avg2 ==null? '': $avg2->rank }} {{ $avg2 ==null? '': $rank2}} </strong>
                            </td>

                        <td class="td-text">  <strong>{{  $season_id==2 ? $annualRank: ''  }} {{  $season_id==2 ? $annualrank: ''  }} 
                            </strong> </td>

  
                          @else
                         
                          <td class="td-text"> <strong>{{ $avg1==null? '': $avg1->rank }}  {{$rank1}} </strong></td>

                        <td class="td-text"> <strong class=" {{( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}">
                             {{ $avg2 ==null? '': $avg2->rank }} {{ $avg2 ==null? '': $rank2}} </strong>
                            </td>

                        <td class="td-text"> <strong  class=" {{ $season_id ==3 ? '': 'hide-avg'  }}"> 
                            {{ $avg3 ==null? '': $avg3->rank }}  {{  $avg3 ==null? '': $rank3}}</strong>
                        </td>

                        <td class="td-text">  <strong>{{  $season_id==3 ? $annualRank: ''  }} {{  $season_id==3 ? $annualrank: ''  }} 
                        </strong> </td>
                          @endif

                       
                    </tr>
                 
                </tbody>
            </table>
        </div>
      
        <div class="marks">
            <span>  Moyenne la plus élevée de la classe:  &nbsp;<strong>{{  number_format($marks_avg_max, 2)  }}</strong>  </span> <br>
            <span>  Moyenne la plus failbe de la classe:  &nbsp;&nbsp; <strong>  {{  number_format($marks_avg_min, 2) }}</strong> </span> <br>
            <span>  Moyenne générale de la classe:  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;<strong>{{  number_format($class_avg, 2) }}</strong> </span>
        </div>

    </div>



    <div style="border:1px solid;">
        <div class="wrapper">
            <div class="attendance">
                <span>Retard &ensp;&ensp;&nbsp;&nbsp; <strong> {{$student_attendance== null? '0' : $student_attendance->retard}} </strong> &nbsp;&nbsp; fois 
                </span> <br>
                <span>Absence&ensp; &nbsp;<strong> {{$student_attendance== null? '0' : $student_attendance->absences}} </strong> &nbsp; &nbsp; heure(s) 
                </span> <br>
                <span>Punitions &nbsp; <strong> {{$student_attendance== null? '0' : $student_attendance->punition}} </strong>  
                </span>
            
            <hr>
                @switch(intval($marks_avg->final_avg))
                    @case(20)
                    @case(19)
                    @case(18)
                    @case(17)
                    @case(16)
                    <span>Félicitation &emsp;&emsp;&emsp;&emsp;&emsp; 
                        <input type="checkbox" checked="checked" > 
                          
                    </span> <br>

                    <span>Encouragement &ensp;&ensp;&ensp;&ensp;&ensp; 
                        <input type="checkbox" checked="checked" name="" id=""> 
                          
                    </span> <br>

                    <span>Tableau d'honneur &ensp;&ensp; 
                        <input type="checkbox"  name="" id=""> 
                          
                    </span> <br>
                        @break

                    @case(15)
                    @case(14)
                    <span>Félicitation &emsp;&emsp;&emsp;&emsp;&emsp; 
                        <input type="checkbox" checked="checked" > 
                          
                    </span> <br>

                    <span>Encouragement &ensp;&ensp;&ensp;&ensp;&ensp; 
                        <input type="checkbox"  name="" id=""> 
                          
                    </span> <br>

                    <span>Tableau d'honneur &ensp;&ensp; 
                        <input type="checkbox" name="" id=""> 
                          
                    </span> <br>

                        @break

                    @case(13)
                    @case(12)
                    <span>Félicitation &emsp;&emsp;&emsp;&emsp;&emsp; 
                        <input type="checkbox"  > 
                          
                    </span> <br>

                    <span>Encouragement &ensp;&ensp;&ensp;&ensp;&ensp; 
                        <input type="checkbox"  name="" id=""> 
                          
                    </span> <br>

                    <span>Tableau d'honneur &ensp;&ensp; 
                        <input type="checkbox" checked="checked" name="" id=""> 
                          
                    </span> <br>

                        @break
                   
                    @default
                    <span>Félicitation &emsp;&emsp;&emsp;&emsp;&emsp; 
                        <input type="checkbox"  name="" id="">

                    <span>Encouragement &ensp;&ensp;&ensp;&ensp;&ensp; 
                        <input type="checkbox"  name="" id=""> 
                              
                    </span> <br>

                    <span>Tableau d'honneur &ensp;&ensp; 
                        <input type="checkbox"  name="" id=""> 
                          
                    </span> <br>
                        
                @endswitch
                
                
               

            
            @if ($student_attendance != null)
                @if (($student_attendance->absences>=5) && ($student_attendance->absences<=14) )
                <span>Avertissement &emsp;&emsp;&nbsp;&nbsp;&ensp; 
                <input type="checkbox" checked="checked" name="" id=""> 
                    
                </span> <br>
                @else
                <span>Avertissement &emsp;&emsp;&nbsp;&nbsp;&ensp; 
                <input type="checkbox" name="" id=""> 
                    
                </span> <br>
                @endif


                @if (($student_attendance->absences>=15)  )
                <span>Avertissement &emsp;&emsp;&nbsp;&nbsp;&ensp; 
                <input type="checkbox" checked="checked" name="" id=""> 
                    
                </span> <br>
                @else
                <span>Blame &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="checkbox"  name="" id=""> 
                    
                </span> 
                @endif
            @else
            <span>Avertissement &emsp;&emsp;&nbsp;&nbsp;&ensp; 
                <input type="checkbox" name="" id=""> 
                    
                </span> <br>

                <span>Blame &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="checkbox"  name="" id=""> 
                    
                </span> 

            @endif


      
               
            </div>
            <div class="teacher">
                <span>Nom et Signature du Professeur Titulaire</span><br><br><br><br><br><br>
                <h5> {{$classTeacher['user']['name']}} </h5>
    
            </div>
        </div>
       
        <div class="remark">
            <h6> Fait à Lomé, le  {{ date("d-m-Y") }}  </h6><br>
            <h6> {{$responsible== null? '': $responsible->title  }} </h6> <br><br><br><br><br>
            <h6>  <strong> {{$responsible== null? '': $responsible->name}} </strong></h6>
        </div>

    </div>


    <div class="note">
        @php
             switch ( intval($marks_avg->final_avg) ) {
                    case 4:
                    case 5:
                        $decision = 'Travail faible';
                        break;

                    case 6:
                    case 7:
                        $decision = 'Travail très insuffisant';
                        break;

                    case 8:
                    case 9:
                        $decision = 'Insuffisant. Doit mieux faire';
                        break;

                    case 10:
                    case 11:
                        $decision = 'Passable. Peut mieux faire';
                        break;
                     
                    case 12:
                    case 13:
                        $decision = 'Travail assez bien';
                        break;

                    case 14:
                    case 15:
                        $decision = 'Bon travail';
                        break;
                     
                    case 16:
                    case 17:
                        $decision = 'Très bien. Félicitation';
                        break;

                    case 18:
                    case 19:
                    case 20:
                        $decision = 'Excellent. Félicitation';
                        break;
                     
                     default:
                        $decision = 'Travail faible';
                         break;
                 }

                $yearDecision;
        @endphp
        <h6>APPRECIATION ET DECISION DU CONSEIL DE CLASSE</h6>
        @if ($marks['0']['season']['id'] != 3)
                <h5 style=""> {{$decision}}  </h5>
        @else
                <h5 style=""> 
                    {{ intval($annual_avg->annual_avg) >= $classTeacher->pass_mark ? 'Admis': 
                    'Redouble la '.$marks['0']['student_class']['name']}} </h5>
        @endif
       
        
    </div>

    <div class="warning" >
        <h6>NB: IL N'EST DELIVRE QU'UN SEUL BULLETIN</h6>
    </div>





    
<footer>
    {{-- <h6 style="font-size: 9px; font-weight: lighter; text-align:center">document généré par Beam >_ 00228 91 38 61 20</h6> --}}
</footer>

</body>

</html>
@endforeach
