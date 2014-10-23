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
            <a href="{{ URL::route('questions.ask', ['question' => $question->id]) }}"
               class="btn btn-default pull-right">
                Ask
            </a>
            @if ($question->canBeDestroyedBy(Auth::user()))
            <a href="{{ URL::route('questions.destroy', ['question' => $question->id]) }}"
               class="btn btn-danger pull-left"
               data-method="delete"
               data-confirm="Are you sure you want to do this? All answers and statistics for this question will also be deleted and you CANNOT undo it.">
                Delete
            </a>
            @endif
            <div class="clearfix"></div>
            <h1 class="question">{{ $question->question }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p class="birdsEyeStats">
                Answered {{ $question->personalAnswerCount(Auth::user()) }}
                {{ Lang::choice('question.times', $question->personalAnswerCount(Auth::user())) }} by

                {{ $question->personalHoneysAnsweredCount(Auth::user()) }}
                {{ Lang::choice('question.people', $question->personalHoneysAnsweredCount(Auth::user())) }}
            </p>
        </div>
    </div>

    <strong>Overall Statistics</strong>
    <div class="row">
        <div class="col-xs-12">
            <div class="progress questionProgressBar">
                @if ($question->personalAnswerCount(Auth::user()) != 0)
                <?php $yesPercentage = $question->personalYesAnswerCountAsDecimal(Auth::user())*100;
                      $noPercentage  = $question->personalNoAnswerCountAsDecimal(Auth::user())*100; ?>
                <div class="progress-bar progress-bar-success" style="width: {{ $yesPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-up"></span>
                        {{ $yesPercentage }}%
                        ({{ $question->personalYesAnswerCount(Auth::user()) }}
                        {{ Lang::choice('question.answers', $question->personalYesAnswerCount(Auth::user())) }})
                    </span>
                </div>
                <div class="progress-bar progress-bar-danger" style="width: {{ $noPercentage }}%">
                    <span>
                        <span class="glyphicon glyphicon-thumbs-down"></span>
                        {{ $noPercentage }}%
                        ({{ $question->personalNoAnswerCount(Auth::user()) }}
                        {{ Lang::choice('question.answers', $question->personalNoAnswerCount(Auth::user())) }})
                    </span>
                </div>
            </div>
            @else
            <div class="progress-bar progress-bar-warning" style="width: 100%">
                    <span>
                        Question not answered yet.
                    </span>
            </div>
            @endif
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-8">
            <h2>Answers to this question</h2>
            <small>(Click a Honey's username to view more detail)</small>
            @if (count($question->questionsAskedAnswered) == 0)
            <p>
                This Question has not been answered yet.
            </p>
            @else
            <table class="table">
                <tr>
                    <th>Username</th>
                    <th>Question Message</th>
                    <th>Answer</th>
                    <th>Answered</th>
                </tr>
                @foreach ($question->questionsAskedAnswered as $questionAsked)
                    <tr>
                        <td>
                            <a href="{{ URL::route('questions.users.show', ['question' => $question->id, 'user' => $questionAsked->askee->id]) }}">
                                {{ $questionAsked->askee->username }}
                            </a>
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
            @if (count($question->questionsAskedNotAnswered) == 0)
            <p>
                This Question does not have any pending asks.
            </p>
            @else
            <table class="table">
                <tr>
                    <th>Username</th>
                    <th>Question Message</th>
                </tr>
                @foreach ($question->questionsAskedNotAnswered as $questionAsked)
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
        <a href="{{ URL::route('questions.index') }}">&larr; Back to All Questions</a>
    </p>

</div>

@stop