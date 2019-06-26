@extends('layouts.master')

@section('content')
    <div class="container" style="height: 769px;">
        <div class="login-box" style="margin: 13% auto;">
            <div class="login-logo">
                <img src="{{URL::asset('/images/recharge-my-plan-logo.png')}}" alt="RMP" height="28" width="200">
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('admin.login.submit') }}" method="post">
                    {{ csrf_field() }}
    
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control"
                                placeholder="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <!--<div class="col-xs-8">
                            <div class="checkbox icheck" style="margin-left: 20px;">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>-->
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="auth-links">
                    <br>
                    <a href="{{ route('admin.password.request') }}" class="text-center">Forgot Your Password?</a>
                </div>
            </div>
            <!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </div>
@endsection
