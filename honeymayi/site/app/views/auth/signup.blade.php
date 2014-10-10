<?php $customCss = ["login", "animate-custom"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
Sign Up | HoneyMayI
@stop

@section('content')

<!-- start Login box -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <h3 class="animated bounceInDown">"Honey May I"</h3>
            <div class="login-box clearfix animated flipInY">
                <div class="login-logo">
                    <a href="/"><img src="/images/hmilogo.png" alt="Honey May I" /></a>
                </div>
                <hr />
                <div class="login-form">
                    @if( $errors->count() > 0 )
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Error!</h4>
                        {{ $errors->first('general') }}
                        {{ $errors->first('firstname') }}
                        {{ $errors->first('surname') }}
                        {{ $errors->first('username') }}
                        {{ $errors->first('email') }}
                        {{ $errors->first('password') }}
                        {{ $errors->first('terms') }}
                    </div>
                    @endif
                    {{ Form::open(array('url' => 'signup')) }}
                        {{ Form::text('firstname', Input::old('firstname'), ['placeholder' => 'First Name', 'required']) }}
                        {{ Form::text('surname', Input::old('surname'), ['placeholder' => 'Surname', 'required']) }}
                        {{ Form::text('username', Input::old('username'), ['placeholder' => 'Username', 'required']) }}
                        {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required']) }}
                        {{ Form::password('password', ['placeholder' => 'Password', 'required']) }}
                        {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'required']) }}
                        <label class="checkbox">
                            {{ Form::checkbox('terms', 'agree') }} &nbsp; I agree to the terms.
                        </label>
                        {{ Form::submit('Join Now', ['class' => 'btn btn-login']) }}
                    {{ Form::close() }}
                    <h3>Connect Via Social Media</h3>
                    <div class="social-login row">
                        <div class="fb-login col-lg-4 col-md-12 animated flipInX">
                            <a href="{{ URL::route('fblogin') }}" class="btn btn-facebook btn-block"><strong>Facebook</strong></a>
                        </div>
                        <div class="twit-login col-lg-4 col-md-12 animated flipInX">
                            <a href="#" class="btn btn-twitter btn-block"><strong>Twitter</strong></a>
                        </div>
                        <div class="google-login col-lg-4 col-md-12 animated flipInX">
                            <a href="#" class="btn btn-google btn-block"><strong>Google +</strong></a>
                        </div>
                    </div>

                    <div class="login-links">
                        <a href="{{ URL::route('forgot') }}">
                            Forgot password?
                        </a>
                        <br />
                        <a href="{{ URL::route('login') }}">
                            Already have an account? <strong>LOGIN</strong>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- End Login box -->
<footer class="container">
    <p id="footer-text"><small>Copyright &copy; 2014 <a href="www.beyerbuilds.com">Beyer Builds</a></small></p>
</footer>

@stop