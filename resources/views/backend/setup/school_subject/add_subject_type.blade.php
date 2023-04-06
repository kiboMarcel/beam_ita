@extends('admin.admin_master')

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
    .add,
    .remove {
        float: right;
        margin-top: 33px;
    }


    .bt-position {
        display: flex;
        justify-content: flex-end;
    }

</style>
@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-10">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter Matière </h3>
                <hr>
                <form method="post" action=" {{ route('subject.type.store') }}  ">
                    @csrf
                    <div class="add_item">
                        <div class="row">
                            <div class="col-3 col-md-3">
                                <div class="form-group mb-4">
                                    <label for="formGroupExampleInput">Nom  <span class="text-danger">*</span></label>
                                    <input type="text" name="name[]" required  class="form-control" id="formGroupExampleInput">
                                    @error('name.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3 col-md-3">
                                <div class="form-group mb-4">
                                    <label for="formGroupExampleInput">Type <span class="text-danger">*</span></label>
                                    <select name="type[]" id="select formGroupExampleInput" class="custom-select" required>
                                        <option value="" selected="" disabled="">Sélectionner Type</option>
                                        <option value="Obligatoire">Obligatoire
                                        </option>
                                        <option value="Facultatif">Facultatif
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 col-md-3">
                                <div class="form-group mb-4">
                                    <label for="formGroupExampleInput">Groupe </label>
                                    <select name="subject_group_id[]" id="subject_group_id" class="custom-select" required>
                                        <option  selected="" value="null" >Sélectionner groupe</option>
                                        @foreach ($subject_group as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 col-md-3">

                                <span class="btn btn-success   mb-2 mr-2 add">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>



            </div>

            </form>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="row">

                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Nom  <span class="text-danger">*</span></label>
                            
                            <input type="text" name="name[]" class="form-control" id="formGroupExampleInput">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Type <span class="text-danger">*</span></label>
                            <select name="type[]" id="select formGroupExampleInput" class="custom-select" required>
                                <option value="" selected="" disabled="">Sélectionner Type</option>
                                <option value="Obligatoire">Obligatoire
                                </option>
                                <option value="Facultatif">Facultatif
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Groupe </label>
                            <select name="subject_group_id[]" id="subject_group_id" class="custom-select" required>
                                <option  selected="" value="null">Sélectionner groupe</option>
                                @foreach ($subject_group as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3 col-md-3">
                       
                        <span class="btn btn-success   mb-2 mr-2 add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                        <span class="btn btn-danger mb-2 mr-2 remove">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".add", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".remove", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1;
            })
            
        })
    </script>

@endsection
