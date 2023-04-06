@extends('admin.admin_master')

<style>
    .tr_style {
        background-color: #0e1726 !important;
    }

    .table {
        background-color: rebeccapurple !important;
    }

    .tr_style:hover {
        background-color: #152238 !important;
    }

    .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }


    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a {
        margin: 0 9px;
    }

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Detail salaire</h3>  <br>
                             </div>
                             <h6> <strong>Employer :</strong> {{ $detail->name }} </h6>
                             <h6> <strong>Id :</strong> {{ $detail->id_no }} </h6>
                             <hr>
                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                    <th> N </th>
                                    <th> Salaire précédent</th>
                                    <th> Ajout  </th>
                                    <th> Salaire présent</th>
                                    <th> Date d'attribution</th>

                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salary_log as $key => $salary)
                                    <tr class="tr_style">
                                        <td> {{ $key + 1 }} </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->previous_salary }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->present_salary }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->increment_salary }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ date('d-m-Y', strtotime($salary->effected_salary)) }} </p>
                                            </div>
                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
