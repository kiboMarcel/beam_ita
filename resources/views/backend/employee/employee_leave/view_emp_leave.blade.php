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
                            <h3>Liste de Permissions </h3>
                            <a href=" {{ route('leave.add') }} " class="btn btn-outline-secondary mb-2">Ajouter </a>
                        </div>


                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                    <th> name</th>
                                    <th> id no</th>
                                    <th> raison</th>
                                    <th> date debut</th>
                                    <th> date fin</th>
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $leave)
                                    <tr class="tr_style">


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $leave['user']['name'] }} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $leave['user']['id_no'] }} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $leave['purpose']['name'] }} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">
                                                    {{  date('d-m-Y', strtotime( $leave->start_date) ) }} </p>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> 
                                                    {{  date('d-m-Y', strtotime( $leave->end_date) ) }}  </p>
                                            </div>
                                        </td>



                                        <td class="text-center">
                                            <a href=" {{ route('employee.leave.edit', $leave->id) }} "
                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-3">
                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href=" {{ route('employee.leave.delete', $leave->id) }} " id="delete"
                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" color="red" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div  class="paginating-container pagination-default">

                            {!! $allData->appends(request()->query())->links('vendor.pagination.custom') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
