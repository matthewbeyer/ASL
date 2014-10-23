<?php $customJs  = [
    "jquery.scrollto",
    "waypoints.min",
    "jquery.masonry.min",
    "jquery.flexslider.min",
    "jquery.backstretch.min",
    "twitterFetcher_v10_min",
    "contact",
    "scripts",
    "HMI_questionSharer"
];
$customCss = [
    "dashboard",
    "questions",
    "font-awesome.min"
];
?>
@extends('layout')


@section('title')
Questions Answered | Honey May I
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
        <h1>Questions Answered</h1>
        <div class="col-xs-12">
            @if ($questionsAnswered->count() == 0)
            <p>
                You have not answered any question yet. :(
            </p>
            @else
            <table class="table">
                <tr>
                    <th>Asked by</th>
                    <th>Question</th>
                    <th>Message</th>
                    <th>Answer</th>
                    <th>Answered</th>
                    <th>Share</th>
                </tr>
                @foreach ($questionsAnswered->get() as $questionAsked)
                <tr>
                    <td>
                        {{ $questionAsked->asker->username }}
                    </td>
                    <td>
                        {{ $questionAsked->question->question }}
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
                    <td>
                        <a href="{{ URL::route('questions.asked.show', ['questionAskedID' => $questionAsked->id]) }}" class="HMI-share HMI-share-facebook">
                            <span class="fa fa-facebook"></span>
                        </a>
                        <span class="fa fa-twitter"></span>
                        <span class="fa fa-google"></span>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif

            <p>
                <a href="{{ URL::route('questions.index') }}">
                    &larr; Back to Questions
                </a>
            </p>
        </div>
    </div>

</div>

@stop