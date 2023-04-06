@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script src=" {{ asset('js/handlebars-v4.7.7.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script> --}}



<style>
    .tr_style {
        background-color: #0e1726 ;
    }

    .table {
        background-color: rebeccapurple ;
    }


    /* .head {
        display: flex;
        flex-direction: column;
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

    .find {
        margin-top: 25px;
    }

    .statbox {
        margin-top: 17px !important;
    }

    #loaderDiv {
        display: flex;
        flex-direction: column;
    }

</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                {{-- GET STATUS FOR SWEET ALERT  START --}}
                @php
                    $getstatus = \Session::has('success');
                    $checkMark = \Session::has('mark_exist');

                    
                @endphp
                {{-- GET STATUS FOR SWEET ALERT START --}}
                <div class="widget-content widget-content-area">
                    <h3>Ajouter Notes</h3>
                    <form method="post" action=" {{ route('marks.store') }}  ">
                        @csrf

                        <div class="head">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Année</label>
                                    <select name="year_id" id="year_id" class="custom-select" required>
                                        <option value="" disabled="">Sélectionner Année</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}"
                                                {{ $year->active == 1 ? 'selected' : '' }}>
                                                {{ $year->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Classe</label>
                                    <select name="class_id" id="class_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Sélectionner Classe</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class['student_class']['id'] }}">
                                                {{ $class['student_class']['name'] }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Série</label>
                                    <select name="branch_id" id="branch_id" class="custom-select">
                                        <option " selected="" disabled="">Sélectionner Série</option>
                                     {{--    @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}">
                                            {{ $branch->name }}</option>
                                        @endforeach --}}

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Matière</label>
                                    <select name="assign_subject_id" id="assign_subject_id" class="custom-select">
                                        <option selected="" disabled="">Sélectionner Matière</option>

                                    </select>
                                </div>


                            </div> <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Groupe</label>
                                    <select name="group_id" id="group_id" class="custom-select">
                                        <option " selected="" disabled=""> Sélectionner Groupe</option>
                                                       @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">
                                            {{ $group->name }}</option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Type D'examen</label>
                                    <select name="exam_type_id" id="exam_type_id" class="custom-select">
                                        <option " selected="" disabled="">Sélectionner examen</option>
                                                       @foreach ($exam_types as
                                            $exam_type)
                                        <option value="{{ $exam_type->id }}">
                                            {{ $exam_type->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Trimestre/Semestre</label>
                                    <select name="season_id" id="season_id" class="custom-select">
                                        <option " selected="" disabled="">Sélectionner Trim./Sem.</option>
                                                           @foreach ($seasons as $season)
                                        <option value="{{ $season->id }}">
                                            {{ $season->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 find">

                                    <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>

                                </div>


                            </div> <br>

                        </div>
                        <hr>


                        {{-- SPINNER LOAD START --}}
                        <div id="loaderDiv" class="  justify-content-between mx-5 mt-3 mb-5">

                            <div class="spinner-grow text-warning align-self-center"></div>
                        </div>
                        {{-- SPINNER LOAD END --}}

                        {{-- mark entry table start --}}
                        <div class="table-responsive mb-4">

                            <div class="d-none" id="mark-entry">

                                <table id="style-2" class="table style-2 table-striped ">
                                    <thead>
                                        <tr class="thead_tr">
                                            <th> Nom Prénoms</th>
                                            <th> Num mat</th>
                                            <th> Classe</th>
                                            <th> Filière</th>
                                            <th> Groupe</th>
                                            <th> Note</th>
                                        </tr>
                                    </thead>

                                    <tbody id="mark-enrty-tr">

                                    </tbody>
                                </table>


                                <input type="submit" class="btn btn-outline-info search mb-2" value="Enregistrer" id="">
                            </div>

                        </div>
                        {{-- mark entry table end --}}
                    </form>
                </div>
            </div>
        </div>

    </div>


    <script>
        $("#loaderDiv").hide();
    </script>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            //console.log('makima')
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var branch_id = $('#branch_id').val();
            var group_id = $('#group_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            var season_id = $('#season_id').val();
            $.ajax({
                url: "{{ route('students.get.students') }}", //default controller
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'branch_id': branch_id,
                    'assign_subject_id': assign_subject_id,
                    'exam_type_id': exam_type_id,
                    'group_id': group_id,
                    'season_id': season_id
                },
                beforeSend: function() {
                    $("#loaderDiv").show();
                },
                complete: function() {
                    $("#loaderDiv").hide();
                },
                success: function(data) {
                     //IF FIND NULL DATA
                     if(data.length == 0){
                        console.log('empty')
                        $('#mark-entry').removeClass('d-none');
                        var html = '';
                        html = $('#mark-enrty-tr').html(html);
                    }

                    else if(data[0].branch_id == null){ //BRANCH IS NULL
                        $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                        '<tr  class="tr_style delete_whole_extra_item_add">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td></td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            '<td><input type="text" value="0" class="form-control form-control-sm" name="marks[]"></td>' +
                            '<td><button class="btn btn-danger mb-2 mr-2 rounded-circle remove">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                                            'viewBox="0 0 24 24" fill="none" stroke="currentColor" '+
                                           ' stroke-width="2" stroke-linecap="round" stroke-linejoin="round" '+
                                            ' class="feather feather-minus"> '+
                                           ' <line x1="5" y1="12" x2="19" y2="12"></line> '+
                                        ' </svg> '+
                                    '</button> '+
                            '</td>'+
                            '</tr>';
                    });
                    html = $('#mark-enrty-tr').html(html);
                    }else{
                        $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                        '<tr  class="tr_style delete_whole_extra_item_add">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td>' + v.student_branch.name + '</td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            '<td><input type="text" value="0" class="form-control form-control-sm" name="marks[]"></td>' +
                            '<td><button class="btn btn-danger mb-2 mr-2 rounded-circle remove">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                                            'viewBox="0 0 24 24" fill="none" stroke="currentColor" '+
                                           ' stroke-width="2" stroke-linecap="round" stroke-linejoin="round" '+
                                            ' class="feather feather-minus"> '+
                                           ' <line x1="5" y1="12" x2="19" y2="12"></line> '+
                                        ' </svg> '+
                                    '</button> '+
                            '</td>'+
                            '</tr>';
                    });
                    html = $('#mark-enrty-tr').html(html);
                    }
                    
                }
            });
        });
    </script>

    {{-- GET CLASS SUBJECT FOR NON NULL BRANCH_ID START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#branch_id', function() {
                var class_id = $('#class_id').val();
                var branch_id = $('#branch_id').val();

                $.ajax({
                    url: "{{ route('marks.getsubject') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                        branch_id: branch_id
                    },
                    success: function(data) {
                            var html =
                            '<option disabled="" selected="" value="">Sélectionner Matière</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v
                                .school_subject
                                .name + '</option>';
                        });
                        $('#assign_subject_id').html(html);

                    }
                });
            });
        });
    </script>
    {{-- GET CLASS SUBJECT FOR NON NULL BRANCH_ID START --}}

    {{-- GET CLASS SUBJECT FOR  NULL BRANCH_ID START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#class_id', function() {
                var class_id = $('#class_id').val();
                //var branch_id = $('#branch_id').val();
                var branch_id = null;

                $.ajax({
                    url: "{{ route('marks.getsubject') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                        branch_id: branch_id
                    },
                    success: function(data) {
                        /* if (branch_id == null) { */
                            var html =
                                '<option disabled="" selected="" value="">Sélectionner Matière</option>';
                            $.each(data, function(key, v) {
                                html += '<option value="' + v.id + '">' + v
                                    .school_subject
                                    .name + '</option>';
                            });
                            $('#assign_subject_id').html(html);
                        }

                    /* } */
                });
            });
        });
    </script>
    {{-- GET CLASS SUBJECT FOR  NULL BRANCH_ID END --}}

    {{-- GET CLASS BRANCH START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#class_id', function() {
                var class_id = $('#class_id').val();
                $.ajax({
                    url: "{{ route('student.getclass.branch') }}",
                    type: "GET",
                    async: true,
                    data: {
                        class_id: class_id,
                    },

                    success: function(data) {
                        if (data[0].branch_id == null) {
                            var html =
                                '<option value="" disabled="" selected="" >Sélectionner Série</option>';

                            $('#branch_id').html(html);

                            var html = '<option value="">Sélectionner Groupe</option>';
                            $.each(data, function(key, v) {
                                html += '<option value="' + v.group_id + '">' + v
                                    .student_group
                                    .name + '</option>';
                            });
                            $('#group_id').html(html);

                        } else {

                            var html =
                                '<option value="" disabled="" selected="" >Sélectionner Série</option>';
                            $.each(data, function(key, v) {
                                html += '<option value="' + v.branch_id + '"  >' + v
                                    .student_branch
                                    .name + '</option>';
                            });
                            $('#branch_id').html(html);
                        }

                    }
                });
            });
        });
    </script>
    {{-- GET CLASS BRANCH END --}}

    {{-- GET CLASS GROUP START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#branch_id', function() {
                var class_id = $('#class_id').val();
                var branch_id = $('#branch_id').val();

                $.ajax({
                    url: "{{ route('student.getclass.group') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                        branch_id: branch_id,
                    },
                    success: function(data) {
                        var html = '<option value="">Sélectionner Groupe</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.group_id + '">' + v
                                .student_group
                                .name + '</option>';
                        });
                        $('#group_id').html(html);
                    }
                });
            });
        });
    </script>
    {{-- GET CLASS GROUP END --}}

    {{-- SWEET ALERT SCRIPT --}}
    <script>
        window.addEventListener('load', function() {
            var getstatus = <?php echo json_encode($getstatus); ?>;

            if (getstatus) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'success',
                    title: 'Note Ajouter avec Succès',
                    padding: '2em',
                })
            }

        });
    </script>


    <script>
        window.addEventListener('load', function() {
            var checkMark = <?php echo json_encode($checkMark); ?>;

            if (checkMark) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'Une note existe deja pour cette option. veuillez le modifier',
                    padding: '2em',
                })
            }

        });
    </script>

    
<script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".remove", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            })
        })
</script>
@endsection
