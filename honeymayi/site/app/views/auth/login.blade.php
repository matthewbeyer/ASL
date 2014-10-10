<?php $customCss = ["login", "animate-custom"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
Login | Honey May I
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
                        {{ $errors->first('email') }}
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                    {{ Form::open(array('url' => 'login')) }}
                        {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required']) }}
                        {{ Form::password('password', ['placeholder' => 'Password', 'required']) }}
                        {{ Form::submit('Login', ['class' => 'btn btn-login']) }}
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
                        <a href="{{ URL::to('forgot') }}">
                            Forgot password?
                        </a>
                        <br />
                        <a href="{{ URL::to('signup') }}">
                            Don't have an account? <strong>JOIN NOW</strong>
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