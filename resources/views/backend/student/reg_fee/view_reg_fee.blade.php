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

    .find{
        margin-top: 25px;
    }

    .statbox {
        margin-top: 17px !important;
    }

</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <h3>Frais des eleves</h3>

                    <div class="head">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-9 ">
                                <label for="text">Année</label>
                                <select name="year_id" id="year_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner Année</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ @$year_id == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-9 ">
                                <label for="text">Classe</label>
                                <select name="class_id" id="class_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner classe</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ @$class_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-9 ">
                                <label for="text">Série</label>
                                <select name="branch_id" id="branch_id" class="custom-select">
                                    <option value="" selected="" disabled="">Sélectionner Série</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ @$branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-9 find">

                                <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive mb-4">

                        <div id="DocumentResults">

                            <script id="document-template" type="text/x-handlebars-template">

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

    </div>


    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            //console.log('makima')
             var year_id = $('#year_id').val();
             var class_id = $('#class_id').val();
             var branch_id = $('#branch_id').val();
              $.ajax({
               url: "{{ route('registration.fee.get') }}",
               type: "get",
               data: {'year_id':year_id,'class_id':class_id, 'branch_id': branch_id},
               beforeSend: function() {       
               },
               success: function (data) {
                 var source = $("#document-template").html();
                 var template = Handlebars.compile(source);
                 var html = template(data);
                 $('#DocumentResults').html(html);
                 $('[data-toggle="tooltip"]').tooltip();
                 //console.log('makima')
               }
             });
        });
    </script>

@endsection
