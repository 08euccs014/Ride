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
				<div class="form-group">
					<textarea cols="68" rows="5" placeholder="write your message here" id="contactMsg"></textarea>
				</div>
				<div class="form-group">
					<button type="button" id="sendContactMsg" data-loading-text="Sending ..." class="btn btn-primary pull-right" autocomplete="off"  onclick="sendContactMsg(this);">
						Send &nbsp; <i class="glyphicon glyphicon-send"></i>
					</button>
				</div>
			</div>
		</div>
		<input type="hidden" value="{{ $rider->id }}" id="receiverId"/>
		<input type="hidden" value="{{ $userLoggedIn->id }}" id="senderId"/>
	@endif
    </div>
  </div>
</div>