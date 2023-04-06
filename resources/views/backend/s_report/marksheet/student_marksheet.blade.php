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
            border: 2px solid black;
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
		
		
		.appC h6{
            font-size: 11px;
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

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image)
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
        $end = $marks['0']['season']['id']== 1 ? 'er': 'eme'
    @endphp

    <div class="season_div">
       {{--  <span class="season_name"> BULLETIN DE NOTE DU <strong> {{ $marks['0']['season']['name'] }}</strong>
            {{$end}} Trimestre   <strong> {{ $marks['0']['student_year']['name'] }}</strong> </span> --}}
        <h2> BULLETIN DE NOTE DU  {{ $marks['0']['season']['name'] }}{{$end}}
             Semestre   {{ $marks['0']['student_year']['name'] }} </h2>
    </div>

    <div class="">
     
        <div class="detail">
            <h5>  Nom Prénom(s):
                 <strong>  {{ $marks['0']['student']['name'] }}  </strong>   
            </h5>

            <table style="width: 100%;">
                <tbody>
                    <tr>
                        
                        <td style="width: 10%;"  class="td-text">Sexe</td>
                        <td style="width: 10%;"  class="td-text">Classe</td>
                        <td style="width: 15%;"  class="td-text">Effectif</td>
                    </tr>

                    <tr>
                       
                        
                        <td style="width: 10%;"  class="td-text"> {{ $marks['0']['student']['gender'] }}</td>
                       
                        <td style="width: 20%;"  class="td-text">{{$marks['0']['student_class']['name'] }} 
                            {{ $marks['0']['student_branch']['name'] }}  </td>
                       
                        <td style="width: 15%;"  class="td-text">  {{ $totalStudent }} </td>
                    </tr>
                   
                 
                </tbody>
            </table> 

        </div>
      
     {{--    <div class="location">
           <h6> Lieu : <strong>{{$school_info== null? '': $school_info->district}} </strong> </h6>
          
        </div> --}}

      

       
       
    </div>

   
   {{--  <h4>
        Effectif: <strong> {{ $totalStudent }}  </strong> 
    </h4>
 --}}

    <table style="width: 100%; font-size: 17px;">
        <tbody>
            <tr>
                <td style="width: 25%;" rowspan="2" class="td-text">Matières </td>
                <td style="width: 20%;" colspan="4" class="td-text"> Note sur 20</td>
                <td style="width: 25%;" rowspan="2" class="td-text"> Coef </td>
                <td style="width: 15%;" rowspan="2" class="td-text">Moy </td>
                <td style="width: 5%;"  rowspan="2" class="td-text">Rangs </td>
                <td style="width: 15%;" rowspan="2" class="td-text">Observation</td>
                <td style="width: 15%;" rowspan="2"  class="td-text">Nom des Professeurs</td>
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
                     ->where('season_id', $marks['0']->season_id)
                     ->orderBy('final_marks', 'DESC')
                     ->get();
                

              
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


               {{-- SUGJFECT TEACHER  START --}}
               <td style="width: 8%;"> {{ $subject['user']['name'] }} </td>
               {{-- SUGJFECT TEACHER END --}}


             

             



        @endforeach

           <tr class="border_style">
                <td colspan="4" > &emsp;&emsp;&emsp;Total des notes coefficiées:</td>
                {{-- <td class="td-text"> {{ $marks_avg->final_avg }} </td> --}}
                <td>  </td>
                <td colspan="2"> <strong>  {{ round($seasonAvg, 1) }}</strong> </td>
                <td colspan="3"> Moyenne semestrielle: <strong>  
                    {{ $marks_avg->final_avg }} </strong> sur 20 
                </td>
            </tr>


            @php
                if( $student_rank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                    $ranking = 'ere';
                }elseif ( $student_rank == 1 ) {
                    $ranking = 'er';
                }else{
                    $ranking = 'eme';
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

    {{-- <div >
        <div class="habit">
            <span> Retards: {{ $student_attendance== null? '' : $student_attendance->retard}} </span><br>
            <span>Abscences: {{$student_attendance== null? '': $student_attendance->absence}}  </span><br>
            <span>Punitions: {{$student_attendance== null? '' : $student_attendance->punition}}</span><br>
        </div> --}}

     {{--    <div class="rank">
            <span>  Moyenne la plus forte de la classe / 20: <strong>{{ $marks_avg_max}}</strong>  </span> <br>
            <span>  Moyenne la plus failbe de la classe / 20: <strong>  {{ $marks_avg_min}}</strong> </span> <br>
            <span>  Moyenne generale de la classe / 20: <strong>{{ $class_avg}}</strong> </span>
        </div>

        <div class="season-avg">
            <span> <strong> Moyenne Generale du Trimestre</strong>  </span>
            <span >  <strong> {{ $marks_avg->final_avg }}  </strong>  </span> <br>    
            <span >  Rang   </span>
            <span > <strong>{{ $student_rank }} </strong > sur  <strong> {{ $totalStudent }}  </strong>  Eleves classés </span>
                
        </div> --}}
   
   {{--  <div>
        <div class="habit">
          
            <span></span><br>
        </div>

        <div class="rank">
           
            <span> <strong>Observations générales du Conseil de Classe</strong>  </span>
        </div>

        <div class="season-avg">
            <span> Le Directeur </span>
        </div>
     
    </div> --}}
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
                        <td style="width: 25%;" class="td-text">1er Sem</td>
                        <td style="width: 25%;" class="td-text">2er Sem</td>
                        <td style="width: 35%;" class="td-text">Moy. Annuelle</td>
                       
                    </tr>
                    @php
                    if ($avg1 !=null) {
                        if(  ($avg1->rank == 1) && ($marks['0']['student']['gender'] == 'Feminin')){
                            $rank1 = 'ere';
                        }elseif ( $avg1->rank == 1 ) {
                            $rank1 = 'er';
                        }else{
                            $rank1 = 'eme';
                        }
                    }

                    if ($avg2 !=null) {
                        if( $avg2->rank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $rank2 = 'ere';
                        }elseif ( $avg2->rank == 1 ) {
                            $rank2 = 'er';
                        }else{
                            $rank2 = 'eme';
                        }
                    }

                  
                        if ($season_id== 2 ) {
                            if( $annualRank == 1 && $marks['0']['student']['gender'] == 'Feminin'){
                            $annualrank = 'ere';
                        }elseif ( $annualRank == 1 ) {
                            $annualrank = 'er';
                        }else{
                            $annualrank = 'eme';
                        }
                        }

                      
                        
                    @endphp
                    <tr>
                        <td class="td-text" >Moy. géné.</td>

                        <td class="td-text"> <strong> {{ $avg1==null? '': $avg1->final_avg }} </strong> </td>
                        
                       {{--  <td class="td-text"> <strong  class=" {{ ( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}"> 
                            {{ $avg2==null? '': $avg2->final_avg }} </strong> 
                        </td> --}}

                        <td class="td-text "> <strong class=" {{ $season_id == 2 ? '': 'hide-avg'  }}"> 
                            {{ $avg2==null? '': $avg2->final_avg }} </strong>
                         </td>

                        <td class="td-text" >  <strong> {{ $season_id==2 ? $annual_avg->annual_avg: '' }} </strong>  </td>
                    </tr>

                    <tr>
                        <td class="td-text">Rang</td>

                        <td class="td-text"> <strong>{{ $avg1==null? '': $avg1->rank }}  {{$rank1}} </strong></td>

                        <td class="td-text"> <strong class=" {{( $season_id ==2 xor $season_id ==3) ? '': 'hide-avg'  }}">
                             {{ $avg2 ==null? '': $avg2->rank }} {{ $avg2 ==null? '': $rank2}} </strong>
                        </td>

                        {{-- <td class="td-text"> <strong  class=" {{ $season_id ==2 ? '': 'hide-avg'  }}"> 
                            {{ $avg2 ==null? '': $avg2->rank }}  {{  $avg2 ==null? '': $rank3}}</strong>
                        </td> --}}

                        <td class="td-text">  <strong>{{  $season_id==2 ? $annualRank: ''  }} {{  $season_id==2 ? $annualrank: ''  }} 
                        </strong> </td>
                    </tr>
                 
                </tbody>
            </table>
        </div>
      
        <div class="marks">
            <span>  Moyenne la plus élevée de la classe:  &nbsp;<strong>{{round($marks_avg_max, 2) }}</strong>  </span> <br>
            <span>  Moyenne la plus failbe de la classe:  &nbsp;&nbsp; <strong>  {{round($marks_avg_min, 2) }}</strong> </span> <br>
            <span>  Moyenne générale de la classe:  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;<strong>{{ round($class_avg, 2) }}</strong> </span>
        </div>

    </div>

   {{--  <div style="float: left; width:100%; border: 1px solid;">
        <div style="float: left; width:25%">
            <span>Retard &ensp;&ensp;&nbsp;&nbsp; <strong> {{$student_attendance== null? '0' : $student_attendance->retard}} </strong> fois 
            </span> <br>
            <span>Absence&ensp; &nbsp;<strong> {{$student_attendance== null? '0' : $student_attendance->absences}} </strong> heure(s) 
            </span> <br>
            <span>Punitions &nbsp;<strong> {{$student_attendance== null? '0' : $student_attendance->punition}} </strong>  
            </span>
            <hr>
            <span>Felicitation &emsp;&emsp;&emsp; &emsp;&emsp;<input type="checkbox" checked="checked" name="" id=""> 
                  
            </span> 
            
            <span>Encouragement &emsp;&nbsp;&nbsp; &ensp;&ensp;<input type="checkbox" checked="checked" name="" id=""> 
                  
            </span> 
            <span>Tableau d'honneur &nbsp;&nbsp; &nbsp;&nbsp;<input type="checkbox" checked="checked" name="" id=""> 
                  
            </span> 
    
            <span>Avertissement &emsp;&emsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" name="" id=""> 
                  
            </span> <br>
    
            <span>Blame &emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" checked="checked" name="" id=""> 
                  
            </span> 
    
        </div>

        <div style="float: left; width:25%">
            <span>Nom et Signature du Professeur Titulaire</span>
            
        </div>
    </div>
    
    <div style="float: right; width:35%">
        <span> Fait à Lomé, le  {{ date("d-m-Y") }} </span>
    </div>
 --}}







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
                <h5> <strong>{{$classTeacher['user']['name']}}</strong> </h5>
    
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
        <h6 class="appC" > APPRECIATION ET DECISION DU CONSEIL DE CLASSE</h6>
        @if ($marks['0']['season']['id'] != 2)
                <h5 style="font-size: 13px; "> {{$decision}}  </h5>
        @else
           
            @if ($examDecision != null)
                <h5 style=" font-size: 12px; "> 
                    {{ $examDecision}} 
                </h5>
            @else
                <h5 style=" font-size: 12px; "> 
                    {{ intval($annual_avg->annual_avg) >= $classTeacher->pass_mark ? 'Passe en classe supérieure': 
                    'Redouble la '.$marks['0']['student_class']['name']}} 
                </h5>
            @endif
        @endif
       
        
    </div>

    <div class="warning" >
        <h6>NB: IL N'EST DELIVRE QU'UN SEUL BULLETIN</h6>
    </div>









    {{-- <div class="">
        
        <div class="attendance">
            <h5>Retard: &nbsp; <strong> {{$student_attendance== null? '0' : $student_attendance->retard}} </strong> fois </h5>
            <h5>Absence:<strong> {{$student_attendance== null? '0' : $student_attendance->absences}} </strong> heure(s) </h5>
            <h5>Punitions: <strong> {{$student_attendance== null? '0' : $student_attendance->punition}} </strong>  </h5>
            <h5>Felicitation: <input type="checkbox" checked="checked" name="" id=""> </h5>
            <h5>Encouragement: <input type="checkbox" checked="checked" name="" id=""> </h5>
            <h5>Tableau d'honneur: <input type="checkbox" checked="checked" name="" id=""> </h5>
            <h5>Avertisement:<input type="checkbox" checked="checked" name="" id=""> </h5>
            <h5>Blame: <input type="checkbox" checked="checked" name="" id=""> </h5>
        </div>

       
        <div class="remark">
           <h6> Décision du conseil </h6>
           <h6> ..................................... </h6>
           <h6> .................................... </h6>
           <h6> Fait à Lomé, le  {{ date("d-m-Y") }}  </h6>
           <h6> Le Directeur General  </h6>
          
        </div>

       

       
    </div> --}}
    
<footer>
<h6 style="font-size: 85px; font-weight: bold; text-align:center"> Le bon sens a de l'avenir.</h6> 
	 
     <h6 style="font-size: 85px; font-weight: bold; text-align:center"> 80 rue TOTSI av. de pya
	 , à côté d'ECOBANK Totsi, face Pharmacie Nation 01 BP 1514 Lomé</h6> 
</footer>

</body>


</html>
