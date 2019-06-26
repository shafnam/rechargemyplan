@extends('layouts.app')

@section('content')
<section id="login">
    <div class="shadow-overlay"></div>
        <div class="sdcontainer">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>Register</h4>
                                </div>                                
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Register Form-->
                                    <form role="form" class="login-from form-signin" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">                                            
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required autofocus>
            
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required>
            
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif                                           
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            
                                        </div>

                                        <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>
                                        </div>

                                        <input type="hidden" name="registration_form" value="1">
                
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" class="btn btn-login button large login">
                                                    Register
                                                </button>                 
                                            </div>
                                        </div>

                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </section>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
