<!DOCTYPE html>
<html>

<head>
    <style>
        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 50px;

        }

        .text-div {
            float: right;
        }

        .text-div h1 {
            text-align: center;
            margin-bottom: 0;
        }

        .text-div h5 {
            text-align: center;
            font-weight: lighter;
            font-size: 12px;
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
            width: 15%;
        }

        body {
            font-family: sans-serif;
        }

        body h2,
        h3 {
            text-align: center;
        }

        body h3 {
            font-weight: lighter;
            margin-bottom: 5px;
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

        .observation_td {
            font-size: 12px;
        }


        

        .habit{
            float: left;
            width: 15%;
        }

        .rank  {
            float: right;
            margin-top: 12px;
            margin-left: 500px;
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

        .final-avg strong{
        }

    </style>

</head>

<body>

    <div class="header">
        <div class="logo">
            <img src=" {{ 
                    (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpg')
                    : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>

        <div class="logo-right">
            <img src=" {{ 
                    (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image.'jpg')
                    : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>

        <div class="text-div">
            <h1>College Moderne Kibo</h1>
            <h5>Adresse: bo 42 - Téléphone: 75 64 78 96 - Email: nouletamemarcel@gmail.com</h5>
            <h5><strong>Prier-Travailler-Reussir</strong></h5>


        </div>

    </div>


    <h2>BULLETIN D'EVALUATION </h2>
    <h3 class="eleve" > ELEVE: <strong> {{ $marks['0']['student']['name'] }}</strong> </h3>
    <hr>
    <h4>
        Année-Scolaire: <strong> {{ $marks['0']['student_year']['name'] }}</strong> -
        Trimestre: <strong> {{ $marks['0']['season']['name'] }}</strong> -

        Classe: <strong> {{ $marks['0']['student_class']['name'] }}</strong>
        <strong> {{ $marks['0']['student_branch']['name'] }}</strong>
        <strong> {{ $marks['0']['student_group']['name'] }}</strong> - 

        Effectif: <strong> {{ $totalStudent }}  </strong>
        
    </h4>


    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 15%;" rowspan="2" class="td-text">Matières</td>
                <td style="width: 15%;" colspan="4" class="td-text">Note</td>
                <td style="width: 6%;" rowspan="2" class="td-text">M. Cla sur 20</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Compo sur 20</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Moy. sur 20</td>
                <td style="width: 3%;" rowspan="2" class="td-text">Coef</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Notes Def</td>
                <td style="width: 6%;" rowspan="2" class="td-text">Rangs</td>
                <td style="width: 15%;" rowspan="2" class="td-text">Nom des Professeurs</td>
                <td style="width: 15%;" rowspan="2" class="td-text">Observation</td>
                <td style="width: 7%;" rowspan="2" class="td-text">Signature</td>
            </tr>

            <tr>
                <td class="td-text" colspan="4">Divers Devoirs</td>
            </tr>

            @foreach ($subjects as $subject)

                @php
                    $marksBysubjectDevoir = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '1')
                        ->where('student_id', $marks[0]->student_id)
                        ->where('season_id', $marks[0]->season_id)
                        ->where('year_id', $marks[0]->year_id)
                        ->get();
                    
                    $marksByDevoirAVG = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '1')
                        ->where('student_id', $marks[0]->student_id)
                        ->where('season_id', $marks[0]->season_id)
                        ->where('year_id', $marks[0]->year_id)
                        ->avg('marks');
                    
                    $marksBysubjectExam = App\Models\StudentMarks::where('assign_subject_id', $subject->id)
                        ->where('exam_type_id', '2')
                        ->where('student_id', $marks[0]->student_id)
                        ->where('season_id', $marks[0]->season_id)
                        ->where('year_id', $marks[0]->year_id)
                        ->first();
                    
                    //dd($marksByDevoirAVG);
                    
                @endphp

                {{-- SUBJECT NAME --}}
                <tr>
                    <td> {{ $subject['school_subject']['name'] }}</td>
                </tr>

                {{-- DEVOIR MARKS START --}}
                @php
                    $devoirmark_count = count($marksBysubjectDevoir);
                @endphp

                @foreach ($marksBysubjectDevoir as $Devoirmark)

                    <td style="width: 3.75%;" class="td-text"> {{ $Devoirmark->marks }}</td>

                @endforeach
                @if ($devoirmark_count == 0)
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>

                @endif
                @if ($devoirmark_count == 1)
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>

                @endif
                @if ($devoirmark_count == 2)
                    <td style="width: 3.75%;" class="td-text"></td>
                    <td style="width: 3.75%;" class="td-text"></td>

                @endif
                @if ($devoirmark_count == 3)
                    <td style="width: 3.75%;" class="td-text"></td>
                @endif
                {{-- DEVOIR MARKS END --}}

                {{-- DEVOIR AVG START --}}
                <td style="width: 3.75%;" class="td-text">{{ round($marksByDevoirAVG, 2) }}</td>
                {{-- DEVOIR AVG END --}}

                {{-- EXAM MARKS START --}}
                @if ($marksBysubjectExam == null)
                    <td style="width: 3.75%;" class="td-text"> 0 </td>
                @else

                    <td style="width: 3.75%;" class="td-text"> {{ $marksBysubjectExam->marks }}</td>
                @endif
                {{-- EXAM MARKS END --}}

                {{-- TOTAL AVERAGE EXAM + DEVOIR AVERAGE START --}}
                @php
                    if ($marksBysubjectExam == null) {
                        $totalAVG = $marksByDevoirAVG / 2;
                    } else {
                        $totalAVG = ($marksBysubjectExam->marks + $marksByDevoirAVG) / 2;
                    }
                    
                @endphp

                <td style="width: 3.75%;" class="td-text"> {{ round($totalAVG, 2) }}</td>
                {{-- TOTAL AVERAGE EXAM + DEVOIR AVERAGE END --}}

                {{-- SUBJECT COEF START --}}
                <td class="td-text"> {{ $subject->coef }}</td>
                {{-- SUBJECT COEF END --}}
                

                {{-- NOTE DEFINITIF/ FINAL MARK START --}}
                @php
                    $finalMark = $totalAVG * $subject->coef;
                    
                    
                    $getfinal_marks = App\Models\Student_final_mark::where('student_id', $marks['0']->student_id)
                        ->where('year_id', $marks['0']->year_id)
                        ->where('season_id', $marks['0']->season_id)
                        ->where('assign_subject_id', $subject->id)
                        ->first();
             
                    
                @endphp
                <td class="td-text"> {{ $getfinal_marks->final_marks }}</td>
                {{-- NOTE DEFINITIF/ FINAL MARK END --}}


                {{-- POSITION MARK START --}}
                @php
                    
                    DB::statement(DB::raw('set @rank:=0'));
                    
                    $rank = App\Models\Student_final_mark::selectRaw('*, @rank:=@rank+1 as rank')
                        ->where('assign_subject_id', $subject->id)
                        ->where('season_id', $marks['0']->season_id)
                        ->orderBy('final_marks', 'DESC')
                        ->get();
                    
                    for ($i = 0; $i < count($rank->toArray()); $i++) {
                        if ($rank[$i]->student_id == $marks['0']->student_id) {
                            $subjectrank = $rank[$i]->rank;
                        }
                    }
                @endphp

                <td class="td-text"> {{ $subjectrank }}e</td>

                {{-- POSITION MARK END --}}

                {{-- SUGJFECT TEACHER  START --}}
                <td> {{ $subject['user']['name'] }} </td>
                {{-- SUGJFECT TEACHER END --}}


                {{-- SUBJECTIVE REMARKS START --}}
                <td class="observation_td">passable. peut mieut faire</td>
                {{-- SUBJECTIVE REMARKS END --}}

                {{-- SIGNATURE START --}}
                <td class="observation_td"></td>
                {{-- SIGNATURE END --}}


            @endforeach

            <tr class="border_style">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="td-text" colspan="2">TOTAL</td>
                <td class="td-text"> {{ $coefSum }} </td>
                <td class="td-text"> {{ $seasonAvg }} </td>
                {{-- <td class="td-text"> {{ $marks_avg->final_avg }} </td> --}}
                

            </tr>


     
        </tbody>


    </table>

    <div>
        <div class="habit">
            <span> Retards: {{$student_attendance->retard}} </span><br>
            <span>Abscences: {{$student_attendance->absence}}  </span><br>
            <span>Punitions: {{$student_attendance->punition}}</span><br>
        </div>

        <div class="rank">
            <span>  Moyenne la plus forte de la classe / 20: <strong>{{ $marks_avg_max}}</strong>  </span> <br>
            <span>  Moyenne la plus failbe de la classe / 20: <strong>  {{ $marks_avg_min}}</strong> </span> <br>
            <span>  Moyenne generale de la classe / 20: <strong>{{ $class_avg}}</strong> </span>
        </div>

        <div class="season-avg">
            <span> <strong> Moyenne Generale du Trimestre</strong>  </span>
            <span >  <strong> {{ $marks_avg->final_avg }}  </strong>  </span> <br>    
            <span >  Rang   </span>
            <span > <strong>{{ $student_rank }} </strong > sur  <strong> {{ $totalStudent }}  </strong>  Eleves classés </span>
                
        </div>
      
    </div>
    <hr>
    <div>
        <div class="habit">
          
            <span></span><br>
        </div>

        <div class="rank">
           
            <span> <strong>Observations générales du Conseil de Classe</strong>  </span>
        </div>

        <div class="season-avg">
            <span> Le Directeur </span>
        </div>
      
    </div>





</body>

</html>
