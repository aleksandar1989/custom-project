<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page not found</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Csrf token -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('admin_tmpl/css/fonts/googlefonts.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('admin_tmpl/css/components.css') }}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/plugins.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/pages/error.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="shortcut icon" href="{{ asset('admin_tmpl/images/favicon.png') }}"/>

</head>
<!-- END HEAD -->

<body class=" page-404-3">
    <div class="page-inner">
        <img src="{{ asset('admin_tmpl/images/earth.jpg') }}" class="img-responsive" alt="">
    </div>
    <div class="container error-404">
        <h1>404</h1>
        <h2>We have a problem.</h2>
        <p> Actually, the page you are looking for does not exist. </p>
        <p>
            <a href="/" class="btn yellow-mint btn-outline"> Return home </a>
            <br> </p>
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


    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('admin_tmpl/js/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
</body>

</html>