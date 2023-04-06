@extends('admin.admin_master')

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
    .bt-position {
        display: flex;
        justify-content: flex-end;
    }
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-10">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Matiere</h3>
                <hr>
                <form method="post" action=" {{ route('subject.type.update', $editSubject->id)}}  ">
                    @csrf
                    <div class="row">
                       
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom <span class="text-danger">*</span></label>
                                <input  type="text" name="name" value=" {{ $editSubject->name }} " class="form-control" id="formGroupExampleInput" >
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Type <span class="text-danger">*</span></label>
                                <select name="type" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner Type</option>
                                    <option value="Obligatoire"
                                    {{ $editSubject->type == 'Obligatoire' ? 'selected' : '' }}>Obligatoire
                                    </option>
                                    <option value="Facultatif"
                                    {{ $editSubject->type == 'Facultatif' ? 'selected' : '' }}>Facultatif
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <div class="form-group mb-4">
                                    <label for="formGroupExampleInput">Groupe </label>
                                    <select name="subject_group_id" id="subject_group_id" class="custom-select" required>
                                        <option  selected="" value="null">Sélectionner groupe</option>
                                        @foreach ($subject_group as $group)
                                            <option value="{{ $group->id }}"
                                                {{ ($editSubject->group == $group->id ? 'selected': '' ) }}>{{ $group->name }}</option>
                                        @endforeach
                                        <option value="0">Ajouter Groupe</option>
                                    </select>
                                    <input type="text"  id="add_other" name="subject_name" class="form-control" 
                                    placeholder="Ecrire raison" style="display: none">
                                </div>
                            </div>
                        </div>
                    </div>
                  
                      
                     <div class="bt-position">
                         <button class="btn btn-primary" type="submit">Mettre à jour</button>
                     </div>

                    </div>
            
                </form>
            </div>
        </div>

        <script text="text/javascript" >
            $(document).ready(function(){
                $(document).on('change', '#subject_group_id', function(){
                    var subject_group_id = $(this).val();
                    if(subject_group_id == '0'){
                        $('#add_other').show();
                    }else{
                        $('#add_other').hide();
                    }
                } )
            } )
        </script>
@endsection
