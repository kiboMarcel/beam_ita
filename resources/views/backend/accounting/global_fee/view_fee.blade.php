@extends('admin.admin_master')


<link href="{{ asset('backend/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

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

    .delete-icon {
        width: 18%;
    }

    .delete-icon:hover {
        cursor: pointer;
        color: blueviolet;
    }

    .w-summary-info {
        align-items: baseline;
    }

</style>

@section('admin')

  

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            @foreach ($feeDetails as $detail)
                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h6 class="">Statistic {{ $detail['fee_category']['name'] }} </h6>
                        </div>

                        <div class="w-chart">
                            <div class="w-chart-section">
                                <div>
                                    <p class="w-title">Total</p>
                                    <p class="w-stats">{{number_format($detail->amount, 0, ',', ' ')}} cfa</p>
                                </div>
                                <div class="w-chart-render-one">
                                    <div class="delete-icon" id="delete-icon">
                                        <a href="  {{ route('global.amount.reset', $detail->id) }}" class="bs-tooltip"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Renitialiser">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="w-chart-section">
                                <div>
                                    <p class="w-title">Opération totale </p>
                                    <p class="w-stats" id="totalOperation"> {{ $detail->total_operation }} </p>
                                </div>
                                <div class="w-chart-render-one">
                                    <div class="delete-icon" id="delete-icon">
                                        <a href="  {{ route('global.operation.reset', $detail->id) }}" class="bs-tooltip"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Renitialiser">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach






          {{--   <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="widget-heading">
                                <h6 class="">Opération Effectuée Aujourd'hui </h6>
                            </div>
                        

                        </div>
                        <div>
                            <div class="" aria-valuemax="100">
                                <p class="w-title">Ecollage:
                                    <strong>
                                        {{ $today_schooling_opreation == null ? '0' : $today_schooling_opreation }}</strong>
                                </p>
                            </div>
                            <div class="" aria-valuemax="100">
                                <p>Autres: <strong>{{ $today_payment_opreation == null ? '0' : $today_payment_opreation }} </strong> 
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget widget-account-invoice-two">
                <div class="widget-content">
                    <div class="account-box">
                        <div class="info">
                            <h5 class="">Pro Plan</h5>
                            <p class="inv-balance">$10,344</p>
                        </div>
                        <div class="acc-action">
                            <div class="">
                                <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                            </div>
                            <a href="javascript:void(0);">Upgrade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        </div>


        <script src="{{ asset('backend/assets/js/dashboard/dash_2.js') }}"></script>



    @endsection
