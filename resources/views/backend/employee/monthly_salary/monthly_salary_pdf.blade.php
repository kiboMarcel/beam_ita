<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
        }

        body h2 {
            text-align: center;
            margin-top: 2px;
        }

        .header p {
            margin: 4px, 0px;
        }

        .header {
            /*  display: flex;
            flex-direction: row;
            justify-content:  space-between;
            align-items: center; */
            margin-bottom: 40px;

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
@php
$date = date('Y-m', strtotime($details[0]->date));
 if($date != ''){
    $where[] =  ['date', 'like', $date.'%'];
}

$totalattend = App\Models\EmployeeAttendance::with(['user'])->where($where)
    ->where('employee_id',$details[0]->employee_id)->get();

$absentcount = count($totalattend->where('attend_status', 'absent'));
$presencecount = count($totalattend->where('attend_status', 'present'));
$salary = (float)$details[0]['user']['salary'];
//$salaryPerDay = $salary/30;
//$totalSalaryMinus = (float)$absentcount * (float)$salaryPerDay;
if ($details[0]['user']['contrat']== 'Vacataire') {
    $totalSalary = (float)$salary * (float)$presencecount;
    $round = round($totalSalary, 2);
}else {
    $round = round($salary, 2);
}



@endphp

<body>

  <div>
    <div class="header">
        <div class="text">
            <h3> {{$school_info== null? '': $school_info->name }} </h3>
            <p>Adresse: {{$school_info== null? '': $school_info->Address  }} 
                 {{$school_info== null? '': $school_info->district}}</p>
            <p>Téléphone:  {{$school_info == null? '': $school_info->num}} </p>

        </div>

        <div class="logo">
            <img src=" {{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image)
                : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>
    </div>


    <h2> Salaire du mois </h2>
    <table class="styled-table" id="customers">
        <thead>
            <tr>
                <th style="width: 300px"><strong>Detail</strong></th>
                <th style="width: 300px"><strong>Employé</strong></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h4>Nom Prénoms</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Contrat</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['contrat'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire de base</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ number_format($details[0]['user']['salary'], 0, ',', ' ')  }} cfa </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Présence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $presencecount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Absence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $absentcount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire du mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{number_format($round, 0, ',', ' ')}} cfa </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Mois du</h4>
                </td>
                <td class="student-data">
                    <strong> {{ date('m-Y', strtotime($date)) }} </strong>
                </td>
            </tr>
            
          

        </tbody>
    </table>

    <i style="font-size: 10px; float: right; margin-top: 10px">imprimé le: {{ date("d-m-Y") }} </i>

    <hr style="border: dashed 2px; width: 95%; color:#0000; margin: 20px 0" >

  </div>
    
  <div>
    <div class="header">
        <div class="text">
            <h3> {{$school_info== null? '': $school_info->name }} </h3>
            <p>Adresse: {{$school_info== null? '': $school_info->Address  }} 
                 {{$school_info== null? '': $school_info->district}}</p>
            <p>Téléphone:  {{$school_info == null? '': $school_info->num}} </p>

        </div>

        <div class="logo">
            <img src=" {{ 
                (!empty($school_info->image))? public_path('upload/school_image/'.$school_info->image)
                : public_path('upload/school_image/no_image.jpg') }}" alt="">
        </div>
    </div>


    <h2> Salaire du mois </h2>
    <table class="styled-table" id="customers">
        <thead>
            <tr>
                <th style="width: 300px"><strong>Detail</strong></th>
                <th style="width: 300px"><strong>Employé</strong></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h4>Nom Prénoms</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['name'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Contrat</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ $details[0]['user']['contrat'] }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire de base</h4>
                </td>
                <td class="student-data">
                    <strong>  {{ number_format($details[0]['user']['salary'], 0, ',', ' ')  }} cfa</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Présence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $presencecount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Absence Totale</h4>
                </td>
                <td class="student-data">
                    <strong> {{ $absentcount }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Salaire du mois</h4>
                </td>
                <td class="student-data">
                    <strong> {{number_format($round, 0, ',', ' ')}} cfa</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Mois du</h4>
                </td>
                <td class="student-data">
                    <strong> {{ date('m-Y', strtotime($date)) }} </strong>
                </td>
            </tr>
            
          

        </tbody>
    </table>

    <i style="font-size: 10px; float: right; margin-top: 10px">imprimé le: {{ date("d-m-Y") }} </i>

    

  </div>
    
</body>

</html>
