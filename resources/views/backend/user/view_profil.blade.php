@extends('admin.admin_master')

<style>
    .bt-position {
        display: flex;
        justify-content: flex-end;
    }

</style>


@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <form method="post" action=" {{ route('profil.update', $user->id) }} " class="section general-info">
                @csrf
                <div class="info">
                    @if (Auth::user()->role == 'Admin')
                    <div class="bt-position">
                        <a href="{{ route('profil.password') }}" class="btn btn-warning ">Modifier mot de passe</a>
                    </div>
                    @endif
                   
                    <h6 class="">Information Generale</h6>
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="row">
                             {{--    <div class="col-xl-2 col-lg-12 col-md-4">
                                    <div class="upload mt-4 pr-md-4">
                                        <input type="file" id="input-file-max-fs" class="dropify"
                                            data-default-file="{{ asset('backend/assets/img/200x200.jpg') }}"
                                            data-max-file-size="2M" />
                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture
                                        </p>
                                    </div>
                                </div> --}}
                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Nom</label>
                                                    <input type="text" name="name" class="form-control mb-4" id="name"
                                                        placeholder="Name" value=" {{ $user->name }} ">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control mb-4" id="email"
                                                        placeholder="email" name="email" value=" {{ $user->email }} ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Role</label>
                                                    <input type="text" disabled class="form-control mb-4" id="role"
                                                        name="role" value=" {{ $user->usertype }} ">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Adresse</label>
                                                    <input type="text" class="form-control mb-4" id="role" name="address"
                                                        value=" {{ $user->address }} ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">N- Téléphone</label>
                                                    <input type="text" class="form-control mb-4" id="role" name="mobile"
                                                        value=" {{ $user->mobile }} ">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email">Genre</label>
                                                    <select name="gender" id="select" class="custom-select" required>
                                                        <option value="" selected="" disabled="">Sélectionner le sexe
                                                        </option>
                                                        <option value="Masculin"
                                                            {{ $user->gender == 'Masculin' ? 'selected' : '' }}>Masuclin
                                                        </option>
                                                        <option value="Feminin"
                                                            {{ $user->gender == 'Feminin' ? 'selected' : '' }}>Feminin
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bt-position">
                        <button class="btn btn-primary btnC" type="submit">Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>

    </ @endsection
