<?php $customJs  = [
    "jquery.scrollto",
    "waypoints.min",
    "jquery.masonry.min",
    "jquery.flexslider.min",
    "jquery.backstretch.min",
    "twitterFetcher_v10_min",
    "contact",
    "scripts",
    "restfulise"
];
$customCss = [
    "dashboard",
    "questions"
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
            <h1 class="question">{{ $question->question }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p class="birdsEyeStats">
                Answered {{ $question->personalAnswerCount(Auth::user()) }}
                {{ Lang::choice('question.times', $question->personalAnswerCount(Auth::user(), $user)) }} by

                {{ $user->username }}
            </p>
        </div>
    </div>

    <strong>Statistics for {{ $user->username }}</strong>
    <div class="row">
        <div class="col-xs-12">
            <div class="progress questionProgressBar">
                @if ($question->personalAnswerCount(Auth::user(), $user) != 0)
                <?php $yesPercentage = $question->personalYesAnswerCountAsDecimal(Auth::user(), $user)*100;
                      $noPercentage  = $question->personalNoAnswerCountAsDecimal(Auth::user(), $user)*100; ?>
                <div class="progress-bar progress-bar-success" style="width: {{ $yesPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-up"></span>
                        {{ $yesPercentage }}%
                        ({{ $question->personalYesAnswerCount(Auth::user(), $user) }}
                        {{ Lang::choice('question.answers', $question->personalYesAnswerCount(Auth::user(), $user)) }})
                    </span>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{ $noPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-down"></span>
                        {{ $noPercentage }}%
                        ({{ $question->personalNoAnswerCount(Auth::user(), $user) }}
                        {{ Lang::choice('question.answers', $question->personalNoAnswerCount(Auth::user(), $user)) }})
                    </span>
                </div>
            </div>
            @else
            <div class="progress-bar progress-bar-warning" style="width: 100%">
                    <span>
                        Question not answered yet by {{ $user->username }}
                    </span>
            </div>
            @endif
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-8">
            <h2>Answers to this question by {{ $user->username }}</h2>
            @if ($question->questionsAskedAnswered($user)->count() == 0)
            <p>
                This Question has not been answered yet by this user.
            </p>
            @else
            <table class="table">
                <tr>
                    <th>Username</th>
                    <th>Question Message</th>
                    <th>Answer</th>
                    <th>Answered</th>
                </tr>
                @foreach ($question->questionsAskedAnswered($user)->get() as $questionAsked)
                    <tr>
                        <td>
                            {{ $questionAsked->askee->username }}
                        </td>
                        <td>
                            {{ $questionAsked->message }}
                        </td>
                        <td>
                            {{ ($questionAsked->answer)
                            ? '<span class="statYes">YES</span>'
                            : '<span class="statNo">NO</span>' }}
                        </td>
                        <td>
                            {{ $questionAsked->updated_at->toDayDateTimeString() }}
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>
        <div class="col-md-4">
            <h2>Pending an Answer</h2>
            @if ($question->questionsAskedNotAnswered($user)->count() == 0)
            <p>
                This Question does not have any pending asks for this user.
            </p>
            @else
            <table class="table">
                <tr>
                    <th>Username</th>
                    <th>Question Message</th>
                </tr>
                @foreach ($question->questionsAskedNotAnswered($user)->get() as $questionAsked)
                <tr>
                    <td>
                        {{ $questionAsked->askee->username }}
                    </td>
                    <td>
                        {{ $questionAsked->message }}
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
    <hr />
    <p>
        <!--This should be broken down by user (and at /questions/{question}/answers/{user}),
        have recent questions and answers in a table,
        and more...-->
    </p>
    <p>
        <a href="{{ URL::route('questions.show', ['question' => $question->id]) }}">&larr; Back The Question</a>
    </p>

</div>

@stop