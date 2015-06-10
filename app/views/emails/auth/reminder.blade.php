<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, click on following link.<br/>
			<a href="{{ URL::to('password/reset', array($token)) }}" target="_blank">Reset link</a><br /><br />
			Or copy the following link and run in browser. <br />
			{{ URL::to('password/reset', array($token)) }} <br /><br />
			This link will expire in {{ Config::get('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
