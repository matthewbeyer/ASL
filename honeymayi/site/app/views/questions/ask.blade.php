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
Ask | Honey May I
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

        <div class="row">
            <p class="questionHoneyMayI">Honey May I...</p>
            <h1 class="question">{{ $question->question }}</h1>
        </div>

        <div class="row">
            @if( $errors->count() > 0 )
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Error!</h4>
                {{ $errors->first('general') }}
                {{ $errors->first('honey') }}
                {{ $errors->first('message') }}
            </div>
            @endif
            {{ Form::open(['route' => ['questions.ask', $question->id]]) }}
                {{ Form::select('honey', $honeyList, null, ['class' => 'form-control']) }}<br />
                {{ Form::textarea('message', Input::old('message'), ['class' => 'form-control', 'placeholder' => 'Attach a short message (optional)...']) }}<br />
                {{ Form::submit('Ask', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
            <p>
                <a href="{{ URL::route('questions.show', ['question' => $question->id]) }}">&larr; Back to The Question</a>
            </p>
        </div>

    </div>

</div>

@stop