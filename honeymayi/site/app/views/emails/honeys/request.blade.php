<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Honey May I | New Honey Request</h2>

        <p>
            {{ $user->firstname }} {{ $user->surname }} <b>{{ $user->username }}</b>) has sent you a Honey request on
            Honey May I!
        </p>
        <p>
            To accept or decline this invitation, click the following link:<br />
            <a href="{{ URL::route('honeyRequests') }}">{{ URL::route('honeyRequests') }}</a>
        </p>

        <p>
            With love, the Honey May I team.
            &lt;3
        </p>
	</body>
</html>
