@extends('admin.admin_master')

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
.bt-position {
        display: flex;
        justify-content: flex-end;
    }
</style>

@php
 $dob = date('Y-m-d', strtotime( $editData['student']['date_of_birth']) );

 //dd($dob);
@endphp

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Elève</h3>
                <hr>
                <form method="post" action=" {{ route('student.registration.update', $editData->student_id) }} " enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  name="id" value=" {{ $editData->id }} ">
                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom Prénoms <span class="text-danger">*</span></label>
                                <input type="text" name="name" required class="form-control"
                                    value="{{ $editData['student']['name'] }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">N Mat </label>
                                <input type="text" name="nmat"  class="form-control" id="formGroupExampleInput"
                                value="{{ $editData['student']['id_no'] }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom du père <span class="text-danger">*</span></label>
                                <input type="text" name="fname"  class="form-control"
                                    value="{{ $editData['student']['fname'] }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom de la mère <span class="text-danger">*</span></label>
                                <input type="text" name="mname"  class="form-control"
                                    value="{{ $editData['student']['mname'] }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Numéro du tuteur <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="mobile" required class="form-control"
                                    value="{{ $editData['student']['mobile'] }}">

                            </div>
                        </div>
                        {{-- <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Adresse <span class="text-danger">*</span></label>
                                <input type="text" name="address" required class="form-control"
                                    value=" {{ $editData['student']['address'] }} ">

                            </div>
                        </div> --}}
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Genre</label>
                                <select name="gender" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner le sexe</option>
                                    <option value="Masculin"
                                        {{ $editData['student']['gender'] == 'Masculin' ? 'selected' : '' }}>Masuclin
                                    </option>
                                    <option value="Feminin"
                                        {{ $editData['student']['gender'] == 'Feminin' ? 'selected' : '' }}>Feminin
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                      {{--   <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Nationalité</label>
                                <select name="nationality" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner pays</option>
                                    <option value="Togo"
                                        {{ $editData['student']['nationality'] == 'Togo' ? 'selected' : '' }}>Togo
                                    </option>
                                    <option value="Benin"
                                        {{ $editData['student']['nationality'] == 'Benin' ? 'selected' : '' }}>Benin
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Année de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" required class="form-control"
                                value="{{ $dob }}">

                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Lieu de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="place_of_birth" required class="form-control"
                                value="{{ $editData['student']['place_of_birth'] }}">

                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <label for="text">Classe</label>
                            <select name="class_id" id="class_id" class="custom-select
                            {{$active ==0 ? 'disabled' : ''}}" required>
                                <option value="" selected="" disabled="">Sélectionner Classe</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class['student_class']['id'] }}"
                                    {{ $editData->class_id == $class['student_class']['id'] ? 'selected' : '' }}>
                                    {{ $class['student_class']['name'] }}</option>
                                @endforeach

                            </select>
                        </div>

                     

                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Série</label>
                                <select name="branch_id" id="branch_id" class="custom-select
                                {{$active ==0 ? 'disabled' : ''}}" >
                                    <option value="" selected="" disabled="">Sélectionner Série</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $editData->branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                       
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Groupe</label>
                                <select name="group_id" id="group_id" class="custom-select
                                {{$active ==0 ? 'disabled' : ''}}" required>
                                    <option value="" selected="" disabled="">Sélectionner Groupe</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ $editData->group_id == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Status <span class="text-danger">*</span></label>
                                <input type="text" name="status" required class="form-control"
                                value="{{ $editData->status }}">
                            </div>
                        </div>

                      

                    </div>
                    {{-- end row --}}

                     {{-- start row --}}
                     
                     <div class="row">

                        <div class="col-2 col-md-2">
                         
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="form-group mb-4">
                                <label for="text">Année</label>
                                <select name="year_id" id="select" class="custom-select" required>
                                    <option value=" " selected="" disabled="">Sélectionner Année</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $editData->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-2 col-md-2">
                         
                        </div>
                    </div>
                    {{-- end row --}}

                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>
                    

            </div>

            </form>
        </div>
    </div>

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

                            var html = '<option value="">Sélectionner Groupe</option>';
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
@endsection
