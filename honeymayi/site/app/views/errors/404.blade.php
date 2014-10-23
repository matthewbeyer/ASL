<?php $customJs  = [
    "jquery.scrollto",
    "waypoints.min",
    "jquery.masonry.min",
    "jquery.flexslider.min",
    "jquery.backstretch.min",
    "twitterFetcher_v10_min",
    "contact",
    "scripts"
];
$customCss = [
    "dashboard",
];
?>
@extends('layout')

@section('title')
Not Found | Honey May I
@stop

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


@include('fragments.main-nav')

<div id="dashboard" class="container text-center">
    <h1>Not Found</h1>
    <p>The specified resource could not be found :(</p>
    <p>
        <a href="{{ URL::to('') }}">&larr; Back Home</a>
    </p>
</div>

@stop