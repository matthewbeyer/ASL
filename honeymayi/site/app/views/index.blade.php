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
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- ======= LOGO ========-->
                <a class="navbar-brand scrollto" href="/"><img src="/images/hmilogo.png" alt="Honey May I" />"Honey May I"</a>

            </div>

            <div id="site-nav" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="sr-only">
                        <a href="#home" class="scrollto">Home</a>
                    </li>
                    <li>
                        <a href="#services" class="scrollto">What We Do</a>
                    </li>
                    <li>
                        <a href="#about" class="scrollto">About Us</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('signup') }}">Join</a>
                    </li>
                </ul>
            </div><!--End navbar-collapse -->

        </div><!--End container -->

    </div><!--End main-nav -->

    <!-- ==============================================
    HEADER
    =============================================== -->
    <header id="home">

        <div class="container text-center">

            <p>Welcome to</p>

            <h1>"HONEY MAY I"</h1>

            <p>It's not because you have to ask, it's because you value their opinion.</p>

        </div>

    </header><!--End header -->

    <!-- ==============================================
    SERVICES
    =============================================== -->
    <section id="services" class="add-padding">

        <div class="container">

            <h1 class="section-title big-text scrollimation fade-up">What We Do</h1>

            <div class="row">

                <div class="col-sm-4 service-item color3 scrollimation scale-in">

                    <div class="service-icon"><i class="fa fa-heart-o"></i></div>

                    <h3>We Make Your Life Easier</h3>

                    <p>Simply asking your partner permission to do something shows them that you love and appreciate their opinion.</p>


                </div>

                <div class="col-sm-4 service-item color1 scrollimation scale-in d1">

                    <div class="service-icon"><i class="fa fa-save"></i></div>

                    <h3>We Keep Track</h3>

                    <p>We securely store your questions and answers.  This can be used for both the power of good and evil.  Will let you decide how to use this information...</p>


                </div>

                <div class="col-sm-4 service-item color2 scrollimation scale-in d2">

                    <div class="service-icon"><i class="fa fa-smile-o"></i></div>

                    <h3>Keeping Each Other Happy</h3>

                    <p>The ultimate goal of this app is to provide a fun way for you to get input from your partner.  Whether it be "Honey May I" buy these shoes? Or "Honey may I" go to the pub after work?</p>

                </div>

            </div>

        </div>

    </section>

    <!-- ==============================================
    ABOUT
    =============================================== -->
    <section id="about" class="add-padding bg-color2">

        <div class="container">

            <div class="row">

                <div class="col-sm-6 scrollimation fade-right d1">

                    <img class="img-responsive polaroid" src="/images/Me.jpg" alt="" />

                </div>

                <div class="col-sm-6 scrollimation fade-left d3">

                    <h1 class="big-text">I am <br/>Matthew Beyer </h1>

                    <p class="lead">I am Matthew Beyer, a thirty year old aspiring web developer living in Guatemala. I built this web application because I am always getting my wifes "permission" before I do things and vice a versa. I thought this would be a cute way for both of us and all of you people to keep tabs. Better relationships through better communication !!!</p>

                </div>

            </div>

        </div>

    </section>

    <!-- ==============================================
    FOOTER
    =============================================== -->

    <footer id="main-footer" class="add-padding bg-color3 border-top-color2">

        <div class="container">

            <ul class="social-links text-center">
                <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
                <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
                <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
            </ul>

            <p class="text-center">&copy; 2014 - All rights reserved</p>
            <p class="text-center"><a href="http://www.beyerbuilds.com" target="_blank">Honey May I</a></p>

        </div>

    </footer>



@stop