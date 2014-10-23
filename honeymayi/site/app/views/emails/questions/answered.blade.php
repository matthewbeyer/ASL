<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Honey May I | Question Answered</h2>

        <p>
            Hi {{ $questionAsked->asker->firstname }},
        </p>
        <p>
            {{ $questionAsked->askee->firstname }} {{ $questionAsked->askee->surname }}
            (<b>{{ $questionAsked->askee->username }}</b>) has answered your Question on Honey May I!
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
            {{ $questionAsked->askee->firstname }} answered with a
            <b>{{ ($questionAsked->answer) ? "YES" : "NO" }}</b>
        </p>

        <p>
            With love, the Honey May I team.
            &lt;3
        </p>
	</body>
</html>
