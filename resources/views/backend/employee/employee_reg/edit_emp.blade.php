@extends('admin.admin_master')

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
    .bt-position {
        display: flex;
        justify-content: flex-end;
    }

</style>
@php
$dob = date('Y-m-d', strtotime($editData->date_of_birth));
$joindate = date('Y-m-d', strtotime($editData->join_date));
@endphp

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Employé</h3>
                <hr>
                <form method="post" action=" {{ route('employee.update', $editData->id) }} "
                    enctype="multipart/form-data">
                    @csrf
                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom<span class="text-danger">*</span></label>
                                <input type="text" name="name" required class="form-control"
                                    value="{{ $editData->name }}" id="formGroupExampleInput"
                                    placeholder="ex Jhon Pierre Doe">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom du père <span class="text-danger">*</span></label>
                                <input type="text" name="fname" value="{{ $editData->fname }}" required
                                    class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom de la mère <span class="text-danger">*</span></label>
                                <input type="text" name="mname" value="{{ $editData->mname }}" required
                                    class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Numéro <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" value="{{ $editData->mobile }}" required
                                    class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Adresse <span class="text-danger">*</span></label>
                                <input type="text" name="address" value="{{ $editData->address }}" required
                                    class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Genre</label>
                                <select name="gender" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner sexe</option>
                                    <option value="Masculin" {{ $editData->gender == 'Masculin' ? 'selected' : '' }}>
                                        Masuclin
                                    </option>
                                    <option value="Feminin" {{ $editData->gender == 'Feminin' ? 'selected' : '' }}>Feminin
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                     {{--    <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Nationalité</label>
                                <select name="nationality" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner pays</option>
                                    <option value="Togo" {{ $editData->nationality == 'Togo' ? 'selected' : '' }}>Togo
                                    </option>
                                    <option value="Benin" {{ $editData->nationality == 'Benin' ? 'selected' : '' }}>Benin
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Année de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" required class="form-control"
                                    value="{{ $dob }}" id="formGroupExampleInput">

                            </div>


                        </div>
                        <div class="col-4 col-md-4">
                            <label for="text">Désignation</label>
                            <select name="designation_id" id="select" class="custom-select" required>
                                <option value="" selected="" disabled="">Sélectionner désignation</option>
                                @foreach ($designation as $des)
                                    <option value="{{ $des->id }}"
                                        {{ $editData->designation_id == $des->id ? 'selected' : '' }}>
                                        {{ $des->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Début service</label>
                                <input type="date" name="join_date" required class="form-control"
                                    value="{{ $joindate }}" id="formGroupExampleInput">
                            </div>
                        </div>

                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Contrat</label>
                                <select name="contrat" id="contrat" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner contrat</option>
                                    <option value="Permanent"
                                    {{ $editData->contrat == 'Permanent' ? 'selected' : '' }}>Permanent
                                    </option>
                                    <option value="Vacataire"
                                    {{ $editData->contrat == 'Vacataire' ? 'selected' : '' }}>Vacataire
                                    </option>
                                </select>
                              
                            </div>
                        </div>
                       {{--  @if (!$editData) --}}
                            <div class="col-4 col-md-4">
                                <div class="form-group mb-4">
                                    <label for="text" id="salaire">Salaire</label>
                                    <input type="text" value="{{ $editData->salary }}" name="salary" required 
                                        class="form-control" id="formGroupExampleInput">

                                </div>
                            </div>
                       {{--  @endif

                        @if (!$editData) --}}
                          
                       {{--  @endif --}}

                    </div>
                    {{-- end row --}}

                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>



            </div>

            </form>
        </div>
    </div>

    <script text="text/javascript" >
        $(document).ready(function(){
            $(document).on('change', '#contrat', function(){
                var contrat = $(this).val();
                if(contrat == 'Permanent'){
/*                     $('#salaire').hide(); */
                    document.getElementById('salaire').innerHTML = " Salaire Mensuel ";
                }else{
                    document.getElementById('salaire').innerHTML = " Salaire de base ";
                }
            } )
        } )
        </script>
@endsection
