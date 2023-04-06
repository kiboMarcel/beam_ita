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
                            <h3>Presence Employer Detail</h3>
                           </div>
                           <div style=" width:25%" >
                            <hr>
                           </div>
                          

                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                    <th> # </th>
                                    <th> Nom</th>
                                    <th> id no</th>
                                    <th> Date</th>
                                    <th> Status</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $key => $value)
                                    <tr class="tr_style">
                                        <td> {{ $key + 1 }} </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $value['user']['name']}} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $value['user']['id_no']}} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">{{ date( 'd-m-Y' , strtotime( $value->date  ) ) }} </p>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{$value->attend_status}} </p>
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
