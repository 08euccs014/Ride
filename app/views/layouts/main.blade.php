@include('layouts/header')
@include('layouts/notification')
@include('layouts/footer')
@include('layouts/analytics')
@include('layouts/tag_manager')

<!doctype html>
<html lang="en">
<head>

	<base href="http://www.joinmyway.net" />
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="best ride pool, best ride share, car pool, ride pool, pooling, motorcycle pool, 2 wheeler pool, 4 wheeler pool, want a ride, save fuel, save moeny, join my way, joinmyway, pick me up, ride share, rideshare, share ride" />
	<meta name="description" content="Join my way is ride pool initiative to help those people who does not have their own vehicle but travel a lot on same way. so it will bring the rider and passenger togather to join their to save money for both rider and passenger. it will save fuel, save money, save environment from pollution. it help reducing commuting time and traffic." />
	<link href="{{ url('assets/image/join-favicon.jpg') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />

	<title>Join My Way : Best Ride Pooling Initiative</title>
	{{ HTML::style('assets/css/bootstrap.min.css') }}
	{{ HTML::style('assets/css/override.css') }}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	{{ HTML::style('assets/css/app.css') }}
	{{ HTML::script('assets/js/jquery.min.js') }}
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	<script>
		window.base_url = '{{ url('/') }}';
	</script>
</head>
<body>
@yield('tag')
		<div class="container">
		@yield('header')
		@yield('notification')
		<div class="app-container">
		@yield('content')
		</div>
		</div>
		<div class="container-fluid">
		@yield('footer')
		</div>
	
</body>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/app.js') }}
@yield('analytics')
</html>