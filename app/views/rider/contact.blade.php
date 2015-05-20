<div class="modal fade" id="riderModal" tabindex="-1" role="dialog" aria-labelledby="riderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="riderModalLabel">	@if(isset($error)) Information @else {{ $rider->firstname }} {{ $rider->lastname }} @endif</h4>
      </div>
      <div class="modal-body">
      	@if(isset($error)) 
      		{{ $error }}
      	@else
      	<div class="row">
      	<div class="col-sm-12">
	      <div class="form-group row">
		    <label class="col-sm-4 control-label">Name</label>
		    <div class="col-sm-8">
		      {{ $rider->firstname }} {{ $rider->lastname }}
		    </div>
		  </div>
	      <div class="form-group row">
		    <label class="col-sm-4 control-label">Contact Number</label>
		    <div class="col-sm-8">
		      {{ $rider->phone }}
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-4 control-label">Email Me</label>
		    <div class="col-sm-8">
		     {{ $rider->email }}
		    </div>
		  </div>
		</div>
	</div>
	@endif
    </div>
  </div>
</div>