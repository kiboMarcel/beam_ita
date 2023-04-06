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
                <h3>Modifier Mot de passe</h3>
                <hr>
                 {{-- GET STATUS FOR SWEET ALERT  START--}}
                 @php
                 $getstatus =  \Session::has('error'); 
                 
                 @endphp
                 {{-- GET STATUS FOR SWEET ALERT START --}}
                <form method="post" action=" {{ route('password.update') }} ">
                    @csrf
                    <div class="row">

                        <div class="col-12 col-md-12">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Ancien mot de passe <span
                                        class="text-danger">*</span></label>
                                <input id="current_password" type="password" name="oldpassword" class="form-control"
                                    id="formGroupExampleInput">
                                @error('oldpassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nouveau mot de passe <span
                                        class="text-danger">*</span></label>
                                <input id="password" type="password" name="password" class="form-control"
                                    id="formGroupExampleInput">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Confirmer mot de passe <span
                                        class="text-danger">*</span></label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control" id="formGroupExampleInput">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="bt-position">

                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SWEET ALERT SCRIPT --}}
    <script>
        window.addEventListener('load', function() {
            var isCreate = <?php echo json_encode($getstatus); ?>;

            if (isCreate) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'L\'ancien mot de passe ne correspond pas',
                    padding: '2em',
                })
            }
           

        });
    </script>
@endsection
