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
Create a New Question | Honey May I
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

        <h1>Create a New Question</h1>

        <p>To create a new Question, enter it below and click "Create".</p>
        @if( $errors->count() > 0 )
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Error!</h4>
            {{ $errors->first('general') }}
            {{ $errors->first('question') }}
        </div>
        @endif
        {{ Form::open(['route' => 'questions.store']) }}
            <div class="input-group">
                {{ Form::text('question', Input::old('question'), ['class' => 'form-control', 'placeholder' => 'Honey May I...']) }}
                <span class="input-group-btn">
                    {{ Form::submit('Create', ['class' => 'btn btn-submit']) }}
                </span>
            </div>
        {{ Form::close() }}
        <p>
            <a href="{{ URL::route('questions.index') }}">&larr; Back to All Questions</a>
        </p>
    </div>

</header><!--End header -->

@stop