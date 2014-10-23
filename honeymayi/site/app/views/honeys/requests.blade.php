<?php
$customJs  = [
    "jquery.scrollto",
    "jquery.backstretch.min",
    "jquery.masonry.min",
    "waypoints.min",
    "twitterFetcher_v10_min",
    "jquery.flexslider.min",
    "scripts",
    "restfulise"
];
$customCss = [
    "honeys"
];
?>
@extends('layout')

@section('title')
My Honeys | Honey May I
@stop

@section('content')

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>


@include('fragments.main-nav')

<!-- ==============================================
HEADER 2
=============================================== -->
<header id="honeysmain">

    <div class="container text-center">

        <h1>Honey Requests</h1>
        @if (count($requests) == 0)
        <strong>You have no requests :(</strong><br />
        <a href="{{ URL::route('honeys') }}">Go Back</a>
        @else
        <a class="btn btn-default honeyAdd" href="{{ URL::route('honeyAdd') }}">Add</a>
        <table class="table" id="honeytable">
            <tr>
                <th>First Name</th>
                <th>Surname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            @foreach ($requests as $honey)
            <tr>
                <td>{{ $honey->firstname }}</td>
                <td>{{ $honey->surname }}</td>
                <td>{{ $honey->username }}</td>
                <td>
                    <a href="{{ URL::route('honeys.answer', ['userID' => $honey->id, 'response' => 'accept']) }}">ACCEPT</a> |
                    <a href="{{ URL::route('honeys.answer', ['userID' => $honey->id, 'response' => 'decline']) }}">DECLINE</a>
                </td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>

</header><!--End header -->

@stop