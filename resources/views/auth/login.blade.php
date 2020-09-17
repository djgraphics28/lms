@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #d2d6de!important;
    }
</style>
<div class="container text-center">

    <div class="login-box">
        <div class="login-logo" style="margin-bottom:0px!important;">
          <a href="{{ url('/') }}"><span style="font-size:18px;"><b>Welcome</b></span></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf

            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="social-auth-links text-center">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

</div>
@endsection
