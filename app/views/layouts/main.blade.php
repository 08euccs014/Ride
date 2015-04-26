@include('layouts/header')
@include('layouts/notification')
@include('layouts/footer')

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	{{ HTML::style('assets/css/bootstrap.min.css') }}
	{{ HTML::style('assets/css/override.css') }}
	{{ HTML::style('assets/css/app.css') }}
	{{ HTML::script('assets/js/jquery.min.js') }}
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
</head>
<body>
	<div class="container">
		@yield('header')
		@yield('notification')
		@yield('content')
		{{--@yield('footer')--}}
	</div>
</body>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/app.js') }}
</html>