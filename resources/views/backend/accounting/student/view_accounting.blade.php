@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script type="text/javascript" src="{% static "javascript/main.js" %}"></script>

<script src=" {{ asset('js/handlebars-v4.7.7.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script> --}}



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

    

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a {
        margin: 0 9px;
    }

    .search-section{
        align-items: center;
    }

    

    .statbox {
        margin-top: 17px !important;
    }

    #loaderDiv{
        display: flex;
        flex-direction:column;
    }
</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="row search-section">
                        <div class="col-lg-3 col-md-3 col-sm-9 ">
                            <label for="text">Opération à Effectuer: </label>
                          
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-9 ">
                            <select name="feeCategory" id="feeCategory" class="custom-select" required>
                                <option value="" selected="" disabled="">Sélectionner une option</option>
                                @foreach ($feeCategories as $feeCategory)
                                    <option value="{{ $feeCategory->id }}"
                                        {{ $feeCategory->id== '2' ? 'selected': ''}} >
                                        {{ $feeCategory->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                    <hr style="width:50% ">
                    <label for="text">Chercher Elève </label>

                     {{-- GET STATUS FOR SWEET ALERT  START --}}
                     @php
                     $getstatus = \Session::has('success');
                     $getUpdateStatus = \Session::has('successUpdate');
                     
                 @endphp
                 {{-- GET STATUS FOR SWEET ALERT START --}}

                    <div class="head">
                              
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <input id="searchText" type="text" name="searchText" class="form-control search-form-control " placeholder="Search...">
                        
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">

                                <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>
                                 </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive mb-4">
                        {{-- SPINNER LOAD START --}} 
                        <div id="loaderDiv" class="  justify-content-between mx-5 mt-3 mb-5">
                            
                            <div class="spinner-grow text-warning align-self-center"></div>
                        </div>
                        {{-- SPINNER LOAD END --}} 
                        <div id="DocumentResults">

                            <script id="document-template" type="text/x-handlebars-template">
                                @{{{ h5source }}}
                                <table class="table table-bordered  table-hover">
                                    <thead>
                                        <tr>
                                            @{{{ thsource }}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                    </tbody>
                                </table>

                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    <script>
        $("#loaderDiv").hide();
   </script>

    {{-- GET STUDENT ON SEARCH START --}}
    <script type="text/javascript">
       /*  $(document).on('click', '#search', function() {
            var searchText = $('#searchText').val();
            
              $.ajax({
               url: "{{ route('schooling.fee.get') }}",
               type: "get",
               data: {'searchText':searchText,},
               beforeSend: function() {       
               },
               success: function (data) {
                 var source = $("#document-template").html();
                 var template = Handlebars.compile(source);
                 var html = template(data);
                 $('#DocumentResults').empty().append(html);
                 //$('[data-toggle="tooltip"]').tooltip();
                 console.log(this)
               }
             });
        }); */

               
    </script>
    
    <script>
          $(document).on('click', '#search', function() {
            var feeCategory = $('#feeCategory').val();
            var searchText = $('#searchText').val();
            //console.log(feeCategory)
            feetch(searchText, feeCategory);
        });

        $("#searchText").keyup(function(event) {
            var feeCategory = $('#feeCategory').val();
            var searchText = $('#searchText').val();
            if (event.keyCode === 13) {
                feetch(searchText, feeCategory);
            }
        });

        function feetch(searchText, feeCategory){
            $.ajax({
                url: "{{ route('student.fee.get') }}",
                type: "get",
                data: {'searchText':searchText, 'feeCategory':feeCategory,},
                beforeSend: function() {  
                    $("#loaderDiv").show();     
                }, 
                complete: function() {
                    $("#loaderDiv").hide();
                 },
                success: function (data) {
                    console.log(data);
                    render(data);
                }

            });
        } 
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        

        function render(data){
            var html = template(data);
            $('#DocumentResults').empty().html(html);
         //$('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    {{-- GET STUDENT ON SEARCH END --}}

    


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
                type: 'success',
                title: 'Créer avec succès',
                padding: '2em',
            })
        }


    });
</script>
@endsection
