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
                    <h3>Relevé de Note</h3>
                    <form method="get" action="  " target="_blank">
                        @csrf

                        <div class="head">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Année</label>
                                    <select name="year_id" id="year_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Sélectionner Année</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}"  {{ $year->active == 1 ? 'selected' : '' }}>
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
                                                        @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

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

                            </div> <br>
                            <div class="row">
                               


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

                            {{--     <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Numéro matricule </label>
                                    <input  type="text" id="id_no" name="id_no" class="form-control" >
                                </div> --}}


                                <div class="col-lg-3 col-md-3 col-sm-3 find">

                                    <a id="search" name="search" class="btn btn-outline-info chercher  mb-2">Chercher</a>

                                </div>


                            </div> <br>

                        </div>
                        <hr>

                           {{-- SPINNER LOAD START --}} 
                           <div id="loaderDiv" class="  justify-content-between mx-5 mt-3 mb-5">
                            
                            <div class="spinner-grow text-warning align-self-center"></div>
                        </div>
                        {{-- SPINNER LOAD END --}} 
                        {{-- marksheet generate table start --}}
                        <div class="table-responsive mb-4">

                            <div class="d-none" id="marksheet-generate">

                                <table id="style-2" class="table style-2  table-hover">
                                    <thead>
                                        <tr class="thead_tr">
                                            <th> Nom Prénoms</th>
                                            <th> Num mat</th>
                                            <th> Classe</th>
                                            <th> Filière</th>
                                            <th> Groupe</th>
                                            <th> Bulletin</th>
                                        </tr>
                                    </thead>

                                    <tbody id="marksheet-generate-tr">

                                    </tbody>
                                </table>

 </div>

                        </div>
                        {{-- marksheet generate table end --}}
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        $("#loaderDiv").hide();
   </script>



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
                url: "{{ route('marksheet.get.students') }}", //default controller
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'branch_id': branch_id,
                    'assign_subject_id': assign_subject_id,
                    'group_id': group_id,
                    'season_id': season_id,
                   /*  'id_no': id_no */
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
                        $('#marksheet-generate').removeClass('d-none');
                        var html = '';
                        html = $('#marksheet-generate-tr').html(html);
                    }
                    else if(data[0].branch_id == null){ //BRANCH IS NULL
                        $('#marksheet-generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                       
                        
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
                            '<td>  <a target="blank" href=" {{ route('marksheet.student.get', ['','','','','', ''] )}}'+
                        '/'+v.year_id+'/'+v.class_id+'/'+v.branch_id+'/'+v.group_id+'/'+v.student_id+'/'+v.season_id+' " '+
                                'class="bs-tooltip" data-toggle="tooltip" '+
                               ' data-placement="top" title="" data-original-title="Detail"> '+
                               ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                               ' viewBox="0 0 24 24" fill="none" color="#185ADB" '+
                               ' stroke="currentColor" stroke-width="2" stroke-linecap="round" '+
                               ' stroke-linejoin="round" class="feather feather-file-text"> '+
                               ' <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"> </path> '+
                               ' <polyline points="14 2 14 8 20 8"></polyline> '+
                               ' <line x1="16" y1="13" x2="8" y2="13"></line> '+
                               ' <line x1="16" y1="17" x2="8" y2="17"></line> '+
                               ' <polyline points="10 9 9 9 8 9"></polyline> '+
                               ' </svg> '+
                               ' </a> </td>' +
                            '</tr>';
                    });
                    html = $('#marksheet-generate-tr').html(html);

                    }else{
                        $('#marksheet-generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                       
                        
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td>' + v.student_branch.name + '</td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            '<td>  <a target="blank" href=" {{ route('marksheet.student.get', ['','','','','', ''] )}}'+
                        '/'+v.year_id+'/'+v.class_id+'/'+v.branch_id+'/'+v.group_id+'/'+v.student_id+'/'+v.season_id+'  " '+
                                'class="bs-tooltip" data-toggle="tooltip" '+
                               ' data-placement="top" title="" data-original-title="Detail"> '+
                               ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                               ' viewBox="0 0 24 24" fill="none" color="#185ADB" '+
                               ' stroke="currentColor" stroke-width="2" stroke-linecap="round" '+
                               ' stroke-linejoin="round" class="feather feather-file-text"> '+
                               ' <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"> </path> '+
                               ' <polyline points="14 2 14 8 20 8"></polyline> '+
                               ' <line x1="16" y1="13" x2="8" y2="13"></line> '+
                               ' <line x1="16" y1="17" x2="8" y2="17"></line> '+
                               ' <polyline points="10 9 9 9 8 9"></polyline> '+
                               ' </svg> '+
                               ' </a> </td>' +
                            '</tr>';
                    });
                    html = $('#marksheet-generate-tr').html(html);
                    }
                    
                }
            });
			
				
            });
        });
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
           /*  var id_no = $('#id_no').val(); */
            $.ajax({
                url: "{{ route('marksheet.get.students') }}", //default controller
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'branch_id': branch_id,
                    'assign_subject_id': assign_subject_id,
                    'group_id': group_id,
                    'season_id': season_id,
                   /*  'id_no': id_no */
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
                        $('#marksheet-generate').removeClass('d-none');
                        var html = '';
                        html = $('#marksheet-generate-tr').html(html);
                    }
                    else if(data[0].branch_id == null){ //BRANCH IS NULL
                        $('#marksheet-generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        let student_id = v.student_id;
                        let year_id = v.year_id;
                        let class_id = v.class_id;
                        let branch_id = v.branch_id;
                        let group_id = v.group_id;
                        let season_id = v.season_id;
                        let detail_url =   '{{ route('marksheet.student.get', ['','','','','', ''] )}}'+
                        '/'+year_id+'/'+class_id+'/'+branch_id+'/'+group_id+'/'+student_id+'/'+season_id+' ';
                        
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
                            '<td>  <a target="blank" href=" '+detail_url+' " '+
                                'class="bs-tooltip" data-toggle="tooltip" '+
                               ' data-placement="top" title="" data-original-title="Detail"> '+
                               ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                               ' viewBox="0 0 24 24" fill="none" color="#185ADB" '+
                               ' stroke="currentColor" stroke-width="2" stroke-linecap="round" '+
                               ' stroke-linejoin="round" class="feather feather-file-text"> '+
                               ' <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"> </path> '+
                               ' <polyline points="14 2 14 8 20 8"></polyline> '+
                               ' <line x1="16" y1="13" x2="8" y2="13"></line> '+
                               ' <line x1="16" y1="17" x2="8" y2="17"></line> '+
                               ' <polyline points="10 9 9 9 8 9"></polyline> '+
                               ' </svg> '+
                               ' </a> </td>' +
                            '</tr>';
                    });
                    html = $('#marksheet-generate-tr').html(html);

                    }else{
                        $('#marksheet-generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        let student_id = v.student_id;
                        let year_id = v.year_id;
                        let class_id = v.class_id;
                        let branch_id = v.branch_id;
                        let group_id = v.group_id;
                        let season_id = v.season_id;
                        let detail_url =   '{{ route('marksheet.student.get', ['','','','','', ''] )}}'+
                        '/'+year_id+'/'+class_id+'/'+branch_id+'/'+group_id+'/'+student_id+'/'+season_id+' ';
                        
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td>' + v.student_branch.name + '</td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            '<td>  <a target="blank" href=" '+detail_url+' " '+
                                'class="bs-tooltip" data-toggle="tooltip" '+
                               ' data-placement="top" title="" data-original-title="Detail"> '+
                               ' <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" '+
                               ' viewBox="0 0 24 24" fill="none" color="#185ADB" '+
                               ' stroke="currentColor" stroke-width="2" stroke-linecap="round" '+
                               ' stroke-linejoin="round" class="feather feather-file-text"> '+
                               ' <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"> </path> '+
                               ' <polyline points="14 2 14 8 20 8"></polyline> '+
                               ' <line x1="16" y1="13" x2="8" y2="13"></line> '+
                               ' <line x1="16" y1="17" x2="8" y2="17"></line> '+
                               ' <polyline points="10 9 9 9 8 9"></polyline> '+
                               ' </svg> '+
                               ' </a> </td>' +
                            '</tr>';
                    });
                    html = $('#marksheet-generate-tr').html(html);
                    }
                    
                }
            });
        });
    </script>

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
                        '<option value="" selected="" >Sélectionner Série</option>';
                    
                    $('#branch_id').html(html);

                        var html = '<option  disabled="" value="">Sélectionner Groupe</option>';
                    $.each(data, function(key, v) {
                        html += '<option value="' + v.group_id + '">' + v
                            .student_group
                            .name + '</option>';
                    });
                    $('#group_id').html(html);

                    }else{
                        
                    var html =
                        '<option value="" selected="" >Sélectionner Série</option>';
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
                    var html = '<option  disabled="" value="">Sélectionner Groupe</option>';
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

  {{--   <script type="text/javascript">
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
                        var html = '<option value="">Sélectionner Matiere</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.school_subject
                                .name + '</option>';
                        });
                        $('#assign_subject_id').html(html);
                    }
                });
            });
        });
    </script> --}}

@endsection
