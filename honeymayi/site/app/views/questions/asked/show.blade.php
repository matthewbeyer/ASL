<?php $customJs  = [
    "jquery.scrollto",
    "waypoints.min",
    "jquery.masonry.min",
    "jquery.flexslider.min",
    "jquery.backstretch.min",
    "twitterFetcher_v10_min",
    "contact",
    "scripts",
];
$customCss = [
    "dashboard",
    "questions"
];
$customOGMeta = [
    'fb:app_id' => '783560558354464',
    'og:title'  => $questionAsked->question->question,
    'og:image'  => "https://fbstatic-a.akamaihd.net/images/devsite/attachment_blank.png",
    'og:url'    => Request::url(),
    'og:type'   => 'honeymayi:question'
];
?>
@extends('layout')


@section('title')
Question Info | Honey May I
@stop

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


@include('fragments.main-nav')

<!-- ==============================================
HEADER 2
=============================================== -->
<div id="dashboard" class="container text-center">

    <div class="row">
        <div class="col-xs-12">
            <p class="questionHoneyMayI">Honey May I...</p>
            <h1 class="question">{{ $questionAsked->question->question }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p class="birdsEyeStats
            @if (is_null($questionAsked->answer))
            statNeutral-bg
            @else
            stat{{ ($questionAsked->answer == false) ? 'No' : 'Yes' }}-bg
            @endif
            ">
                {{ $questionAsked->asker->firstname }} {{ $questionAsked->asker->surname }}
                (<b>{{ $questionAsked->asker->username }}</b>) asked on
                {{ $questionAsked->created_at->toDayDateTimeString() }}
                <br />
                {{ $questionAsked->askee->firstname }} {{ $questionAsked->askee->surname }}
                (<b>{{ $questionAsked->askee->username }}</b>)
                @if (!is_null($questionAsked->answer))
                said
                <b>{{ ($questionAsked->answer == false) ? 'no' : 'yes' }}</b>
                on
                {{ $questionAsked->updated_at->toDayDateTimeString() }}
                @else
                has not answered yet.
                @endif
            </p>
        </div>
    </div>

    @if (Auth::check() && Auth::user() == $questionAsked->askee)
        <div class="row">
            <div class="col-xs-12">
                <h2>Sharing</h2>
                <span class="fa fa-facebook"></span>
            </div>
        </div>
    @endif

    <p>
        <a href="{{ URL::to('') }}">&larr; Home</a>
    </p>

</div>

@stop