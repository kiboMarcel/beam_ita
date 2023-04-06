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
                            <h3>Details</h3>
                            <a href=" " class="btn btn-outline-secondary mb-2">Ajouter</a>
                        </div>


                        <table id="style-2" class="table style-2  table-hover">
                            <h4><strong>Tranche classe:</strong>  {{$detailData['0']['student_class']['name']}} </h4>
                            <thead>
                                <tr class="thead_tr">
                                    <th class="text-center"> Tranche </th>
                                    <th class="text-center"> Tranche </th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($detailData as $key => $detail)
                                    <tr class="tr_style">

                                        <td > Tranche {{ $key + 1 }} </td>

                                        <td class="text-center">
                                            <p class="align-self-center mb-0 "> {{ $detail->slice_amount}}
                                            </p>
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
