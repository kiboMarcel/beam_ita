@extends('admin.admin_master')


<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<style>
    .add, .remove {
        float: right;
        margin-top: 33px;
    }

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter Tranche</h3>
                <hr>
                <form method="post" action=" {{ route('slice.store') }}  ">
                    @csrf

                    <div class="add_item">

                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Categorie <span class="text-danger">*</span></label>
                                <select name="category_id" id="select" class="custom-select">
                                   {{--  <option value="" selected="" disabled="" > Sélectionner categories </option> --}}
                                    @foreach ($fee_categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $category->name == 'Ecollage'? 'selected': ''}} > {{ $category->name }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="email">Classe <span class="text-danger">*</span></label>
                                <select name="class_id" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="" > Sélectionner classe </option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"> {{ $class->name }} </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                      


                    </div>
                    <div class="row">
                        
                        

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Tranche <span class="text-danger">*</span></label>
                                <input type="text" name="slice_amount[]" class="form-control" id="formGroupExampleInput">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
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



                    <button class="btn btn-primary" type="submit">Enregistrer</button>

            </div>

            </form>
        </div>
    </div>

    {{-- add more section start --}}
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-6 col-md-6">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Tranche <span class="text-danger">*</span></label>
                            <input type="text" name="slice_amount[]" class="form-control" id="formGroupExampleInput">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                  
                    <div class="col-6 col-md-6">
                      
                        <span class="btn btn-danger mb-2 mr-2 remove">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                        <span class="btn btn-success  mb-2 mr-2 add">
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
        </div>
    </div>

    {{-- add more section end --}}

    <script type="text/javascript">
        $(document).ready(function(){
            var counter =0 ;
            $(document).on("click", ".add", function(){
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".remove",function(event){
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            })
        })
    </script>

@endsection
