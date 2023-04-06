@extends('admin.admin_master')


<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<style>
    .tr_style,
    .table {
        background-color: #0e1726 !important;
    }

    .tr_style:hover {
        background-color: #152238;
    }

    .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }


    .thead_tr {
        color: blueviolet;
        margin-bottom: 20px;
    }

    .thead_tr:hover {
        background-color: none !important;
    }

    .exam-type {
        margin-top: 20px !important;
        margin-bottom: 20px !important;
    }

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a {
        margin: 0 9px;
    }

</style>

@section('admin')
    {{-- GET STATUS FOR SWEET ALERT  START --}}
    @php
    $getstatus = \Session::has('update');

    @endphp
    {{-- GET STATUS FOR SWEET ALERT START --}}
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-9">
            <div class="statbox widget box box-shadow">
                <div class="table-responsive mb-4 content">
                    <h3> Modifier Notes</h3>

                    <h6>Elève: <strong> {{ $detail['0']['student']['name'] }}</strong> </h6>
                    <h6>Classe: <strong>{{ $detail['0']['student_class']['name'] }}</strong> </h6>

                    <h6>Matière: <strong>{{ $examMarks[0]['assign_subject']['school_subject']['name'] }}</strong> </h6>

                    <h6>Semestre: <strong>{{ $examMarks[0]['season']['name'] }}</strong> </h6>

                   

                    {{-- GET STATUS FOR SWEET ALERT  START --}}
                    @php
                        $getstatus = \Session::has('update');
                        $status = \Session::has('error');
                        
                    @endphp
                    {{-- GET STATUS FOR SWEET ALERT START --}}

                    <form method="post"
                        action=" {{ route('marks.update', [$detail[0]->student_id, 
                        $examMarks[0]->assign_subject_id, $detail[0]->year_id, 
                        $examMarks[0]['season']['id']]) }}  ">
                        @csrf
                        {{-- VISIBLE ADD Intero DIV START --}}

                        <div class="add_item_intero">

                            <div class="" id="">
                                <div class="">

                                    {{-- HIDDEN INPUT END --}}
                                    <input type="hidden" name="id_no" value=" {{ $detail['0']->id_no }} ">
                                    <input type="hidden" name="year_id" value=" {{ $detail['0']->year_id }} ">
                                    <input type="hidden" name="class_id" value=" {{ $detail['0']->class_id }} ">
                                    <input type="hidden" name="branch_id" value=" {{ $detail['0']->branch_id }} ">
                                    <input type="hidden" name="group_id" value=" {{ $detail['0']->group_id }} ">
                                    <input type="hidden" name="assign_subject_id"
                                        value=" {{ $detail['0']->assign_subject_id }} ">
                                    <input type="hidden" name="season_id" value=" {{ $examMarks[0]['season']['id'] }} ">
                                    {{-- HIDDEN INPUT END --}}

                                    <table id="style-2" class="table exam-type style-2  ">
                                        {{-- Devoir Marks start --}}
                                        <tbody>
                                            @if ($intero->toArray()== null)
                                            <h3 style="margin-top: 37px;">Interrogation</h3>

                                            <tr class="thead_tr delete_whole_extra_item_add1"
                                            id="delete_whole_extra_item_add1">
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> Note </p>
                                                </div>
                                            </td>


                                            <td>

                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <input type="text" disabled 
                                                            value="" class="form-control">
                                                    </div>
                                                </div>
                                            </td>
                                          
                                        </tr>

                                            @else

                                                @if ($intero['0']['exam_type']['description'] == 'Intero')
                                                <h3 style="margin-top: 37px;">Interrogation</h3>
                                                    @foreach ($intero as $item)

                                                    <tr class="thead_tr delete_whole_extra_item_add1"
                                                        id="delete_whole_extra_item_add1">
                                                        <td>
                                                            <div class="d-flex">
                                                                <p class="align-self-center mb-0 "> Note </p>
                                                            </div>
                                                        </td>


                                                        <td>

                                                            <div class="d-flex">
                                                                <div class="d-flex">
                                                                    <input type="text" name="i_marks[]"
                                                                        value="{{ $item->marks }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    
                                                    </tr>

                                                    @endforeach


                                                @endif
                                                
                                            @endif

                                           
                                        </tbody>
                                        {{-- Devoir Marks end --}}
                                    </table>



                                </div>
                            </div>

                        </div>
                        {{-- VISIBLE ADD Intero DIV END --}}


                        @if ($devoirMarks->toArray() != null)
                            {{-- VISIBLE ADD DEVOIR DIV START --}}
                            <div class="add_item1">

                                <div class="" id="">
                                    <div class="">

                                        {{-- HIDDEN INPUT END --}}
                                        <input type="hidden" name="id_no" value=" {{ $detail['0']->id_no }} ">
                                        <input type="hidden" name="year_id" value=" {{ $detail['0']->year_id }} ">
                                        <input type="hidden" name="class_id" value=" {{ $detail['0']->class_id }} ">
                                        <input type="hidden" name="branch_id" value=" {{ $detail['0']->branch_id }} ">
                                        <input type="hidden" name="group_id" value=" {{ $detail['0']->group_id }} ">
                                        <input type="hidden" name="assign_subject_id"
                                            value=" {{ $detail['0']->assign_subject_id }} ">
                                        <input type="hidden" name="season_id"
                                            value=" {{ $devoirMarks[0]['season']['id'] }} ">
                                        {{-- HIDDEN INPUT END --}}

                                        <table id="style-2" class="table exam-type style-2  ">
                                            {{-- Devoir Marks start --}}
                                            <tbody>
                                                @if ($devoirMarks['0']['exam_type']['description'] == 'Devoir')
                                                    <h3 style="margin-top: 37px;">Devoir</h3>
                                                    @foreach ($devoirMarks as $item)


                                                        <tr class="thead_tr delete_whole_extra_item_add1"
                                                            id="delete_whole_extra_item_add1">
                                                            <td>
                                                                <div class="d-flex">
                                                                    <p class="align-self-center mb-0 "> Note </p>
                                                                </div>
                                                            </td>


                                                            <td>

                                                                <div class="d-flex">
                                                                    <div class="d-flex">
                                                                        <input type="text" name="d_marks[]"
                                                                            value="{{ $item->marks }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                          {{--   <td>
                                                                <span class="btn btn-danger mb-2 mr-2 remove1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-plus">
                                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                    </svg>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="btn btn-success   mb-2 mr-2 add1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-plus">
                                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                    </svg>
                                                                </span>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                            {{-- Devoir Marks end --}}
                                        </table>



                                    </div>
                                </div>

                            </div>
                            {{-- VISIBLE ADD DEVOIR DIV END --}}
                        @endif



                        {{-- VISIBLE ADD EXAM DIV START --}}
                        <div class="add_item2">

                            <div class="" id="">
                                <div class="">

                                    <table id="style-2" class="table exam-type style-2  ">
                                        <tbody>
                                            {{-- exam Marks start --}}
                                            @if ($examMarks != 'null')
                                                <h3 style="margin-top: 37px;">Examen</h3>
                                                @foreach ($examMarks as $item)
                                                    <tr class="thead_tr  delete_whole_extra_item_add2"
                                                        id="delete_whole_extra_item_add2">
                                                        <td>
                                                            <div class="d-flex">
                                                                <p class="align-self-center mb-0 "> Note </p>
                                                            </div>
                                                        </td>


                                                        <td>

                                                            <div class="d-flex">
                                                                <div class="d-flex">
                                                                    <input type="text" name="e_marks[]"
                                                                        value="{{ $item->marks }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>
                                                      {{--   <td>
                                                            <span class="btn btn-danger mb-2 mr-2 remove2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-plus">
                                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                </svg>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-success   mb-2 mr-2 add2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-plus">
                                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                                </svg>
                                                            </span>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            @endif
                                            {{-- exam Marks end --}}
                                        </tbody>
                                    </table>



                                </div>
                            </div>

                        </div>
                        {{-- VISIBLE ADD EXAM DIV END --}}


                        <button class="btn btn-primary" type="submit">Mettre a jour</button>

                </div>

                </form>
            </div>
        </div>
    </div>

    <div style="visibility: hidden">
        {{-- ADD DEVOIR MARK START --}}
        <div class="whole_extra_item_add1" id="whole_extra_item_add1">
            <div class="delete_whole_extra_item_add1" id="delete_whole_extra_item_add1">
                <div class="">

                    <table id="style-2" class="table exam-type style-2  ">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <p class="align-self-center mb-0 "> Note </p>
                                    </div>
                                </td>


                                <td>

                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <input type="text" name="d_marks[]" value="" class="form-control">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="btn btn-danger mb-2 mr-2 remove1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                </td>
                                <td>
                                    <span class="btn btn-success   mb-2 mr-2 add1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{-- ADD DEVOIR MARK END --}}


        {{-- ADD EXAM MARK START --}}
        <div class="whole_extra_item_add2" id="whole_extra_item_add2">
            <div class="delete_whole_extra_item_add2" id="delete_whole_extra_item_add2">
                <div class="">

                    <table id="style-2" class="table exam-type style-2  ">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <p class="align-self-center mb-0 "> Note </p>
                                    </div>
                                </td>


                                <td>

                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <input type="text" name="e_marks[]" value="" class="form-control">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="btn btn-danger mb-2 mr-2 remove2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                </td>
                                <td>
                                    <span class="btn btn-success   mb-2 mr-2 add2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        {{-- ADD EXAM MARK END --}}
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".add1", function() {
                var whole_extra_item_add = $('#whole_extra_item_add1').html();
                $(this).closest(".add_item1").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".remove1", function(event) {
                $(this).closest(".delete_whole_extra_item_add1").remove();
                counter -= 1
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".add2", function() {
                var whole_extra_item_add2 = $('#whole_extra_item_add2').html();
                $(this).closest(".add_item2").append(whole_extra_item_add2);
                counter++;
            });
            $(document).on("click", ".remove2", function(event) {
                $(this).closest(".delete_whole_extra_item_add2").remove();
                counter -= 1
            })
        })
    </script>

    {{-- SWEET ALERT SCRIPT --}}
    <script>
        window.addEventListener('load', function() {
            var update = <?php echo json_encode($status); ?>;

            if (update) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'Veuiller enregistrer la note d\'intero',
                    padding: '2em',
                })
            }


        });
    </script>


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
                    type: 'success',
                    title: 'Mise a jour avec Succès',
                    padding: '2em',
                })
            }



        });
    </script>

@endsection
