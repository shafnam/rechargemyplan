@extends('layouts.app')

@section('content')
<!-- Contact Section
   ================================================== -->
   <section id="contact" class="contact-page"> 
    <div class="row contactf-intro">
        <div class="col-twelve with-bottom-line">

            @if(session()->has('success_messge'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session()->get('success_messge') }}</li>
                    </ul>
                </div>
            @endif

            <h1>Contact Us</h1>
            <p class="lead">
                RechargeMyPlan™ is the ideal way to add plans to any number for the major carriers available in the USA. 
            </p>
            <h3>Contact us to know more information.</h3>

        </div>
        <div class="col-twelve with-bottom-line">
            <div style="padding: 15px;">
                <form class="form-horizontal" method="POST" action="{{ route('contactus') }}">
                    {{ csrf_field() }}

                    <div class="row{{ $errors->has('fullname') ? ' has-error' : '' }}">
                        <div class="col-md-6 form-group">
                            <label>Full Name*</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname') }}" autofocus>
                            @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-6 form-group">
                            <label>Email*</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row{{ $errors->has('message') ? ' has-error' : '' }}">
                        <div class="col-md-6 form-group">
                            <label>Message*</label>
                            <textarea id="message" class="form-control" name="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="col-md-6 form-group">
                            <label for="ReCaptcha">Recaptcha:</label>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}                            
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" name="contact_form" value="1">

                    <div class="row form-group">                        
                        <button type="submit" class="button large checkout col-md-2" style="width: 47%;">
                            Send Message
                        </button>                        
                    </div>

                    {{-- <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                        <label for="fullname" class="col-md-4 control-label">Full Name</label>

                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" autofocus>
                            @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}        

                    
                </form>           
                
            </div>
        
        </div> 
    </div>

</section> <!-- /contact-->

@endsection