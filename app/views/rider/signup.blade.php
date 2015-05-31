@extends('layouts/main')
@section('content')
<div class="row">

<div class="col-sm-offset-3 col-sm-5 gap-top-20">

		<form id="signupform" action="{{ url('ajax/signup') }}" method="post" class="form-horizontal">
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-3 control-label">Do you</label>
			     <div class="col-sm-9">
					<div class="radio">
						<label>
						<input type="radio" name="userdata[group]"  value="0" checked>
						  Offer Ride
						</label>
						<label>
						<input type="radio" name="userdata[group]" value="1">
						 Want Ride
						</label>
					</div>
				</div>
			</div>
			
			
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-3 control-label">Name</label>
			    <div class="col-sm-4 form-inlable">
			      <input type="text" class="form-control" name="userdata[firstname]"  placeholder="first name ?">
			      <i class="glyphicon glyphicon-user"></i>
			    </div>
			    <div class="col-sm-5 form-inlable">
                  <input type="text" class="form-control" name="userdata[lastname]"  placeholder="last name ?">
                </div>
			</div>
			
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-3 control-label">Gender</label>
			     <div class="col-sm-9">
					<div class="radio">
						<label>
						<input type="radio" name="userdata[gender]" id="optionsRadios1" value="M" checked>
						Male
						</label>
						<label>
						<input type="radio" name="userdata[gender]" id="optionsRadios2" value="F">
						 Female
						</label>
					</div>
				</div>
			</div>
			
			<div class="form-group">
			    <label for="rideto" class="col-sm-3 control-label">Contact</label>
			    <div class="col-sm-9 form-inlable">
			      <input type="email" class="form-control" name="userdata[email]" placeholder="e-mail">
			       <i class="glyphicon glyphicon-envelope"></i>
			    </div>
			    <div class="col-sm-offset-3 col-sm-9 text-center gap-ver-10">And / Or</div>
			     <div class="col-sm-offset-3 col-sm-9 form-inlable">
			      <input type="text" class="form-control" name="userdata[contact]" placeholder="contact number">
			       <i class="glyphicon glyphicon-earphone"></i>
			    </div>
			</div>
			
			
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-3 control-label">Time range</label>
			    <div class="col-sm-9">
			    <div class="row form-inlable">
				    <div class="col-sm-6">
				      <input type="time" class="form-control" name="userdata[timefrom]" placeholder="From">
				       <i class="glyphicon glyphicon-time"></i>
				      </div>
				      <div class="col-sm-6">
				      <input type="time" class="form-control" name="userdata[timeto]" placeholder="To">
				        <i class="glyphicon glyphicon-time"></i>
				      </div>
			      </div>
			    </div>
			</div>
			
			
			<div class="form-group">
			    <label for="ridefrom" class="col-sm-3 control-label">Ride From</label>
			    <div class="col-sm-9 form-inlable google-mapper-box">
			      <input type="text" class="form-control google-mapper" name="userdata[ridefrom][loc]" placeholder="From" />
			      <input type="hidden" class="google-mapper-lat" name="userdata[ridefrom][lat]" value="0" />
			      <input type="hidden" class="google-mapper-lng" name="userdata[ridefrom][lng]" value="0" />
			      <i class="glyphicon glyphicon-map-marker"></i>
			      <div class="help-box"></div>
			    </div>
			</div>
			
<!-- 			<div class="form-group"> -->
<!-- 				<label for="ridefrom" class="col-sm-3 control-label">Middle Stops</label> -->
<!-- 				<div class="col-sm-9 form-inlable"> -->
<!-- 				<span class="pull-right">Add middle stops to get more rides</span> -->
<!-- 					<hr/> -->
<!-- 					<i class="glyphicon glyphicon-map-marker"></i> -->
<!-- 					<input type="text" class="form-control google-mapper hide" name="userdata[ridemiddle][loc]" placeholder="middle stops" data-map-latitude='0' data-map-longitude='0' /> -->
<!-- 					<input type="hidden" class="google-mapper-lat" name="userdata[ridemiddle][lat]" value="0" /> -->
<!--                     <input type="hidden" class="google-mapper-lng" name="userdata[ridemiddle][lng]" value="0" /> -->
<!-- 			    </div> -->
<!-- 			</div> -->
			
			<div class="form-group">
			    <label for="rideto" class="col-sm-3 control-label">Ride To</label>
			    <div class="col-sm-9 form-inlable">
			      <input type="text" class="form-control google-mapper" name="userdata[rideto][loc]" placeholder="To" data-map-latitude='0' data-map-longitude='0' />
			      <input type="hidden" class="google-mapper-lat" name="userdata[rideto][lat]" value="0" />
                  <input type="hidden" class="google-mapper-lng" name="userdata[rideto][lng]" value="0" />
			      <i class="glyphicon glyphicon-map-marker"></i>
			    </div>
			</div>

			<div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="userdata[username]" placeholder="username" />
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="userdata[password]" placeholder="Password" />
                </div>
            </div>
			
			
			 <div class="checkbox">
			    <label  class="col-sm-offset-3 col-sm-9">
			      <input type="checkbox"  id="termcondition" checked> I Agree with <a href="{{ url('term_and_conditions') }}" target="_blank">terms&conditions</a>.
			    </label>
			  </div>

			<div class="form-group gap-top-20">
				<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-primary btn-block">Continue&nbsp;<i class="glyphicon glyphicon-menu-right"></i></button>
				</div>
			</div>
		</form>
		
</div>
</div>

<script>

$('#signupform').on('submit', function() {

	if ( !$('#termcondition').is(':checked') ) {
		alert('Kindly approve terms & conditions to proceed. Thank You');
		return false;
	}
    var actionUrl= $('#signupform').attr('action');
    var postData = $('#signupform').serialize();


    ajaxRequest(actionUrl, postData, 'POST', 'json', function(response){
        if(response.status == 1) {
            window.location = response.url;
        }
    }, function(response){alert(response);} );

//stop the normal form submission
return false;
});
</script>
@stop