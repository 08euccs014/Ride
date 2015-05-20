@extends('layouts/main')
@section('content')
<div class="row">

	<!-- Search Form -->	
	<div class="col-sm-offset-3 col-sm-5">
	
		<h1 class="text-center gap-ver-10">Join My Way</h1>
		<form class="form-horizontal gap-top-20 row" action="{{ url('/') }}" method="GET">
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-2 control-label">From</label>

			    <div class="col-sm-10 form-inlable google-mapper-box">
                  <input type="text" class="form-control google-mapper" name="searchdata[ridefrom][loc]" placeholder="From" />
                  <input type="hidden" class="google-mapper-lat" name="searchdata[ridefrom][lat]" value="0" />
                  <input type="hidden" class="google-mapper-lng" name="searchdata[ridefrom][lng]" value="0" />
                  <i class="glyphicon glyphicon-map-marker"></i>
                  <div class="help-box"></div>
                </div>
			</div>
			
			<div class="form-group">
			    <label for="rideto" class="col-sm-2 control-label">To</label>
                <div class="col-sm-10 form-inlable google-mapper-box">
                  <input type="text" class="form-control google-mapper" name="searchdata[rideto][loc]" placeholder="From" />
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
<hr/>
<!-- Riders list -->
<div id="riderlist" class="row gap-top-20">
    @include('rider/list')
</div>
@stop