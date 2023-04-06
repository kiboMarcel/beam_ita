<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Bɘam | bkibo </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/faviconn.ico') }}" />
    <link href="{{ asset('backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    {{-- <link href="{{ asset('backend/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('backend/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('backend/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/components/custom-sweetalert.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css') }}">
    <!-- END THEME GLOBAL STYLES -->

    <link href="{{ asset('backend/assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />

    <!--  BEGIN CUSTOM STYLE FILE USER ACCOUNT  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('backend/assets/css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE USER ACCOUNT  -->

    

</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('admin.body.header')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('admin.body.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">



                @yield('admin')



            </div>
            @include('admin.body.footer')
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('backend/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('backend/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    {{-- <script src="{{ asset('backend/plugins/apex/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/assets/js/dashboard/dash_1.js') }}"></script> --}}
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src="{{ asset('backend/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
    <!-- END THEME GLOBAL STYLE -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('backend/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        $('#multi-column-ordering').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 0]
            }]
        });
    </script>


    <!--BEGIN SWEET ALERT DELETE CONFIRMATION SCRIPTS -->
    <script>
        $('.widget-content #delete').on('click', function(e) {
            e.preventDefault();
            var link = $(this).attr("href")
            swal({
                title: 'Etes vous Sûr ?',
                text: "Cette action est irreversible et supprimera tout objet lié a celui-ci!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    window.location.href = link
                    swal(
                        'Supression en cours!',
                    )
                }
            })
        })
    </script>
    <!-- END SWEET ALERT DELETE CONFIRMATION  SCRIPTS -->

  

    <!-- BEGIN USER ACCOUNT SCRIPT -->
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/users/account-settings.js') }}"></script>
    <!-- END  USER ACCOUNT SCRIPT -->


    

    <!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>
