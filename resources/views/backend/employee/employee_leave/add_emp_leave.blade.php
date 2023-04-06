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
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Attribuer Permissions</h3>
                <hr>
                <form method="post" action=" {{ route('employee.leave.store') }}  ">
                    @csrf
                    <div class="row">


                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Employé <span class="text-danger">*</span></label>
                                <select name="employee_id" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner employé</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date de Début <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control" required
                                    id="formGroupExampleInput">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Raisons <span
                                        class="text-danger">*</span></label>
                                <select name="leave_purpose_id" id="leave_purpose_id" class="custom-select" required>
                                    <option  selected="" disabled="">Sélectionner raison</option>
                                    @foreach ($leave_purpose as $purpose)
                                        <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                    @endforeach
                                    <option value="0">Autres raisons</option>
                                </select>
                                <input type="text"  id="add_other" name="name" class="form-control" 
                                placeholder="Ecrire raison" style="display: none">
                            
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control" required
                                    id="formGroupExampleInput">
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


    <script text="text/javascript" >
    $(document).ready(function(){
        $(document).on('change', '#leave_purpose_id', function(){
            var leave_purpose_id = $(this).val();
            if(leave_purpose_id == '0'){
                $('#add_other').show();
            }else{
                $('#add_other').hide();
            }
        } )
    } )
    </script>

@endsection
