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
                      {{-- GET STATUS FOR SWEET ALERT  START --}}
                        @php
                            $getstatus = \Session::has('success');
                            $getUpdateStatus = \Session::has('successUpdate');
                            
                        @endphp
                        {{-- GET STATUS FOR SWEET ALERT START --}}
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Employés ( {{$count}} ) </h3>
                            <a href=" {{ route('employee.add') }} " class="btn btn-outline-secondary mb-2">Ajouter</a>
                        </div>

                       
                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                   
                                    <th> Nom</th>
                                    <th> N ID </th>
                                    <th> Mobile</th>
                                    <th> Designation</th>

                                    <th> Contrat</th>

                                    @if (Auth::user()->role == 'Admin')
                                    <th> Salaire</th>
                                    @endif

                                    <th> Debut de service</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $employee)
                                    <tr class="tr_style">
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $employee->name }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $employee->id_no }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $employee->mobile }} </p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $employee['designation']['name'] }} </p>
                                            </div>
                                        </td>

                                        @if (Auth::user()->role == 'Admin')
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $employee->contrat }} </p>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ number_format($employee->salary, 0, ',', ' ') }} cfa</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">
                                                    {{ date('d-m-Y', strtotime($employee->join_date)) }} </p>
                                            </div>
                                        </td>




                                        <td class="text-center">
                                            <a href=" {{ route('employee.edit', $employee->id) }} " class="bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title=""
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
                                            <a target="blank" href=" {{ route('employee.detail.pdf', $employee->id) }} "
                                                class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Detail/Pdf">
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

     {{-- SWEET ALERT SCRIPT --}}
     <script>
        window.addEventListener('load', function() {
            var isCreate = <?php echo json_encode($getstatus); ?>;
            var isUpdate = <?php echo json_encode($getUpdateStatus); ?>;

            if (isCreate) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                   /*  type: 'success', */
                    title: 'Créer avec succès',
                    padding: '2em',
                })
            }
            if (isUpdate) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    /* type: 'success', */
                    title: 'Modifier avec Succès',
                    padding: '2em',
                })
            }


        });
    </script>
@endsection
