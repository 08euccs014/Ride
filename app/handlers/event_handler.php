<?php 
Event::listen('cron.trigger', function(){
	return sendPendingMessages();
});
Event::listen('user.signup', function($user){
	return sendVerificationLink($user);
});

function sendPendingMessages()
{
    	$modal = App::make('messageModel');
		$messages = $modal->getPendingMessages();
		
		if (empty($messages)) {
			return false;
		}

		try {
			foreach ($messages as $msg) {	   
		    		rFactory::sendMail('emails.contact_msg', array('content' => 'You got a new message from '.$msg->sender->firstname), array($msg->receiver->email, $msg->receiver->firstname), array('support@joinmyway.net', 'Your Team'), 'You got a new message from JoinMyWay');
		    		$msg->action = 1;
		    		$msg->save();
		    }
		}
    	catch(Exception $e) {
    		return false;
    	}

    	return true;
}

function sendVerificationLink($user)
{
	try {
		rFactory::sendMail('emails.auth.signup_verification', array('user' => $user->firstname, 'token' => $user->activation), array($user->email, $user->firstname), array('support@joinmyway.net', 'JoinMyWay Team'), 'Verification from JoinMyWay');
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}


?>