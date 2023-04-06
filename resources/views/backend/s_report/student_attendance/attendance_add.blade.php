@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script type="text/javascript" src="{% static "javascript/main.js" %}"></script>


<script src=" {{ asset('js/handlebars-v4.7.7.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script> --}}



<style>
    
    .text-center {
        text-align: center;
    }

    .vert-align {
        text-align: center;
        vertical-align: middle !important;
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

    #loaderDiv{
        display: flex;
        flex-direction:column;
    }
</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter Status Elève</h3>
                <div class="widget-content widget-content-area">
                   
                     {{-- GET STATUS FOR SWEET ALERT  START --}}
                     @php
                        $getstatus = \Session::has('success');
                         $getUpdateStatus = \Session::has('successUpdate');
                    @endphp
                 {{-- GET STATUS FOR SWEET ALERT START --}}

                    <div class="head">
                              
                        <div class="row date">
                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                                <label for="text">Classe</label>
                                <select name="class_id" id="class_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner classe</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class['student_class']['id'] }}"
                                        {{ @$class_id == $class->id ? 'selected' : '' }}>
                                            {{ $class['student_class']['name'] }}</option>
                                    @endforeach
    
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                                <label for="text">Série</label>
                                <select name="branch_id" id="branch_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner Série</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                                <label for="text">Semestre</label>
                                <select name="class_id" id="class_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner Semestre</option>
                                    @foreach ($seasons as $season)
                                        <option value="{{ $season->id }}"
                                        {{ @$season_id == $season->id ? 'selected' : '' }}>
                                            {{ $season->name }}</option>
                                    @endforeach
    
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 ">
                                <label for="text">Groupe</label>
                                <select name="group_id" id="group_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner groupe</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form method="post" action=" {{  route('student.attendance.store') }} ">
                        @csrf
                        <div class="col-12 col-md-12">
                            {{-- SPINNER LOAD START --}} 
                            <div id="loaderDiv" class="  justify-content-between mx-5 mt-3 mb-5">
                                
                                <div class="spinner-grow text-warning align-self-center"></div>
                            </div>
                            {{-- SPINNER LOAD END --}} 
                            <div id="DocumentResults">
    
                                <script id="document-template" type="text/x-handlebars-template">
                                    @{{{ h5source }}}
                                    <table id="style-2" class="table style-2  ">
                                        <thead>
                                            <tr>
                                                @{{{ thsource }}}
                                            </tr>
                                            <tr>
                                                @{{{ thsource2 }}}
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

                                    <input type="submit" class="btn btn-outline-info search mb-2" value="Enregistrer" id="">
                           
    
                                </script>
    
                            </div>
                            
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>

    <script>
        $("#loaderDiv").hide();
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

                            var html = '<option value="">Sélectionner groupe</option>';
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
                        var html = '<option value="">Sélectionner groupe</option>';
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
    
    <script>
          $(document).on('click', '#search', function() {
            var class_id = $('#class_id').val();
            var branch_id = $('#branch_id').val();
            var group_id = $('#group_id').val();
            var date = $('#date').val();
            console.log(group_id);
            feetch(class_id, branch_id, group_id );
        });

        function feetch(class_id, branch_id, group_id){
            $.ajax({
                url: "{{ route('student.attendance.get') }}",
                type: "get",
                data: { 'class_id':class_id ,'branch_id': branch_id,'group_id': group_id },
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
