@extends('layouts/main')
@section('content')

<div class="row">

	<h1>Messages</h1>
	<hr />
	
	<div class="gap-top-20 col-sm-12">
		@if($messages)
		
			<div id="messageSection">
			@foreach($messages as $msg)
			
			<div class="gap-top-10">
				<div class="message panel panel-default" data-message-id="{{ $msg->id }}" data-receiver-id="{{ $msg->sender_id }}">
					<div class="panel-body">
						<p class="gap-bottom-5">
							{{ $msg->content }}
						</p>
						<div class="hr">
							From : <strong>{{ $msg->sender->firstname}} {{ $msg->sender->lastname }}</strong>
							<span class="btn btn-link btn-sm reply"  onClick="reply({{ $msg->id }});"><i class="glyphicon glyphicon-share-alt"></i> Reply </span>
<!-- 							<span class="btn btn-link btn-sm"><i class="glyphicon glyphicon-pushpin"></i> Mark as read</span> -->
						</div>
					</div>
				</div>
			</div>
			@endforeach
			</div>
		
		@else
			<h3>Right now, you don't have any message.</h3>
		@endif
	</div>
	
</div>

<div class="hide" id="replyTemplate">
<div class="message panel panel-default" data-message-id="">
	<div class="panel-body">
		<p class="gap-bottom-5">
			<textarea name="replyContent"  id="replyContent"  style="width:100%" rows="6"></textarea>
		</p>
		<div>
			<button type="button" id="sendContactMsg" data-loading-text="sending..." class="btn btn-primary" autocomplete="off"  onClick="sendMsg(this);">
				send <i class="glyphicon glyphicon-send" ></i>
			</button>
			<span class="btn btn-link"  onClick="cancelMsg(this);">cancel </span>
		</div>
		<input type="hidden" value="" id="receiverId"/>
		<input type="hidden" value="{{ $userLoggedIn->id }}" id="senderId"/>
	</div>
</div>
</div>

<script>
function reply(msgId)
{
	$('#replyTemplate .message').attr('data-message-id', msgId);
	var receiverId = $('#messageSection .message[data-message-id="'+msgId+'"]').attr('data-receiver-id');
	$('#replyTemplate .message #receiverId').val(receiverId);
	var html = $('#replyTemplate').html();
	$('#messageSection .message[data-message-id="'+msgId+'"] .reply').attr('disabled', true);
	$('#messageSection .message[data-message-id="'+msgId+'"]').parent().append(html);
}

function cancelMsg(obj)
{
	var parent = $(obj).parent().parent().parent();
	var msgId = $(parent).attr('data-message-id');
	$(parent).remove();
	$('#messageSection .message[data-message-id="'+msgId+'"] .reply').attr('disabled', false);
}

function sendMsg(obj)
{
		sendButton = obj;
		$(obj).button('loading');
		
		parent = $(obj).parent().parent().parent();
		
		replyToMsg = $(parent).attr('data-message-id');
		var msg = $('#replyContent', parent).val();
		var receiverId = $('#receiverId', parent).val();
		var senderId = $('#senderId', parent).val();
		var url = routeUrl('/ajax/rider/send_contact_msg');
		ajaxRequest(url, {msg : msg, receiverId : receiverId, senderId : senderId, replyToMsg : replyToMsg}, 'POST', 'json', function(response){
			if(response.status == 1) {
				$(obj).parent().parent().html($('#replyContent', parent).val());
				$('#messageSection .message[data-message-id="'+replyToMsg+'"] .reply').attr('disabled', false);
			}
			else {
				alert('Sorry, there is some error occur.');
				cancelMsg(sendButton);
			}
			$('#sendContactMsg').button('reset');
			
		}, function(response){
			alert('Sorry, there is some error occur.');
			$('#sendContactMsg').button('reset');
		});
		
		return false;
	
}

</script>

@stop
