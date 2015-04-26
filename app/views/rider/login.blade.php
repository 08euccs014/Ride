@extends('layouts/main')
@section('content')
<div class="row">

 <div class="col-sm-offset-3 col-sm-5 gap-top-20">
 <form id="loginform" action="{{ url('ajax/login') }}" method="post" class="form-horizontal">

 			<div class="form-group">
                 <label for="email" class="col-sm-3 control-label">Email</label>
                 <div class="col-sm-9">
                   <input type="email" class="form-control" name="userdata[email]" placeholder="email" />
                 </div>
             </div>

             <div class="form-group">
                 <label for="password" class="col-sm-3 control-label">Password</label>
                 <div class="col-sm-9">
                   <input type="password" class="form-control" name="userdata[password]" placeholder="Password" />
                 </div>
             </div>


 			<div class="form-group gap-top-20">
 				<div class="col-sm-offset-3 col-sm-9">
 				<button type="submit" class="btn btn-primary btn-block">Continue&nbsp;<i class="glyphicon glyphicon-menu-right"></i></button>
 				</div>
 			</div>
 		</form>
 		<hr/>
 		<div class="gap-top-10 row">
            <div class="col-md-12"><a class="pull-right" href="{{ url('password/remind') }}">Forget Password</a></div>
            <div class="col-md-12 gap-top-10"><a class="pull-right" href="{{ url('signup') }}">Create Account</a></div>
 		</div>

 </div>
</div>

<script>

$('#loginform').on('submit', function() {

    var actionUrl= $('#loginform').attr('action');
    var postData = $('#loginform').serialize();


    ajaxRequest(actionUrl, postData, 'POST', 'json', function(response){
        if(response.status == 1) {
            window.location = response.url;
        }else{
            alert(response.message);
        }
    },
    function(response){
        alert(response.message);
    });

//stop the normal form submission
return false;
});
</script>


@stop