<!DOCTYPE html>
<html>

@php
 $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id','2')
            ->where('class_id',$details->class_id)->first();
    $originalfee = $registrationfee->amount;
@endphp


<head>
    <style>
        body {
            font-family: sans-serif;
        }

        body h2 {
            text-align: center;
        }

        .header p {
            margin: 4px, 0px;
        }

        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 70px;

        }

        .text {
            float: left;
            width: 40%;
        }

        .logo {
            float: right;
            width: 15%;
        }

        img {
            width: 100px;
        }

      
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .student-data {
            text-align: center;
        }

     

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

    </style>


</head>

<body>

    <div class="header">
        <div class="text">
            <h3> {{$school_info== null? '': $school_info->name }} </h3>
        <p>Adresse: {{$school_info== null? '': $school_info->Address  }} 
             {{$school_info== null? '': $school_info->district}}</p>
        <p>Téléphone:  {{$school_info == null? '': $school_info->num}} </p>
        
            <p>Année: {{$student['student_year']['name']}}</p>

        </div>

        <div class="logo">
            <img src=" {{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image)
                : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>
    </div>


    <h2>Information </h2>
    <table class="styled-table" id="customers">
        <thead>
            <tr>
                <th style="width: 300px"><strong>Detail</strong></th>
                <th style="width: 300px"><strong>Elève</strong></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h4>nom</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['student']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Matricule</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['student']['id_no'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Classe</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['student_class']['name'] }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Filere</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['student_branch']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>groupe</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $details['student_group']['name'] }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>sexe</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details['student']['gender']  }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Frais inscription</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $originalfee }} Fcfa</strong>
                </td>
            </tr>
         
          
         

        </tbody>
    </table>

</body>

</html>
