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

        <h1>{{ Auth::user()->firstname }}'s Honeys</h1>

        <a class="btn btn-default honeyAdd" href="{{ URL::route('honeyAdd') }}">Add</a>
        <table class="table" id="honeytable">
            <tr>
                <th>First Name</th>
                <th>Surname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            @foreach ($honeys as $honey)
            <tr>
                <td>{{ $honey->firstname }}</td>
                <td>{{ $honey->surname }}</td>
                <td>{{ $honey->username }}</td>
                <td><a href="{{ URL::route('honeyLinkDestroy', ['userID' => $honey->id]) }}" data-method="delete">REMOVE</a></td>
            </tr>
            @endforeach
        </table>

    </div>

</header><!--End header -->

@stop