<!DOCTYPE html>
<html lang="en-US" class="no-js" xmlns="http://www.w3.org/1999/html">
<head>
    <title>@yield('title', 'Honey May I')</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/images/favicon.ico" />

    <!-- ==============================================
    CSS
    =============================================== -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/flexslider.css" />
    <link rel="stylesheet" href="/css/styles.css" />

    @if (!empty($customCss))
    <!-- Custom CSS for this template -->
        @if (is_string($customCss))
            <link rel="stylesheet" href="/css/{{ $customCss }}.css" />
        @elseif (is_array($customCss))
            @foreach ($customCss as $file)
            <link rel="stylesheet" href="/css/{{ $file }}.css" />
            @endforeach
        @endif
    @endif

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,500,600,700' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
    <script src="/js/libs/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/js/libs/modernizr.min.js"></script>
</head>
<body data-spy="scroll" data-target="#main-nav" data-offset="200">
    @if(Session::has('flash'))
    <div class="alert alert-dismissable alert-{{ Session::get('alert-type', 'info') }}" id="flashmsg">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p>{{ Session::get('alert-message') }}</p>
    </div>
    @endif

    @yield('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="/js/bootstrap.min.js"></script>

    <script>
        if ($("#flashmsg p").html() != '') {
            $("#flashmsg").slideDown(function() {
                setTimeout(function() {
                    $("#flashmsg").slideUp();
                }, 5000);
            });
        }
    </script>

    @if (!empty($customJs))
    <!-- Custom JS for this template -->
    @if (is_string($customJs))
    <script src="/js/{{ $customJs }}.js"></script>
    @elseif (is_array($customJs))
    @foreach ($customJs as $file)
    <script src="/js/{{ $file }}.js"></script>
    @endforeach
    @endif
    @endif
</body>
</html>