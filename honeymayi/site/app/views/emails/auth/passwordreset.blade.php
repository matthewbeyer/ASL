<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Honey May I | Password Reset</h2>

		<p>
            We received a request to reset your password. If this was you, please follow the link below.<br />
            If not, please disregard this email.<br />
			To reset your password, complete this form:
            <a href="{{ URL::to('resetpassword', array('resetcode' => $code)) }}">
                {{ URL::to('resetpassword', array('resetcode' => $code)) }}
            </a>.
            <br/>
		</p>
        <p>
            With love, the Honey May I team.
            &lt;3
        </p>
	</body>
</html>
