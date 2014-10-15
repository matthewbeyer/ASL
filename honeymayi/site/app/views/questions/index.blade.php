<?php $customJs  = [
    "jquery.scrollto",
    "waypoints.min",
    "jquery.masonry.min",
    "jquery.flexslider.min",
    "jquery.backstretch.min",
    "twitterFetcher_v10_min",
    "contact",
    "scripts"
]; ?>
@extends('layout')

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


<!-- ==============================================
MAIN NAV
=============================================== -->
<div id="main-nav" class="navbar navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-nav">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>

            <!-- ======= LOGO ========-->
            <a class="navbar-brand" href="{{ URL::to('') }}"><img src="/images/hmilogo.png" alt=""/>"Honey May I"</a>

        </div>

        <div id="site-nav" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="sr-only">
                    <a href="{{ URL::to('') }}">Home</a>
                <li>
                    <a href="#faq">FAQ's</a>
                </li>
                <li>
                    <a href="#honeys">Honeys</a>
                </li>
                <li>
                    <a href="{{ URL::route('myaccount') }}" >My Account</a>
                </li>
                <li>
                    <a href="{{ URL::to('logout') }}">Logout</a>
                </li>
            </ul>
        </div><!--End navbar-collapse -->

    </div><!--End container -->

</div><!--End main-nav -->

<!-- ==============================================
HEADER 2
=============================================== -->
<header id="home">

    <div class="container text-center">

        <p>{{ Auth::user()->firstname }}, welcome to</p>

        <h1>"HONEY MAY I"</h1>

        <p>This is your dashboard, but I haven't got round to writing it yet. Coming soon!</p>

        <!--
        <table class="table">
            <tr>
                <th></th>
            </tr>
        </table>
        -->

    </div>

</header><!--End header -->

@stop