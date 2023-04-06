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
                            <h3>Salaire Employer</h3>
                           
                        </div>


                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                    <th> Nom</th>
                                    <th> N ID </th>
                                    <th> Mobile</th>
                                    <th> Designation</th>

                                    <th> Salaire</th>
                                    <th> Debut de service</th>
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $salary)
                                    <tr class="tr_style">


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->name }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->id_no }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary->mobile }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $salary['designation']['name'] }} </p>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ number_format($salary->salary, 0, ',', ' ') }} cfa</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">
                                                    {{ date('d-m-Y', strtotime($salary->join_date)) }} </p>
                                            </div>
                                        </td>




                                        <td class="text-center">
                                            <a href=" {{ route('employee.salary.increment', $salary->id) }} "
                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="retirer/augmenter salaire">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-plus-square">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a  href=" {{ route('employee.salary.detail', $salary->id) }} "
                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" color="#185ADB" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-file-text">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                    </path>
                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                                    <polyline points="10 9 9 9 8 9"></polyline>
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
