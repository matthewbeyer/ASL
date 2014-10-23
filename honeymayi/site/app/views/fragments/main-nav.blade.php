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
                </li>
                @if (Auth::check())
                <li>
                    <a href="{{ URL::to('dashboard') }}">
                        Dashboard
                        @if (QuestionAsked::pendingForUserCount(Auth::user()) > 0)
                            ({{ QuestionAsked::pendingForUserCount(Auth::user()) }})
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('questions.index') }}">Questions</a>
                </li>
                <li>
                    <a href="{{ URL::route('honeys') }}">
                        Honeys
                        @if (Auth::user()->requestCount() > 0)
                            ({{ Auth::user()->requestCount() }})
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ URL::route('myaccount') }}" >My Account</a>
                </li>
                <li>
                    <a href="{{ URL::to('logout') }}">Logout</a>
                </li>
                @else
                <li>
                    <a href="{{ URL::to('') }}">Home</a>
                </li>
                <li>
                    <a href="{{ URL::route('login') }}">Login</a>
                </li>
                <li>
                    <a href="{{ URL::route('signup') }}">Join</a>
                </li>
                @endif
            </ul>
        </div><!--End navbar-collapse -->

    </div><!--End container -->

</div><!--End main-nav -->