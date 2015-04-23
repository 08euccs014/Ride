@extends('layouts/main')
@section('content')
<div class="row">

 <div class="col-sm-offset-3 col-sm-5 gap-top-20">


 <form id="loginform" action="{{ url('ajax/login') }}" method="post" class="form-horizontal">

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


 			<div class="form-group gap-top-20">
 				<div class="col-sm-offset-3 col-sm-9">
 				<button type="submit" class="btn btn-primary btn-block">Continue&nbsp;<i class="glyphicon glyphicon-menu-right"></i></button>
 				</div>
 			</div>
 		</form>

 </div>
</div>

<script>

$('#loginform').on('submit', function() {

    var actionUrl= $('#loginform').attr('action');
    var postData = $('#loginform').serialize();


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