@extends('layouts/main')
@section('content')
<div class="row">

	<!-- Search Form -->	
	<div class="col-sm-offset-2 col-sm-8">
	
		<div class="text-center gap-ver-20">
			<img src="{{ url('assets/image/join_my_way.png') }}" style="height:53px; opacity:0.75"/>
			<div class="row gap-top-10">
				<h3>A Ride Sharing Initiative To Save Environment, Save Fuel, Save Money</h3>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">
		<form class="form-horizontal gap-top-20 row" action="{{ url('riders') }}" method="GET">
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-2 control-label">From</label>

			    <div class="col-sm-10 form-inlable google-mapper-box">
                  <input type="text" class="form-control google-mapper" name="searchdata[ridefrom][loc]" placeholder="From"  id="ridefrom"/>
                  <input type="hidden" class="google-mapper-lat" name="searchdata[ridefrom][lat]" value="0" />
                  <input type="hidden" class="google-mapper-lng" name="searchdata[ridefrom][lng]" value="0" />
                  <i class="glyphicon glyphicon-map-marker"></i>
                  <div class="help-box"></div>
                </div>
			</div>
			
			<div class="form-group">
			    <label for="rideto" class="col-sm-2 control-label">To</label>
                <div class="col-sm-10 form-inlable google-mapper-box">
                  <input type="text" class="form-control google-mapper" name="searchdata[rideto][loc]" placeholder="To"  id="rideto"/>
                  <input type="hidden" class="google-mapper-lat" name="searchdata[rideto][lat]" value="0" />
                  <input type="hidden" class="google-mapper-lng" name="searchdata[rideto][lng]" value="0" />
                  <i class="glyphicon glyphicon-map-marker"></i>
                  <div class="help-box"></div>
                </div>
			</div>
			
			<div class="form-group gap-top-20">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-search"></i>&nbsp;Search</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>
<hr/>
<!-- How it works -->
<div class="row gap-ver-20 info-section">
	<div class="col-sm-10 col-sm-offset-1">
		<h4 class="text-center info-text gap-bottom-30">
			Now or never ! Let's save our earth, save our next generation from the pollution.
			Start sharing your vehicle, no matter what it is a 2-wheeler or 4-wheeler. 
			Make and choose your own ride pool. No extra efforts.
			It would save you fuel costing, increase social commitments.  
		</h4>
		<br />
	</div>
	<div class="col-sm-10 col-sm-offset-1">
	<div class="col-sm-3 text-center">
		<i class="fa fa-users fa-4x fa-round"></i>
		<h3>Social</h3>
	</div>
	<div class="col-sm-3 text-center">
		<i class="fa fa-leaf fa-4x fa-round"></i>
		<h3>Eco-Friendly</h3>
	</div>
	<div class="col-sm-3 text-center">
		<i class="fa fa-money fa-4x fa-round"></i>
		<h3>Economical</h3>
	</div>
	<div class="col-sm-3 text-center">
		<i class="fa fa-shield fa-4x fa-round"></i>
		<h3>Secure</h3>
	</div>
	</div>
</div>

<hr/>
<!-- How it works -->
<div class="row gap-ver-20 info-section">
	<div class="col-sm-6">
		<h1>It's Free !</h1>
		<h4>It is initiative is totally free no hidden charges.</h4>
	</div>
	<div class="col-sm-6 pull-right">
		<img style="max-width:80%;"  src="{{ url('assets/image/info-4.png') }}" alt="" />
	</div>
</div>
<hr/>
<div class="row gap-ver-20 info-section">
	<div class="col-sm-6 pull-left">
		<img style="max-width:80%;"  src="{{ url('assets/image/info-2.png') }}" alt="" />
	</div>
	<div class="col-sm-6 pull-right">
		<h1>Easiest Search</h1>
		<h4>Easy to search from pickup point to destination</h4>
	</div>
</div>
<hr/>
<div class="row gap-ver-20 info-section">
	<div class="col-sm-6 pull-left">
		<h1>Contact your co-passenger</h1>
		<h4>Contact the co-passenger using built-in chatting system.</h4>
	</div>
	<div class="col-sm-6 pull-right">
		<img style="max-width:80%;" src="{{ url('assets/image/info-3.png') }}" alt="" />
	</div>
</div>
<hr/>
<div class="row gap-ver-20 info-section">
	<div class="col-sm-6 pull-left text-center">
		<i class="fa fa-shield fa-8x gap-top-20"></i>
	</div>
	<div class="col-sm-6 pull-right">
		<h1>Security</h1>
		<h4>Your private infomation is not published anywhere.</h4>
		<h4>Female could only share rides with female only.</h4>
	</div>
</div>


<!-- Riders list -->
<div id="riderlist" class="row gap-top-20 hide">
    @include('rider/list')
</div>
<script type="text/javascript">
$(document).ready(function() {
	var ridefrom = document.getElementById('ridefrom');
	var autocomplete = new google.maps.places.Autocomplete(ridefrom);
	addPlaceListener(ridefrom, autocomplete);

	var ridefrom = document.getElementById('rideto');
	var autocomplete = new google.maps.places.Autocomplete(ridefrom);
	addPlaceListener(ridefrom, autocomplete);
});
</script>
@stop
