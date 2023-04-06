@extends('admin.admin_master')


<script src="{{ asset('backend/assets/js/dashboard/dash_1.js') }}"></script>

<style>
    .day {
        text-align: center;
    }

    .day-time {
        padding: 2px;
        text-align: center;
    }

    .card-school {
        display: flex;
        justify-content: space-around;
        ;
    }

    img {
        width: 100px;
    }

    .slide-right {
        -webkit-animation: slide-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: slide-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

 
    @keyframes slide-right {
        0% {
            -webkit-transform: translateX(0);
            transform: translateX(0);
        }
        40% {
            -webkit-transform: translateX(40px);
            transform: translateX(40px);
        }
        60% {
            -webkit-transform: translateX(50px);
            transform: translateX(50px);
        }
        100% {
            -webkit-transform: translateX(60px);
            transform: translateX(60px);
        }
    }


    #color {
        background-color: purple;
    }

    #color1 {
        background-color: hotpink;
    }


    .w-icon {
        justify-content: center;
        align-items: center;
    }

    .w-summary-info {
        align-items: baseline;
    }

</style>
@php

$school_info = App\Models\schoolInfo::where('id', 1)->first();

$totalStudentBoy = App\Models\User::where('usertype', 'Student')
    ->where('gender', 'Masculin')
    ->get();

$totalStudentGirl = App\Models\User::where('usertype', 'Student')
    ->where('gender', 'Feminin')
    ->get();

$totalStudent = App\Models\User::where('usertype', 'Student')->get();

$permanentEmployee = App\Models\User::where('usertype', 'employee')
    ->where('contrat', 'Permanent')
    ->get();

$vacantEmployee = App\Models\User::where('usertype', 'employee')
    ->where('contrat', 'Vacataire')
    ->get();

$totalEmployee = App\Models\User::where('usertype', 'employee')->get();
@endphp
@section('admin')
    <div class="row layout-top-spacing">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget">
                <div class="widget-heading  card-school">
                    <img class="slide-right"
                        src="{{ !empty($school_info->image) ? url('upload/school_image/' . $school_info->image) : url('upload/school_image/no_image.jpg') }}"
                        alt="">
                    <label for="">{{ $school_info == null ? '' : $school_info->name }}</label>
                </div>

            </div>
        </div>
        {{-- GET STATUS FOR SWEET ALERT  START --}}
        @php
            $getstatus = \Session::has('error');
            
        @endphp
        {{-- GET STATUS FOR SWEET ALERT START --}}


        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-two">
                <div class="widget-heading">
                    <div id="day" class="day-time"></div>
                </div>
                <div class="widget-content">
                    <div id="time" class="day-time"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-three">
                <div class="widget-heading">
                    <h5 class="">Effectif Global des Elèves</h5>
                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/mars.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Hommes</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudentBoy) }}
                                    </span>
                                </div>


                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/female1.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Femmes</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudentGirl) }} </span>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/total.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Total</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudent) }}</span>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-three">
                <div class="widget-heading">
                    <h5 class="">Employés</h5>
                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-anchor">
                                    <circle cx="12" cy="5" r="3"></circle>
                                    <line x1="12" y1="22" x2="12" y2="8"></line>
                                    <path d="M5 12H2a10 10 0 0 0 20 0h-3"></path>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Permanent</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($permanentEmployee) }}
                                    </span>
                                </div>


                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-in">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Vacataire</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($vacantEmployee) }} </span>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/total.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Total</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalEmployee) }}</span>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-three">
                <div class="widget-heading">
                    <h5 class=""> </h5>
                </div>
                <div class="widget-content">

                    {{-- <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-anchor">
                                    <circle cx="12" cy="5" r="3"></circle>
                                    <line x1="12" y1="22" x2="12" y2="8"></line>
                                    <path d="M5 12H2a10 10 0 0 0 20 0h-3"></path>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Permanent</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($permanentEmployee) }}
                                    </span>
                                </div>


                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-in">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Vacataire</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($vacantEmployee) }} </span>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/total.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Total</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalEmployee) }}</span>
                                </div>

                            </div>

                        </div>


                    </div> --}}

                </div>
            </div>
        </div>


    </div>


    <link href="{{ asset('backend/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN TIMER  SCRIPT -->

    <script>
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function startTime() {
            var today = new Date();
            //var m = today.toLocaleString('default', { month: 'long' });
            var d = Intl.DateTimeFormat('fr-FR', {
                weekday: 'long'
            }).format(today);
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            //console.log(d);
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);

            document.getElementById('time').innerHTML = " <h1> " + h + ":" + m + ":" + s + " </h1> ";
            t = setTimeout(function() {
                startTime()
            }, 500);
            document.getElementById('day').innerHTML = " <h1> " + d + " </h1> ";

        }
        startTime();
    </script>
    <!-- END  TIMER SCRIPT -->

    {{-- SWEET ALERT SCRIPT --}}
    <script>
        window.addEventListener('load', function() {
            var status = <?php echo json_encode($getstatus); ?>;

            if (status) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'Une erreur s\'est produite',
                    padding: '2em',
                })
            }

        });
    </script>
@endsection
