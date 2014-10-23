<?php
$customJs  = [
    "jquery.scrollto",
    "jquery.backstretch.min",
    "jquery.masonry.min",
    "waypoints.min",
    "twitterFetcher_v10_min",
    "jquery.flexslider.min",
    "scripts",
];
$customCss = [
    "honeys"
];
?>
@extends('layout')

@section('title')
Add Honey | Honey May I
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

        <h1>Add a Honey</h1>

        <p>To add a new Honey, enter their username below and click "Add".</p>
        @if( $errors->count() > 0 )
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Error!</h4>
            {{ $errors->first('general') }}
            {{ $errors->first('username') }}
        </div>
        @endif
        {{ Form::open(['route' => 'honeyAdd']) }}
            <div class="input-group">
                {{ Form::text('username', Input::old('username'), ['class' => 'form-control', 'placeholder' => 'Username']) }}
                <span class="input-group-btn">
                    {{ Form::submit('Add', ['class' => 'btn btn-submit']) }}
                </span>
            </div>
        {{ Form::close() }}
        <p>
            <a href="{{ URL::route('honeys') }}">&larr; Back to All Honeys</a>
        </p>
    </div>

</header><!--End header -->

@stop