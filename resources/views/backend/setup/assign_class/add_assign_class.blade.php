@extends('admin.admin_master')


<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
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
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Attribuer Classe</h3>
                <hr>
                <form method="post" action=" {{ route('assign.class.store') }}  ">
                    @csrf

                    <div class="add_item">

                        <div class="row">

                            <div class="col-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="text">Classe <span class="text-danger">*</span></label>
                                    <select name="class_id" id="select" class="custom-select">
                                        <option value="" selected="" disabled=""> Sélectionner classe </option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"> {{ $class->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                        </div>
                        <div class="row">

                            <div class="col-2 col-md-2">
                                <div class="form-group mb-4">
                                    <label for="text">Série/Filière <span class="text-danger">*</span></label>
                                    <select name="branch_id[]" id="select" class="custom-select">
                                        <option value="" selected="" disabled=""> Selection  </option>
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}"> {{ $branch->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-2 col-md-2">
                                <div class="form-group mb-4">
                                    <label for="email">Groupe <span class="text-danger">*</span></label>
                                    <select name="group_id[]" id="select" class="custom-select" required>
                                        <option value="" selected="" disabled=""> Selection  </option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-2 col-md-2">
                                <div class="form-group mb-4">
                                    <label for="email">Moy. d'admission <span class="text-danger">*</span></label>
                                   
                                    <input type="text" name="pass_mark[]" required class="form-control"
                                        id="formGroupExampleInput">
                                </div>
                            </div>

                            <div class="col-3 col-md-3">
                                <div class="form-group mb-4">
                                    <label for="formGroupExampleInput">Professeur Titulaire <span class="text-danger">*</span></label>
                                    <select name="teacher_id[]" id="select" class="custom-select" required>
                                        <option value="" selected="" disabled=""> Sélectionner Prof. </option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                            <div class="col-2 col-md-2">
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
                <div class="form-row">

                    <div class="col-2 col-md-2">
                        <div class="form-group mb-4">
                            <label for="text">Série/Filière <span class="text-danger">*</span></label>
                            <select name="branch_id[]" id="select" class="custom-select">
                                <option value="" selected="" disabled=""> Selection </option>
                                @foreach ($branchs as $branch)
                                    <option value="{{ $branch->id }}"> {{ $branch->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-2 col-md-2">
                        <div class="form-group mb-4">
                            <label for="email">Groupe <span class="text-danger">*</span></label>
                            <select name="group_id[]" id="select" class="custom-select" required>
                                <option value="" selected="" disabled=""> Selection</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-2 col-md-2">
                        <div class="form-group mb-4">
                            <label for="email">Moy. d'admission <span class="text-danger">*</span></label>
                           
                            <input type="text" name="pass_mark[]" required class="form-control"
                                id="formGroupExampleInput">
                        </div>
                    </div>

                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Professeur Titulaire <span class="text-danger">*</span></label>
                            <select name="teacher_id[]" id="select" class="custom-select" required>
                                <option value="" selected="" disabled=""> Sélectionner Prof. </option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>



                    <div class="col-2 col-md-2">
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
                counter -= 1
            })
        })
    </script>

@endsection
