<!DOCTYPE html>
<html>

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


    <h2>Landscape </h2>
    <h3>{{$allData[0]->student_class->name}} : {{$allData[0]->student_branch->name}} <span>
        {{$allData[0]->student_group->name}}</span> </h3>

    <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
            <tr>
                <td style="width: 50%; text-align: center;">Nom Prenom</td>
                <td style="width: 50.0975%; text-align: center;" colspan="7">Presence</td>
            </tr>
            @foreach ($allData as $item)
            <tr>
                <td style="width: 50%;"> {{ $item['student']['name'] }} </td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width: 6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
                <td style="width:  6.43274%;">&nbsp;</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>

</body>

</html>
