@extends('admin.admin_master')


<style>
    .bt-position {
        display: flex;
        justify-content: flex-end;
    }

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-6">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter type d'examen</h3>
                <hr>
                <form method="post" action=" {{ route('exam.type.store') }}  ">
                    @csrf
                    <div class="row">

                        <div class="col-12 col-md-12">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="formGroupExampleInput">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
@endsection
