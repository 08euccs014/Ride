@extends('layouts/main')
@section('content')
<div class="row">

	<!-- Search Form -->	
	<div class="col-sm-offset-3 col-sm-5">
	
		<div class="text-center gap-ver-20">
		<img src="{{ url('assets/image/join_my_way.png') }}" style="height:53px; opacity:0.75"/>
		<div class="row">
			<h5>A Ride Sharing Initiative To Save Environment, Save Fuel, Save Money</h5>
		</div>
		</div>
		<form class="form-horizontal gap-top-20 row" action="{{ url('/') }}" method="GET">
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
	</div
<!-- Riders list -->
<div id="riderlist" class="row gap-top-20">
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
