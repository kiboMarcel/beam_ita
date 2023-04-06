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
    
    .d-flex{
        justify-content: center;
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
        <div class="col-lg-6">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Classe Attribuée - Detail</h3>
                            
                        </div>


                        <table id="style-2" class="table  table-bordered  table-hover">
                            <h4 class="badge badge-pills badge-info"> <strong >Classe:  
                                </strong> {{$detailData['0']['student_class']['name']}} 
                                
                            </h4> <br>
                            <span>Moy. d'admission : <strong> {{$detailData['0']->pass_mark}} </strong> </span>
                            <thead>
                                <tr class="thead_tr">
                                  
                                    <th  style=" width:30% "> Série </th>
                                    <th class="text-center">Groupe</th>
                                    <th class="text-center">Professeur Titulaire</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailData as $key => $detail)
                                    <tr class="tr_style">
                                       


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">  <strong>  {{ $detail['student_branch']['name'] }} </strong> </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0  text-center"> <strong> {{ $detail['student_group']['name'] }} </strong> </p>
                                            </div>
                                        </td>

                                      
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0  text-center"> <strong> {{ $detail['user']['name'] }} </strong> </p>
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
