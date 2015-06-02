<?php 
$user = Auth::user();
if($user == null) {
	$visitor = true;
}else{
	$visitor = false;
	$rider = rider::getInstance($user->id);	
}
 
?>
@section('header')
<div class="row gap-top-10">
        <nav>
          <ul class="nav nav-pills site-nav pull-right">
            <li role="presentation" class="active"><a href="{{ url('/') }}">Let's Go</a></li>
            <li role="presentation"><a href="{{ url('aboutus') }}">What we think</a></li>
            @if($visitor)
            <li role="presentation"><a href="{{ url('login') }}">Login</a></li>
            <li role="presentation"><a href="{{ url('signup') }}">Sign Up</a></li>
            @else
            <li role="presentation"><a href="{{ url('messages') }}"><i class="glyphicon glyphicon-envelope"></i> Messages</a></li>
            <li role="presentation" class="dropdown">
	            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Hi, {{ ucfirst($rider->firstname) }}  <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					{{--<li><a href="{{ url('profile') }}"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Profile</a></li>--}}
					<li> <a href="{{ url('logout') }}"><i class="glyphicon glyphicon-off"></i>&nbsp;&nbsp;Logout</a></li>
				</ul>
            </li>
            @endif
          
          </ul>
		</nav>
</div>
@stop