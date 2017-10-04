<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laracus | @yield(('title'))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Csrf token -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('admin_tmpl/css/fonts/googlefonts.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('admin_tmpl/css/daterangepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/morris.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('admin_tmpl/css/components.css') }}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/plugins.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('admin_tmpl/css/layout.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/darkblue.min.css') }}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{ asset('admin_tmpl/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('admin_tmpl/images/favicon.png') }}"/>

    @yield('header')
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        @include('admin.partials.header')
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
    @include('admin.partials.sidebar')

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
    </div>

    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('admin_tmpl/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.slimscroll.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/bootstrap-switch.min.js') }}"
            type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('admin_tmpl/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/daterangepicker.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.easypiechart.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/toastr.min.js') }}" type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('admin_tmpl/js/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('admin_tmpl/js/dashboard.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{ asset('admin_tmpl/js/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/demo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/quick-nav.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/table-datatables-colreorder.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/custom.js') }}" type="text/javascript"></script>
    @yield('footer')

    @include('admin.notification.alert')
</body>

</html>