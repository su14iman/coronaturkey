<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoronaTürkiye | Control Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ================== GOOGLE FONTS ==================-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
    <!-- ======================= GLOBAL VENDOR STYLES ========================-->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/metismenu/dist/metisMenu.css">
    <link rel="stylesheet" href="../assets/vendor/switchery-npm/index.css">
    <link rel="stylesheet" href="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- ======================= LINE AWESOME ICONS ===========================-->
    <link rel="stylesheet" href="../assets/css/icons/line-awesome.min.css">
    <!-- ======================= DRIP ICONS ===================================-->
    <link rel="stylesheet" href="../assets/css/icons/dripicons.min.css">
    <!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
    <link rel="stylesheet" href="../assets/css/icons/material-design-iconic-font.min.css">
    <!-- ======================= GLOBAL COMMON STYLES ============================-->
    <link rel="stylesheet" href="../assets/css/common/main.bundle.css">
    <!-- ======================= LAYOUT TYPE ===========================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/core/main.css">
    <!-- ======================= MENU TYPE ===========================================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/menu-type/content.css">
    <!-- ======================= THEME COLOR STYLES ===========================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/themes/theme-i.css">
</head>

<body class="content-menu">
<!-- CONTENT WRAPPER -->
<div id="app">

    <!-- TOP TOOLBAR WRAPPER -->
    <nav class="top-toolbar navbar navbar-mobile navbar-tablet" style="background-color: #2e2e44;">
        <ul class="navbar-nav nav-left">
            <li class="nav-item">
                <a href="javascript:void(0)" data-toggle-state="aside-left-open">
                    <i class="icon dripicons-align-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav nav-center site-logo" style="
    															width: 75%;
															   ">
            <li>
                <a href="{{ route('index') }}">

                    <h1 class="brand-text">CoronaTürkiye</h1>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav nav-right">

        </ul>
    </nav>

    <nav class="top-toolbar navbar navbar-desktop flex-nowrap">
        <ul class="navbar-nav nav-left">
            <li class="nav-item">
                <a href="javascript:void(0)" data-toggle-state="content-menu-close">
                    <i class="icon dripicons-align-left"></i>
                </a>
            </li>


        </ul>
        <ul class="site-logo">
            <li>
                <!-- START LOGO -->
                <a href="{{ route('index') }}">

                    <h1 class="brand-text">CoronaTürkiye</h1>
                </a>
                <!-- END LOGO -->
            </li>
        </ul>
        <ul class="navbar-nav nav-right">





        </ul>

    </nav>
    <!-- END TOP TOOLBAR WRAPPER -->
    <div class="content-wrapper">
        <!-- MENU SIDEBAR WRAPPER -->
        <aside class="sidebar sidebar-left">
            <div class="sidebar-content">
                <nav class="main-menu">
                    <ul class="nav metismenu">

                        <li class="sidebar-header"><span>Perview</span></li>
                        <li><a target=”_blank” href="{{ route('home') }}"><i class="zmdi zmdi-eye zmdi-hc-fw"></i><span>
                                    Site Perview
                                </span></a></li>

                        <li class="sidebar-header"><span>NEWS</span></li>
                        <li><a href="{{ route('NewsSectionManger') }}"><i class="zmdi zmdi-tag zmdi-hc-fw"></i><span>News Sections Manger</span></a></li>
                        <li><a href="{{ route('NewsManger') }}"><i class="la la-newspaper-o"></i><span>News Manger</span></a></li>

                        <li class="sidebar-header"><span>STATISTICS</span></li>
                        <li><a href="{{ route('StatisticsManger') }}"><i class="la la-pie-chart"></i><span>Statistics Manger</span></a></li>

{{--                        <li class="sidebar-header"><span>Notifications</span></li>--}}
{{--                        <li><a href="apps.calendar.html"><i class="zmdi zmdi-notifications zmdi-hc-fw"></i><span>Notifications Manger</span></a></li>--}}

                        <li class="sidebar-header"><span>Settings</span></li>

                        @if(Auth::user()->id == 1)
                            <li><a href="{{ route('UsersManger') }}"><i class="la la-users"></i><span>Users Manger</span></a></li>
                        @endif

                        <li><a href="{{ route('AccountManger') }}"><i class="zmdi zmdi-settings zmdi-hc-fw"></i><span>Account Manger</span></a></li>

                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                            ><i class="la la-sign-out"></i><span>Logout</span></a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR WRAPPER -->

        <div class="content container-fluid">
        <!-- Body! -->
            @yield('content')
        </div>


    </div>
</div>
<!-- END CONTENT WRAPPER -->

<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="../assets/vendor/ckeditor/ckeditor.js"></script>
<script src="../assets/vendor/modernizr/modernizr.custom.js"></script>
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-storage/js.storage.js"></script>
<script src="../assets/vendor/js-cookie/src/js.cookie.js"></script>
<script src="../assets/vendor/pace/pace.js"></script>
<script src="../assets/vendor/metismenu/dist/metisMenu.js"></script>
<script src="../assets/vendor/switchery-npm/index.js"></script>
<script src="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- ================== PAGE LEVEL VENDOR SCRIPTS ==================-->

<script src="../assets/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/vendor/jquery-validation/additional-methods.min.js"></script>
<script src="../assets/vendor/jquery-steps/jquery.steps.min.js"></script>
<script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="../assets/vendor/ckeditor/ckeditor.js"></script>
<script src="../assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="../assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- ================== PAGE LEVEL VENDOR SCRIPTS ==================-->

<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="../assets/js/global/app.js"></script>
<!-- ================== PAGE LEVEL APP SCRIPTS ==================-->
<script src="../assets/js/components/vertical-wizard-init.js"></script>
<script>
    setTimeout(function(){ CKEDITOR.replace( 'editor12' ); },400);
    setTimeout(function(){ CKEDITOR.replace( 'editor13' ); },400);

</script>
<script src="../assets/js/components/bootstrap-datepicker-init.js"></script>
<script src="../assets/js/components/bootstrap-date-range-picker-init.js"></script>

</body>

</html>