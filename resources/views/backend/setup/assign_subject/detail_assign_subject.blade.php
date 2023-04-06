@extends('admin.admin_master')

<style>
    .tr_style{
        background-color: #0e1726 !important;
    }
    .table {
        background-color: rgb(153, 51, 114) !important;
    }

    .badge{
        font-size: 15px !important;
    }

    .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    }

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a{
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
                            <h3>Matières Attribuées</h3>
                            <a href=" {{route('assign.subject.add') }} " class="btn btn-outline-secondary">Ajouter</a>
                        </div>


                        <table id="style-2" class="table  table-bordered  table-hover">
                            <h4 class="badge badge-pills badge-info"> <strong >Classe:  </strong> {{$detailData['0']['student_class']['name']}} 
                                {{$detailData['0']['student_branch']['name']}}
                            </h4>
                            <thead>
                                <tr class="thead_tr">
                                    <th> # </th>
                                    <th style=" width:30% "> Matiere </th>
                                    <th class="text-center">Note Totale</th>
                                    <th class="text-center" style=" width:10% " >Coefficient</th>
                                    <th class="text-center">Professeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailData as $key => $detail)
                                    <tr class="tr_style">
                                        <td> {{ $key + 1 }} </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $detail['school_subject']['name'] }} </p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            
                                                <p class="align-self-center mb-0 "> {{ $detail->full_mark}} </p>
                                            
                                        </td>
                                        <td class="text-center">
                                            
                                            <p class="align-self-center mb-0 "> {{ $detail->coef}} </p>
                                        
                                    </td>
                                        <td class="text-center">
                                            
                                                <p class="align-self-center mb-0 "> {{ $detail['user']['name'] }} </p>
                                            
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
