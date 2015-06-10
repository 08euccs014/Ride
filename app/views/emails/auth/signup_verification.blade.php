<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Thank you, for joining this community.</h2>
		<h4>Kindly verify your account so that we could reach you, if we got a copassenger for you.</h4>
		<div>
			<a href="{{ URL::to('user/verification', array($token)) }}" target="_blank">Verify</a><br /><br />
			Or copy the following link and run in browser. <br />
			{{ URL::to('user/verification', array($token)) }} <br /><br />
		</div>
	</body>
</html>
