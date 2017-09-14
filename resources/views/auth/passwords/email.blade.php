@extends('auth.layout')

@section('header')
    <link href="{{ asset('admin_tmpl/css/login.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!-- BEGIN LOGO -->
    <div class="login">
        <div class="logo">
            <a href="index.html">
                <img src="{{ asset('admin_tmpl/images/logo-big.png') }}" alt=""/> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <h3>Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off"
                               placeholder="Email" name="email" value="{{ old('email') }}" required/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ url('/login') }}" class="btn red btn-outline">Back</a>
                    <button type="submit" class="btn green pull-right"> Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> <?= date('Y') ?> &copy; Laracus - Reset your password page</div>
    </div>
@endsection


@section('footer')
    <script src="{{ asset('admin_tmpl/js/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/login.js') }}" type="text/javascript"></script>
@endsection