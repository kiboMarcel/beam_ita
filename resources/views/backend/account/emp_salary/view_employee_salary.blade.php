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

    .statbox {
        margin-top: 17px !important;
    }

    .find{
        margin-top: 25px;
    }

</style>

@section('admin')
    


    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Employé payé</h3>
                            <a href=" {{ route('account.salary.add') }} "
                                class="btn btn-outline-secondary mb-2 disabled" >Ajouter</a>
                        </div>

                    {{-- GET STATUS FOR SWEET ALERT  START--}}
                     @php
                     $getSuccess = \Session::has('success');
                     $getstatus =  \Session::has('error');  
                     @endphp
                     {{-- GET STATUS FOR SWEET ALERT START --}}

                        @if (!@search)
                           
                            {{-- search section data start --}}
                        @else
                            <table id="style-2" class="table  table-bordered  table-hover">
                                <thead>
                                    <tr class="thead_tr">
                                        <th> Nom</th>
                                        <th> id_no</th>
                                        <th>Montant</th>
                                        <th> Mois/Année</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $value)
                                        <tr class="tr_style">


                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['employee']['name'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['employee']['id_no'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ number_format( $value->amount, 0, ',', ' ') }} cfa </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ date('m-Y' , strtotime($value->date))  }} </p>
                                                </div>
                                            </td>
                                    

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <div  class="paginating-container pagination-default">

                                {!! $allData->appends(request()->query())->links('vendor.pagination.custom') !!}
                            </div>

                        @endif
                        {{-- search section data end --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

     {{-- SWEET ALERT SCRIPT --}}
     <script> 
        window.addEventListener('load', function() {
            var isOK = <?php echo json_encode($getSuccess); ?>;
            var isAbort = <?php echo json_encode($getstatus); ?>;
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
                    title: 'Ajouter avec Succès',
                    padding: '2em',
                })
            }
            if (isAbort) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'erreur',
                    padding: '2em',
                })
            }  


        });
    </script>
@endsection
