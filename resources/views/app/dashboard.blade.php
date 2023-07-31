@if ((Session::has('user_name')))
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Proplogix Lien Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Proplogix Lien Search" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />

    <link href="{{asset('plugins/nestable/jquery.nestable.min.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
    <!-- jvectormap -->
    <link href="{{asset('plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/jquery-steps/jquery.steps.css')}}">
    <link href="{{asset('plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->

    <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App css -->

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <link href="{{asset('assets/css/split.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .loaderclass {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            position: fixed;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .dtp .p10>a {
            color: #FFF !important;
        }

        .topbar .topbar-inner {
            width: 100% !important;
            margin: 0 auto;
            padding: 0 12px;
        }

        #loading-overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            display: none;
            align-items: center;
            background-color: #000;
            z-index: 999;
            opacity: 0.5;
        }

        .loading-icon {
            position: absolute;
            border-top: 2px solid #fff;
            border-right: 2px solid #fff;
            border-bottom: 2px solid #fff;
            border-left: 2px solid #767676;
            border-radius: 25px;
            width: 25px;
            height: 25px;
            margin: 0 auto;
            position: absolute;
            left: 50%;
            margin-left: -20px;
            top: 50%;
            margin-top: -20px;
            z-index: 4;
            -webkit-animation: spin 1s linear infinite;
            -moz-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @-moz-keyframes spin {
            100% {
                -moz-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .dt-button {
            background-color: #0069d9 !important;
            border-color: #0062cc !important;
            color: #FFF !important;
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }

        .placeorders_top_border {
            border-top: 5px solid #f68c1e !important;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            /* background-color: #41B680 !important;
                border-color: #41B680 !important; */
        }

        .btn-success {
            background-color: #41B680 !important;
            border-color: #41B680 !important;
        }

        .btn-warning {
            /* background-color: #f68c1e !important; */
        }

        .btn-primary {
            /* background-color: #41B680 !important;
            border-color: #41B680 !important; */
        }

        .navbar-custom-menu .has-submenu.active a {
            /*  color: #41B680 !important; */
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {
            color: #fff;
            /* background-color: #41B680;
                border-color: #eaf0f9 #eaf0f9 #41B680; */
        }

        .navbar-custom-menu .navigation-menu>li:hover a {
            /*  color: #41B680 !important; */
        }

        .navigation-menu {
            margin-top: 6px;
        }

        /* Customize scrollbar */
        ::-webkit-scrollbar {
        width: 8px;
        }

        ::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
        background-color: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
        background-color: #555;
        }
    </style>
</head>

<body data-layout="horizontal" style="background-image: url({{asset('assets/images/mainbg.png')}});background-color: #edf0f5;">
    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>
    <div class="topbar">
        <div class="topbar-inner">
            <div class="topbar-left text-center">
                <a href="{{route('dashboard')}}" class="logo">
                    {{-- <span> --}}
                        <img src="data:image;base64,{{Session::get('logo')}}" type="image" alt="logo-small" class="logo-sm"
                            style="height: 30px;">
                    {{-- </span> --}}
                </a>
            </div>
            <div class="navbar-custom-menu ml-4">
                <div id="navigation">
                    <ul class="navigation-menu">
                        <li class='has-submenu active'><a href="{{route('dashboard')}}"><i class="dripicons-home"></i>
                                Dashboard </a></li>
                        <li class='has-submenu'><a href="{{route('orderlist')}}" onclick="load_orders_ajax()"><i class="dripicons-list"></i>
                                Order List </a> </li>
                        @if(str_ends_with(Session::get('user_type'), "Admin"))
                        <li class='has-submenu'><a href="{{route('assignorders')}}" onclick="load_orders_ajax()"><i class="dripicons-list"></i>
                            Assign Orders </a> </li>
                        @endif
                        <li class='has-submenu'><a href="{{route('orders_upload')}}"><i class="dripicons-list"></i>
                                Order Upload </a> </li>
                        <li class='has-submenu'><a href="{{route('single_order')}}" onclick="load_orders_ajax()"><i class="dripicons-list"></i>
                                Order Creation </a> </li>
                        @if(str_ends_with(Session::get('user_type'), "Admin"))
                        <li class="has-submenu">
                            <a href="#">
                                <i class="dripicons-gear"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="submenu">
                                @if(str_ends_with(Session::get('user_type'), "Admin"))
                                <li><a href="{{route('user')}}"><i style="font-size: 16px;" class="dripicons-user"></i>
                                        Users </a></li>
                                @endif
                                @if (Session::get('user_type') == 'Super Admin')
                                <li><a href="{{route('organization')}}"><i style="font-size: 16px;"
                                            class="dripicons-network-3"></i> Organizations </a></li>
                                @endif
                                @if(str_ends_with(Session::get('user_type'), "Admin"))
                                <li><a href="{{route('customer')}}"><i style="font-size: 16px;"
                                            class="dripicons-user"></i> Customers </a></li>
                                @endif
                                <li><a href="{{route('product_type')}}"><i style="font-size: 16px;"
                                            class="dripicons-list"></i> Product Types </a></li>
                                <li><a href="{{route('user_type')}}"><i style="font-size: 16px;"
                                            class="dripicons-document-new"></i> User Types </a></li>
                                @if (Session::get('user_type') == 'Super Admin')
                                <li><a href="{{route('delete_orders')}}"><i style="font-size: 16px;"
                                            class="dripicons-trash"></i> Delete Orders </a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(str_ends_with(Session::get('user_type'), "Admin"))
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="dripicons-document-new"></i>
                                    <span>Reports</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="{{route('batchwise_report')}}"><i style="font-size: 16px;"
                                        class="dripicons-document"></i> BatchWise Report </a></li>
                                    <li><a href="{{route('eta_report')}}"><i style="font-size: 16px;"
                                        class="dripicons-document"></i> ETA Report </a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Navbar -->
            <nav class="navbar-custom float-right">
                <ul class="list-unstyled topbar-nav mb-0">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/users/user-1.png')}}" alt="profile-user"
                                class="rounded-circle" />
                            <span class="ml-1 nav-user-name hidden-sm">{{Session::get('user_name')}}<i
                                    class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider mb-0"></div>

                            <a class="dropdown-item" href="{{route('logout')}}"><i
                                    class="ti-power-off text-muted mr-2"></i>
                                Logout</a>
                        </div>
                    </li>
                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link" id="mobileToggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a><!-- End mobile menu toggle-->
                    </li>
                    <!--end menu item-->
                </ul>
                <!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
        <!--topbar-inner-->
    </div>
    <!-- Top Bar End -->

    <div class="content">
        <!-- Dynamic content section -->
        @yield('content')
        <footer class="footer text-center text-sm-left">
            <div class="boxed-footer text-center">
                <a href="https://stellaripl.com/">&copy; {!! date("Y") !!} Stellar Innovations Pvt Ltd.</a>
           </div>
        </footer><!--end footer-->
    </div>
    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/apexcharts/apexcharts.min.js')}}"></script> --}}
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
    {{-- <script src="{{asset('assets/pages/jquery.analytics_dashboard.init.js')}}"></script> --}}
    <!-- App js -->

    <!-- Parsley js -->
    <script src="{{asset('plugins/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.validation.init.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.datatable.init.js')}}"></script>
    <script src="{{asset('plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.form-upload.init.js')}}"></script>
    {{-- <script src="{{asset('assets/pages/jquery.tickets.init.js')}}"></script> --}}
    <script src="{{asset('assets/pages/jquery.animate.init.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.form-wizard.init.js')}}"></script>
    <script src="{{asset('plugins/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.form-repeater.js')}}"></script>
    <script src="{{asset('assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}">
    </script>
    <script src="{{asset('plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}">
    </script>
    <script src="{{asset('plugins/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.form-editor.init.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.forms-advanced.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

<script>
    function handleCheckboxChange() {
        if ($("#is_active").val() == 1) {
            $("#is_active").val(0);
        } else {
            $("#is_active").val(1);
        }
    }

</script>

<script>
    $('.datepick').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    });

    // Select2
    $(".multiselect").select2({
        width: '100%'
    });
    $(document).ready(function () {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    });




</script>

</html>
@else
{!! redirect()->to('/login') !!}
@endif
