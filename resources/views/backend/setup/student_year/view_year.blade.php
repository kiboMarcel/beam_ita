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
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <div class="head">
                                <h3>Année Scolaire</h3>
                                <a href=" {{ route('student.year.add') }} " class="btn btn-outline-secondary mb-2">Ajouter</a>
                            </div>
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr class="thead_tr">
                                        <th> # </th>
                                        <th> Année</th>
                                        <th class="text-center" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $year)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td>

                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $year->name }}
                                                        {{ $year->active == 1 ? '(Ative)' : '' }} </p>
                                                </div>
                                            </td>

                                            <td>

                                                <a href=" {{ route('student.year.active', $year->id) }} " class="bs-tooltip 
                                                    {{ $year->active == 1 ? 'd-none' : '' }}" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="Activé">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-check-square">
                                                        <polyline points="9 11 12 14 22 4"></polyline>
                                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                <a href=" {{ route('student.year.edit', $year->id) }} " class="bs-tooltip"
                                                    data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Modifier">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                           {{--  <td>
                                                <a href=" {{ route('student.year.delete', $year->id) }} " id="delete"
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
                                            </td> --}}

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- SWEET ALERT SCRIPT --}}

@endsection
