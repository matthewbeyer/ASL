<?php $customCss = ["login", "animate-custom"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
Reset Password | Honey May I
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
                    </div>
                    @endif
                    {{ Form::open(array('url' => 'forgot')) }}
                        {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address', 'required']) }}
                        {{ Form::submit('Reset Password', ['class' => 'btn btn-login btn-reset']) }}
                    {{ Form::close() }}
                    <div class="login-links">
                        <a href="{{ URL::to('login') }}">
                            Remembered your password?  <strong>LOGIN</strong>
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