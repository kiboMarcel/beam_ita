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
            <form method="post" action=" {{ route('school.info.update', $edit->id)}} "
            enctype="multipart/form-data" class="section general-info">
                @csrf
                <div class="info">
                   
                    <h6 class="">Information sur l'école</h6>
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="row">
                                <div class="col-xl-2 col-lg-12 col-md-4">
                                    <div class="upload mt-4 pr-md-4">
                                        <input type="file" name="image" id="input-file-max-fs" class="dropify"
                                            data-default-file="{{ 
                                            (!empty($edit->image))? url('upload/school_image/'.$edit->image.'jpg')
                                            : url('upload/school_image/no_image.jpg') }}"
                                            data-max-file-size="2M" />
                                        <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Ajouter logo
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Nom de l'ecole<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="name" value=" {{$edit->name}} " required class="form-control"
                                                        id="formGroupExampleInput">

                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>

                                            <div class="col-6 col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Adresse <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="address"  value=" {{$edit->Address}} " required class="form-control"
                                                        id="formGroupExampleInput">

                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Quartier <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="district"  value=" {{$edit->district}} " required class="form-control"
                                                        id="formGroupExampleInput">

                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Numéro <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="num"  value=" {{$edit->num}} " required class="form-control"
                                                        id="formGroupExampleInput">
                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="">Information du Directeur/Proviseur</h6>
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="row">
                              
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-md-0 mt-4">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Titre<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="title" value="{{$edit2->title}}" required class="form-control"
                                                        id="formGroupExampleInput">

                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>

                                            <div class="col-6 col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Nom de l'occupant <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="occupant"  value="{{$edit2->name}}" required class="form-control"
                                                        id="formGroupExampleInput">

                                                    <span class="text-danger"></span>

                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bt-position">
                        <button class="btn btn-primary btnC" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
