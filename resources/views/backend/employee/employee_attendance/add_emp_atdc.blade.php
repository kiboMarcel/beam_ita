@extends('admin.admin_master')

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
    .text-center {
        text-align: center;
    }

    .vert-align {
        text-align: center;
        vertical-align: middle !important;
    }


    .n-chk {
        margin: auto;
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
                <h3>Ajouter Status</h3>
                <hr>
                <form method="post" action=" {{ route('attendance.store') }}  ">
                    @csrf
                    <div class="row">

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date <span class="text-danger">*</span></label>
                                <input type="date" name="date" class="form-control" id="formGroupExampleInput" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-12 col-md-12">
                            <table id="style-2" class="table style-2  table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="vert-align">#</th>
                                        <th rowspan="2" colspan="2" class="vert-align"> LISTE EMPLOYE</th>
                                        <th colspan="3" class="text-center"> STATUS</th>
                                        <th rowspan="2" class="vert-align"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Present</th>
                                        <th class="text-center">Absent</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        <tr id="div{{ $employee->id }}" class="delete_whole_extra_item_add">
                                            <input type="hidden" name="employee_id[]" value=" {{ $employee->id }} ">
                                            <td class="text-center"> {{ $key + 1 }} </td>

                                            <td class="text-center">
                                                <div>
                                                    <p class="align-self-center  mb-0 ">
                                                        {{ $employee->name }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div>
                                                    <p class="align-self-center  mb-0 ">
                                                        <span
                                                            class="badge {{ $employee->contrat == 'Permanent' ? 'badge-primary' : 'badge-success' }} badge-primary">
                                                            {{ $employee->contrat }} </span>

                                                    </p>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="d-flex">
                                                    <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-success">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{ $employee->id }}"
                                                                id="present{{ $employee->id }}" value="present" checked>
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Présent</span>
                                                        </label>

                                                        {{-- <label class="new-control new-radio new-radio-text radio-warning"  >
                                                        <input type="radio"  class="new-control-input" name="attend_status{{$key}}"
                                                        id="retard{{$key}}" value="retard">
                                                        <span class="new-control-indicator"></span><span class="new-radio-content">Retard</span>
                                                    </label> --}}

                                                    </div>
                                                  {{--   <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-warning">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{ $employee->id }}"
                                                                id="retard{{ $employee->id }}" value="retard">
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Retard</span>
                                                        </label>
                                                    </div> --}}

                                                    <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-danger">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{$employee->id }}"
                                                                id="absent{{ $employee->id }}" value="absent">
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Absent</span>
                                                        </label>
                                                    </div>

                                                </div>

                                            </td>
                                            <td>
                                                <button class="btn btn-danger mb-2 mr-2 rounded-circle remove" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-minus">
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>


                        </div>
                    </div>

                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>
            </div>


            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".remove", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            })
        })
    </script>
@endsection
