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
Inbox | Honey May I
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

        <h1>Inbox</h1>
        @if (count($pendingQuestions) == 0)
        <strong>You have no pending questions :(</strong><br />
        @else
        <table class="table" id="honeytable">
            <tr>
                <th>From</th>
                <th>Honey May I...</th>
                <th>Message</th>
                <th>Asked At</th>
                <th>Answer</th>
            </tr>
            @foreach ($pendingQuestions as $questionAsked)
            <tr>
                <td>{{ $questionAsked->asker->username }}</td>
                <td>{{ $questionAsked->question->question }}</td>
                <td>{{ $questionAsked->message }}</td>
                <td>{{ $questionAsked->created_at->toDayDateTimeString() }}</td>
                <td>
                    <a href="{{ URL::route('questions.answer', ['questionAsked' => $questionAsked->id, 'answer' => 'yes']) }}">
                        YES
                    </a>
                    |
                    <a href="{{ URL::route('questions.answer', ['questionAsked' => $questionAsked->id, 'answer' => 'no']) }}">
                        NO
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
        <a href="{{ URL::route('dashboard') }}">Go Back</a>

    </div>

</div>

@stop