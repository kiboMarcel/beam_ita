@extends('admin.admin_master')


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
                                <input type="date" name="date"  value="{{ $editData['0']['date'] }}" class="form-control"
                                    id="formGroupExampleInput" required >
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
                                        <th rowspan="2" class="vert-align"> SL</th>
                                        <th rowspan="2" class="vert-align"> LIST EMPLOYE</th>
                                        <th colspan="3" class="text-center"> STATUS</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Present</th>
                                        <th class="text-center">Absent</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($editData as $key => $data)
                                        <tr id="div{{ $data->id }} ">
                                            <input type="hidden" name="employee_id[]" value=" {{ $data->employee_id }} ">
                                            <td class="text-center"> {{ $key + 1 }} </td>

                                            <td class="text-center">
                                                <div>
                                                    <p class="align-self-center  mb-0 "> {{ $data['user']['name'] }}</p>
                                                </div>
                                            </td>

                                            <td colspan="3">
                                                <div class="d-flex">
                                                    <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-success">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{ $data->employee_id }}"
                                                                id="present{{ $data->employee_id }}" value="present"
                                                                {{ $data->attend_status == 'present' ? 'checked' : '' }}
                                                                checked>
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Présent</span>
                                                        </label>

                                                        {{-- <label class="new-control new-radio new-radio-text radio-warning"  >
                                                        <input type="radio"  class="new-control-input" name="attend_status{{$key}}"
                                                        id="retard{{$key}}" value="retard">
                                                        <span class="new-control-indicator"></span><span class="new-radio-content">Retard</span>
                                                    </label> --}}

                                                    </div>
                                                {{--     <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-warning">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{ $data->employee_id }}"
                                                                id="retard{{ $data->employee_id }}" value="retard"
                                                                {{ $data->attend_status == 'retard' ? 'checked' : '' }}>
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Retard</span>
                                                        </label>
                                                    </div> --}}

                                                    <div class="n-chk">
                                                        <label class="new-control new-radio new-radio-text radio-danger">
                                                            <input type="radio" class="new-control-input"
                                                                name="attend_status{{ $data->employee_id }}"
                                                                id="absent{{ $data->employee_id }}" value="absent"
                                                                {{ $data->attend_status == 'absent' ? 'checked' : '' }}>
                                                            <span class="new-control-indicator"></span><span
                                                                class="new-radio-content">Absent</span>
                                                        </label>
                                                    </div>

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>


                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
@endsection
