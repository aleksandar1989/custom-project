<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laracus | Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Csrf token -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_tmpl/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('admin_tmpl/css/daterangepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('admin_tmpl/css/components.css') }}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/plugins.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    @yield('header')
</head>
{{--<body>--}}

@yield('content')

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
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('admin_tmpl/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_tmpl/js/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
@yield('footer')
</body>

</html>