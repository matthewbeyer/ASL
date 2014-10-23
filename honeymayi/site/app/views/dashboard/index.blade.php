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
    "questions"
];
?>
@extends('layout')

@section('title')
Dashboard | Honey May I
@stop

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


@include('fragments.main-nav')

<!-- ==============================================
HEADER 2
=============================================== -->
<header id="dashboard" class="container text-center">


    <p class="welcome">{{ Auth::user()->firstname }}, welcome to</p>

    <h1>"HONEY MAY I"</h1>

    @if (Auth::user()->honeyCount() == 0)
    <p class="alert alert-info alert-dashboard">
        You have no honeys :(<br />
        Why not <a href="{{ URL::route('honeyAdd') }}">add one</a>?
    </p>
    @endif

    <h2>Inbox</h2>
    <?php $pendingQuestionsCount = QuestionAsked::pendingForUserCount(Auth::user()); ?>
    <p>
        You have {{ $pendingQuestionsCount }} pending
        {{ Lang::choice('question.questions', $pendingQuestionsCount) }}
        in your <a href="{{ URL::route('questions.inbox') }}">inbox</a>.
    </p>
    <hr />

    <h2>Overall Statistics</h2>

    <p class="birdsEyeStats">
        You have asked {{ $totalQuestionsAsked }}
        {{ Lang::choice('question.questions', $totalQuestionsAsked) }} and
        answered {{ $totalQuestionsAnswered }}
        {{ Lang::choice('question.questions', $totalQuestionsAnswered) }}
        since joining on
        {{ Auth::user()->created_at->format('jS F Y') }}
        <br />
    </p>

    <div class="row">
        <div class="col-md-6">
            <strong>Overall Statistics for All Questions Answered</strong><br />
            <div class="progress questionProgressBar">
                @if ($totalQuestionsAnswered != 0)
                <div class="progress-bar progress-bar-success" style="width: {{ $overallAnsweredYesPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-up"></span>
                        {{ $overallAnsweredYesPercentage }}%
                        ({{ $overallAnsweredYes }}
                        {{ Lang::choice('question.answers', $overallAnsweredYes) }})
                    </span>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{ $overallAnsweredNoPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-down"></span>
                        {{ $overallAnsweredNoPercentage }}%
                        ({{ $overallAnsweredNo }}
                        {{ Lang::choice('question.answers', $overallAnsweredNo) }})
                    </span>
                </div>
                @else
                <div class="progress-bar progress-bar-warning" style="width: 100%">
                    <span>
                        You have not answered any questions yet.
                    </span>
                </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <strong>Overall Statistics for All Questions Asked</strong>
            <div class="progress questionProgressBar">
            @if ($totalQuestionsAsked != 0)
                <div class="progress-bar progress-bar-success" style="width: {{ $overallAskedYesPercentage }}%">
                        <span>
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                            {{ $overallAskedYesPercentage }}%
                            ({{ $overallAskedYes }}
                            {{ Lang::choice('question.answers', $overallAskedYes) }})
                        </span>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{ $overallAskedNoPercentage }}%">
                        <span>
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                            {{ $overallAskedNoPercentage }}%
                            ({{ $overallAskedNo }}
                            {{ Lang::choice('question.answers', $overallAskedNo) }})
                        </span>
                </div>
            </div>
            @else
            <div class="progress-bar progress-bar-warning" style="width: 100%">
                <span>
                    You have not answered any questions yet or they are still pending.
                </span>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h2>Your Top 5 Most Asked</h2>
            @include('fragments.topQuestions', ['topQuestions' => Question::top5(Auth::user())])
        </div>
    </div>

</header><!--End header -->

@stop