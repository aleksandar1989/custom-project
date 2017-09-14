@extends('auth.layout')

@section('header')
    <link href="{{ asset('admin_tmpl/css/login.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!-- BEGIN LOGO -->
    <div class="login">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('admin_tmpl/images/logo-big.png') }}" alt=""/> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN REGISTRATION FORM -->
            <form class="reset-form"  method="POST" action="{{ route('password.request') }}"">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <h3>Reset Password</h3>
                <p> Enter your new password below: </p>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                               id="password" placeholder="Password" name="password" required/>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                    <div class="controls">
                        <div class="input-icon">
                            <i class="fa fa-check"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                                   placeholder="Confirm Password" name="password_confirmation"/>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" id="register-submit-btn" class="btn blue-madison"> Reset Password</button>
                </div>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> <?= date('Y') ?> &copy; Laracus - Reset your password page</div>
    </div>
@endsection


@section('footer')
    <script src="{{ asset('admin_tmpl/js/jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/login.js') }}" type="text/javascript"></script>
@endsection