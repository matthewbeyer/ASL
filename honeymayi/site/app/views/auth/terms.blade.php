<?php $customCss = ["login", "animate-custom"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
Terms | Honey May I
@stop

@section('content')

<!-- start Login box -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
            <h3 class="animated bounceInDown">Terms and Conditions</h3>
            <div class="login-box terms clearfix animated flipInY">
                <div class="login-logo">
                    <a href="/"><img src="/images/hmilogo.png" alt="Honey May I" /></a>
                </div>
                <hr />
                <p>
                    Foo bar baz...
                </p>
            </div>

        </div>
    </div>
</div>

<!-- End Login box -->
<footer class="container">
    <p id="footer-text"><small>Copyright &copy; 2014 <a href="http://www.beyerbuilds.com">Beyer Builds</a></small></p>
</footer>

@stop