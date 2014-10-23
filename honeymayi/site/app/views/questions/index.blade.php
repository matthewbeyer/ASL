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
Questions | Honey May I
@stop

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


@include('fragments.main-nav')

<!-- ==============================================
HEADER 2
=============================================== -->
<div id="dashboard">

    <div class="container text-center">

        <h1>Questions</h1>

        <h2>Your Top 5 Most Asked</h2>
        @include('fragments.topQuestions', ['topQuestions' => $top5Questions])

        <h2>Your Questions</h2>
        <section class="questions">
            @if (count($userQuestions) == 0)
            <p>
                You have no custom questions.
                Why not <a href="{{ URL::route('questions.create') }}">create</a> one?
            </p>
            @else
            <a class="btn btn-default rightBtn" href="{{ URL::route('questions.create') }}">Create</a>
            <div class="clearfix"></div>
            <table class="table text-left">
                <tr>
                    <th>Honey May I...</th>
                    <th>Stats</th>
                    <th>Actions</th>
                </tr>
                @foreach ($userQuestions as $question)
                <tr>
                    <td>
                        <a href="{{ URL::route('questions.show', ['question' => $question->id]) }}">
                            {{ $question->question }}
                        </a>
                    </td>
                    <td>
                        <span class="statYes">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                            {{ $question->personalYesAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span><br />
                        <span class="statNo">
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                            {{ $question->personalNoAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span>
                    </td>
                    <td>
                        <a href="{{ URL::route('questions.ask', ['question' => $question->id]) }}">
                            ASK
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif

            <h2>Default Questions</h2>
            <table class="table text-left">
                <tr>
                    <th>Honey May I...</th>
                    <th>Stats</th>
                    <th>Actions</th>
                </tr>
                @foreach ($defaultQuestions as $question)
                <tr>
                    <td>
                        <a href="{{ URL::route('questions.show', ['question' => $question->id]) }}">
                            {{ $question->question }}
                        </a>
                    </td>
                    <td>
                        <span class="statYes">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                            {{ $question->personalYesAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span><br />
                        <span class="statNo">
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                            {{ $question->personalNoAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span>
                    </td>
                    <td>
                        <a href="{{ URL::route('questions.ask', ['question' => $question->id]) }}">
                            ASK
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </section>

    </div>

</div>

@stop