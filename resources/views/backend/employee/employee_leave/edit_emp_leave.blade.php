@extends('admin.admin_master')


<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>

</style>


@php
    $start_date =  date('Y-m-d', strtotime( $editData->start_date));
    $end_date =  date('Y-m-d', strtotime( $editData->end_date));

     //dd($start_date);
@endphp


@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier une Permissions</h3>
                <hr>
                <form method="post" action=" {{ route('employee.leave.update',$editData->id) }}  ">
                    @csrf
                    <div class="row">


                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Employer <span class="text-danger">*</span></label>
                                <select name="employee_id" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ ($editData->employee_id == $employee->id ? 'selected' : '')}}>
                                            {{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date de Debut <span class="text-danger">*</span></label>
                                <input type="date" value="{{ $start_date }}" name="start_date" class="form-control" required
                                    id="formGroupExampleInput">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Raison de demission <span
                                        class="text-danger">*</span></label>
                                <select name="leave_purpose_id" id="leave_purpose_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Sélectionner raison</option>
                                    @foreach ($leave_purpose as $purpose)
                                        <option value="{{ $purpose->id }}"  {{ ($editData->leave_purpose_id == $purpose->id ? 'selected': '' ) }} >
                                            {{ $purpose->name }}</option>
                                    @endforeach
                                    <option value="0">Autre raison</option>
                                </select>
                              
                                <input type="text"  id="add_other" name="name" class="form-control" 
                                placeholder="Ecrire raison" style="display: none">
                            
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" value="{{$end_date}}" name="end_date" class="form-control" required
                                    id="formGroupExampleInput">
                            </div>
                        </div>

                    </div>



                    <button class="btn btn-primary" type="submit">Mettre à jour</button>

            </div>

            </form>
        </div>
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
