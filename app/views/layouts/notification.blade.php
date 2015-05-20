@section('notification')
<div class="row gap-top-20">
    @if (Session::has('error'))
      <div class="col-md-12 alert alert-danger">{{ trans(Session::get('error')) }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    @endif
    @if (Session::has('success'))
      <div class="col-md-12 alert alert-success">{{ trans(Session::get('success')) }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    @endif
     @if (Session::has('message'))
      <div class="col-md-12 alert alert-info">{{ trans(Session::get('message')) }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    @endif
</div>
@stop

<?php
//remove the session notifications
Session::forget('error');
Session::forget('success');
Session::forget('message');

?>
