<?php
/**
 * Created by PhpStorm.
 * User: mohit
 */

class rFactory
{
    public function getInstance($name, $type)
    {
        return true;
    }
    
    public static function sendMail($layout, $layoutData = array(), $to = array('support@joinmyway.net', 'Join My Way'), $from = array('support@joinmyway.net', 'Join My Way'), $subject = "", $attachments = '', $cc = array()) 
    {
    	if ($subject == "") {
    		throw new Exception('Empty subject');
    	}
    	if (empty($to) || empty($from)) {
    		throw new Exception('Invalid Email');
    	}

		Mail::send($layout, $layoutData, function($message) use($to, $from, $subject, $attachments, $cc) {
			$message = $message->to($to[0])->from($from[0])->subject($subject);
			if ($attachments != '') {
				$message = $message->attach($attachments);
			}
			if (!empty($cc)) {
				$message = $message->cc($cc[0]);
			}
		});

		return true;
    }
}