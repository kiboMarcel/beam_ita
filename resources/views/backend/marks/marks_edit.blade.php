@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>


<script src=" {{ asset('js/handlebars-v4.7.7.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script> --}}



<style>
    .tr_style {
        background-color: #0e1726 !important;
    }

    .table {
        background-color: rebeccapurple !important;
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
                    <h3> Modifier Notes</h3>
                    <form method="post" action="   ">
                        @csrf

                        <div class="head">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Année</label>
                                    <select name="year_id" id="year_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Sélectionner Année</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}" {{ $year->active == 1 ? 'selected' : '' }}>
                                                {{ $year->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Classe</label>
                                    <select name="class_id" id="class_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Sélectionner classe</option>
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
                                                         

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Matiere</label>
                                    <select name="assign_subject_id" id="assign_subject_id" class="custom-select">
                                        <option selected="" disabled="">Sélectionner Matiere</option>

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

                                     <a id="chercher" name="search" class="btn btn-outline-info search mb-2 chercher">Chercher</a>

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

                                <table id="style-2" class="table style-2  table-hover">
                                   
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


                            </div>

                        </div>
                        {{-- mark entry table end --}}
                    </form>
                </div>
            </div>
        </div>

    </div>


<script type="text/javascript">
        $(function() {
            $(document).on('click', '.chercher', function() {
			var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var branch_id = $('#branch_id').val();
            var group_id = $('#group_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            var season_id = $('#season_id').val();
			
             console.log(year_id)
			 
			 
			$.ajax({
               url: "{{ route('students.edit.getstudents') }}",
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
						//let student_id = v.student_id;
                       // let assign_subject_id = v.assign_subject_id;
                       // let season_id = v.season_id;
                        //let detail_url = '{{ route('students.edit.detail', ['', '','']) }}' /' + student_id + '/' + assign_subject_id + '/' +season_id + '/';
                        
						//let detail_url = 'ok',
						
						html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td></td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            '<td><input type="text" value="0" class="form-control form-control-sm" name="marks[]"></td>' +
                            '</tr>';
                    });
                    html = $('#mark-enrty-tr').html(html);
                    }else{
                        $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
						
						
						
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">   </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td></td>' +
                            '<td>' + v.student_group.name + '</td>' +

                            '<td> <a target="blank" href=" {{ route('students.edit.detail', ['', '','']) }}' +
                            '/' + v.student_id + '/' + v.assign_subject_id + '/' +v.season_id + '/ " ' +
                            'class="bs-tooltip" data-toggle="tooltip" ' +
                            ' data-placement="top" title="Modifier" data-original-title="Detail"> ' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"' +
                            'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" '+
                            'stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"> '+
                            '<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">'+
                            '</path></svg> ' +
                            ' </a></td>' +
                            '</tr>';
                    });
                    html = $('#mark-enrty-tr').html(html);
                    }
                    
                }
				 
				 
				 
            });
				
            });
        });
    </script>

    <script>
         $("#loaderDiv").hide();
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
                        if(data[0].branch_id == null){
                            var html =
                            '<option value="" selected="" disabled="" >Sélectionner Série</option>';
                        
                        $('#branch_id').html(html);

                            var html = '<option value="">Sélectionner Groupe</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.group_id + '">' + v
                                .student_group
                                .name + '</option>';
                        });
                        $('#group_id').html(html);

                        }else{
                            
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
	
	
	<script type="text/javascript">
        $(document).on('click', '.chercher', function() {
            //console.log('makima')
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var branch_id = $('#branch_id').val();
            var group_id = $('#group_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            var season_id = $('#season_id').val();
            $.ajax({
                url: "{{ route('students.edit.getstudents') }}",
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

                    else if(data[0].branch_id == null){
                        $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        let student_id = v.student_id;
                        let assign_subject_id = v.assign_subject_id;
                        let season_id = v.season_id;
                        let detail_url = '{{ route('students.edit.detail', ['', '','']) }}' +
                            '/' + student_id + '/' + assign_subject_id + '/' +season_id + '/';
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">   </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td></td>' +
                            '<td>' + v.student_group.name + '</td>' +

                            '<td> <a target="blank" href=" ' + detail_url + ' " ' +
                            'class="bs-tooltip" data-toggle="tooltip" ' +
                            ' data-placement="top" title="Modifier" data-original-title="Detail"> ' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"' +
                            'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" '+
                            'stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"> '+
                            '<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">'+
                            '</path></svg> ' +
                            ' </a></td>' +
                            '</tr>';

                    });
                    html = $('#mark-enrty-tr').html(html);


                    }else{
                        $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        let student_id = v.student_id;
                        let assign_subject_id = v.assign_subject_id;
                        let season_id = v.season_id;
                        let detail_url = '{{ route('students.edit.detail', ['', '','']) }}' +
                            '/' + student_id + '/' + assign_subject_id + '/' +season_id + '/';
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">   </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td>' + v.student_branch.name + '</td>' +
                            '<td>' + v.student_group.name + '</td>' +

                            '<td> <a target="blank" href=" ' + detail_url + ' " ' +
                            'class="bs-tooltip" data-toggle="tooltip" ' +
                            ' data-placement="top" title="Modifier" data-original-title="Detail"> ' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"' +
                            'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" '+
                            'stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"> '+
                            '<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">'+
                            '</path></svg> ' +
                            ' </a></td>' +
                            '</tr>';

                    });
                    html = $('#mark-enrty-tr').html(html);
                    }
                  

                }
            });
        });
    </script>

  

@endsection
