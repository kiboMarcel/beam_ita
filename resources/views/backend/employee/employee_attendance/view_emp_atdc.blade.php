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

                        {{-- GET STATUS FOR SWEET ALERT  START--}}
                            @php
                            $getStatus = \Session::has('create');
                            $getStatus1 = \Session::has('update');
                            //dd($getStatus);
                            @endphp
                        {{-- GET STATUS FOR SWEET ALERT START --}}

                            <h3>Présence Employer</h3>
                            <a href=" {{ route('attendance.add') }} " class="btn btn-outline-secondary mb-2">Ajouter </a>
                        </div>


                        <table id="style-2" class="table style-2  table-hover">
                            <thead>
                                <tr class="thead_tr">
                                    <th> Date</th>
                                  
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $value)
                                    <tr class="tr_style">


                                   
                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 ">{{ date( 'd-m-Y' , strtotime( $value->date  ) ) }} </p>
                                            </div>
                                        </td>


                                      


                                        <td class="text-center">
                                            <a href=" {{route('attendance.edit', $value->date)}} "
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
                                            <a href=" {{route('attendance.detail', $value->date)}}"
                                                id="detail" class="bs-tooltip" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="detail">
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
                       
                    </div>
                   
                    <div  class="paginating-container pagination-default">
                        {!! $allData->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

     {{-- SWEET ALERT SCRIPT --}}
     <script> 
        window.addEventListener('load', function() {
            var isOK = <?php echo json_encode($getStatus); ?>;
            var isUpdate = <?php echo json_encode($getStatus1); ?>;
            var isOk
            if (isOK) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    /* type: 'success', */
                    title: 'Ajouter avec Succès',
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
