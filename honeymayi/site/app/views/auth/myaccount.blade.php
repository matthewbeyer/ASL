<?php $customCss = ["login", "animate-custom"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
My Account | Honey May I
@stop

@section('content')

<!-- start Login box -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <h3 class="animated bounceInDown">My Account</h3>
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
                    </div>
                    @endif
                    {{ Form::open(array('url' => 'myaccount')) }}
                        {{ Form::text('firstname', Input::old('firstname'), ['placeholder' => 'First Name']) }}
                        {{ Form::text('surname', Input::old('surname'), ['placeholder' => 'Surname']) }}
                        {{ Form::text('username', Input::old('username'), ['placeholder' => 'Username', 'disabled']) }}
                        {{ Form::email('email', Input::old('email'), ['placeholder' => 'Email Address']) }}
                        {{ Form::password('password', ['placeholder' => 'Password']) }}
                        {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password']) }}
                        {{ Form::submit('Update', ['class' => 'btn btn-login']) }}
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

<!-- End Login box -->
<footer class="container">
    <p id="footer-text"><small>Copyright &copy; 2014 <a href="http://www.beyerbuilds.com">Beyer Builds</a></small></p>
</footer>

@stop