@extends('layouts/main')
@section('content')

<div class="row">

	<h1>Messages</h1>
	<hr />
	
	<div class="gap-top-20 col-sm-12">

	<div class="col-sm-3">
	@if($contacts)
		<div class="list-group">
	  	@foreach($contacts as $contact)
		<a class="list-group-item cursor-pointer" onClick="getConversation({{ $contact->id }});" data-contact-id="{{ $contact->id }}">
		    <h4 class="list-group-item-heading">{{ ucfirst($contact->firstname) }} {{ $contact->lastname }}</h4>
		  </a>
		@endforeach
		</div>
	@else
		<h5 class="text-center">Your contacts would be shown here</h5>
	@endif
	</div>
	<div class="col-sm-9 bl">
		<div id="conversation"><h4 class="text-center">Right now you don't have any messages</h4></div>
		<div id="replyMsg">
			<div class="message panel panel-default" data-message-id="">
				<div class="panel-body">
					<p class="gap-bottom-5">
						<textarea name="replyContent"  id="replyContent"  style="width:100%" rows="4" placeholder="let's talk..."></textarea>
					</p>
					<div>
						<button type="button" id="sendContactMsg" data-loading-text="sending..." class="btn btn-primary" autocomplete="off"  onClick="sendMsg(this);">
							send <i class="glyphicon glyphicon-send" ></i>
						</button>
	<!-- 				<span class="btn btn-link"  onClick="cancelMsg(this);">cancel </span> -->
					</div>
					<input type="hidden" value="" id="receiverId"/>
					<input type="hidden" value="{{ $userLoggedIn->id }}" id="senderId"/>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>
$(document).ready(function(){
	$('#replyMsg').hide();
	@if(!empty($contacts))
	getConversation({{$contact->id}});
	@endif
});

function sendMsg(obj)
{
		sendButton = obj;
		$(obj).button('loading');
		
		parent = $(obj).parent().parent().parent();
		
		replyToMsg = $(parent).attr('data-message-id');
		msg = $('#replyContent', parent).val();
		receiverId = $('#receiverId', parent).val();
		senderId = $('#senderId', parent).val();
		var url = routeUrl('/ajax/rider/send_contact_msg');
		ajaxRequest(url, {msg : msg, receiverId : receiverId, senderId : senderId, replyToMsg : replyToMsg}, 'POST', 'json', function(response){
			if(response.status == 1) {

				var content = [{id : 0, content : msg, sender_id : senderId, receiver_id : receiverId}] ;
				addConversation(content, true, receiverId);
				$('#replyContent', parent).val('');
			}
			else {
				alert('Sorry, there is some error occur.');
			}
			$('#sendContactMsg').button('reset');
		}, function(response){
			alert('Sorry, there is some error occur.');
			$('#sendContactMsg').button('reset');
		});
		
		return false;
	
}

function getConversation(contactId)
{
	$('#replyMsg').hide();
	$('#conversation').html('<div class="text-center"><i class="glyphicon glyphicon-cog loading"></i></div>');
	$('.list-group .list-group-item').removeClass('active');
	$('.list-group .list-group-item[data-contact-id="'+ contactId +'"]').addClass('active'); 
	var url = routeUrl('/ajax/rider/get_conversation');
	ajaxRequest(url, {contactId : contactId}, 'POST', 'json', function(response){
		if(response.status == 1) {
			addConversation(response.content, false, contactId);
		}
		else {
			alert('Sorry, there is some error occur.');
		}
	}, function(response){
		alert('Sorry, there is some error occur.');
	});
	return false;
}

function addConversation(conversation, append, contactId)
{

	var loggedIn = {{ $userLoggedIn->id }};
	var counts = conversation.length;
	var html = ""; 
	for(i= 0 ; i < counts; i++) {
		var content = '<div class="message panel panel-default" data-message-id=""><div class="panel-body">'+conversation[i].content + '</div></div>';
		if (loggedIn == conversation[i].sender_id) {
			html = html + '<div class="row"><div class="col-sm-11 pull-right">'+content + '</div></div>';
		}
		else {
			html = html + '<div class="row"><div class="col-sm-11 pull-left">' + content + '</div></div>';
			lastMsgId = conversation[i].id;
		}
	}
	if (append == true) {
		$('#conversation').append(html);
	} 
	else {
		if (html == "") {
			html = "Right now, there is no conversation.";
		}
		$('#conversation').html(html);
	}

	var parent = $('#replyMsg');
	$('.message', parent).attr('data-message-id',lastMsgId);
	$('#receiverId', parent).val(contactId);
	$('#replyMsg').show();
}

</script>

@stop
