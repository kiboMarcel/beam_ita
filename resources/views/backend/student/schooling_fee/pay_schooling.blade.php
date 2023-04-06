@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script src=" {{ asset('js/handlebars-v4.7.7.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>



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

   /*  .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    } */
    

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a {
        margin: 0 9px;
    }

    .find{
        margin-top: 25px;
    }

    .statbox {
        margin-top: 17px !important;
    }

    .row{
        align-items: flex-end;
    }

</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-9">
            <div class="statbox widget box box-shadow">
                {{-- GET STATUS FOR SWEET ALERT  START--}}
                @php
                $getstatus =  \Session::has('success'); 
                
                @endphp
                {{-- GET STATUS FOR SWEET ALERT START --}}
                <div class="widget-content widget-content-area">
                    <h3>Payer Scolarité </h3>
                    <h6>Elève: <strong>{{$student['student']['name']}} </strong> </h6>
                  

                    <hr>
                    <div class="head">
                        <form method="post" action="{{ route('schooling.store', $student->student_id) }}" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <label for="formGroupExampleInput">Montant à payer </label>
                                    <input  type="number" required id="schooling_fee" name="schooling_fee" class="form-control search-form-control " >
                            
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">

                                    <input type="submit" value="payer sans reçu" name="action" class="btn btn-secondary  search mb-2">
                                    <input type="submit" value="payer" id="without" name="action" class="btn btn-warning  search mb-2">
                                 
                                 
                                </div>
                            </div>
                        </form>
                       
                    </div>
                    
                </div>
            </div>
        </div>

    </div>


 {{-- SWEET ALERT SCRIPT --}}
 <script> 
    window.addEventListener('load', function() {
        var isCreate = <?php echo json_encode($getstatus); ?>;

        if (isCreate) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: 'Payement effectué',
                padding: '2em',
            })
        }


    });
</script>
    
  

@endsection
