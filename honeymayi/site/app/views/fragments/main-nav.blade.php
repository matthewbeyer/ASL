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
                    <a href="{{ URL::route('honeys') }}">Honeys</a>
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