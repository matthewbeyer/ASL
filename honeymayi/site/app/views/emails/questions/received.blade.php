<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Honey May I | Question Received</h2>

        <p>
            Hi {{ $questionAsked->askee->firstname }},
        </p>
        <p>
            {{ $questionAsked->asker->firstname }} {{ $questionAsked->asker->surname }}
            (<b>{{ $questionAsked->asker->username }}</b>) has asked you a Question on Honey May I!
        </p>
        <blockquote>
            Honey May I...<br />
            <p>
                <b>{{ $questionAsked->question->question }}</b>
            </p>
            <p>
                {{ $questionAsked->message }}
            </p>
        </blockquote>
        <p>
            To answer this question, click the following link:<br />
            <a href="{{ URL::route('questions.inbox') }}">{{ URL::route('questions.inbox') }}</a>
        </p>

        <p>
            With love, the Honey May I team.
            &lt;3
        </p>
	</body>
</html>
