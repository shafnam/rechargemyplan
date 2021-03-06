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
                                    <h4>Login</h4>
								</div>
								
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<!-- Login Form-->
                                    <form role="form" class="login-from form-signin" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">                                            
                                            <input id="email" type="email" class="form-control" name="email" placeholder="email" value="{{ old('email') }}" required autofocus>
            
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
                
                                        <!--<div class="form-group">
                                            <div class="col-md-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>-->
                
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button type="submit" class="btn btn-login button large login">
                                                    Login
                                                </button>                 
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    Forgot Your Password?
                                                </a>
                                            </div>

                                            <div class="col-lg-12 text-center">
                                                <a class="btn btn-link" href="{{ route('register') }}">
                                                    New Customer? Signup now
                                                </a>
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
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
