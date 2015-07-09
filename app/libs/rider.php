<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 19/4/15
 * Time: 2:02 PM
 */

class rider extends lib
{
    public static $name = 'rider';

    public $username = '';
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $params = '';
    public $activation = '';
    public $sendconfimation = 0;
    public $block = 1;
    public $verify = 0;
    public $gender = 'M';
    public $group = 0;

    public function reset()
    {
        $this->username = '';
        $this->firstname = '';
        $this->lastname = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->params = '';
        $this->activation = '';
        $this->sendconfimation = 0;
        $this->block = 1;
        $this->verify = 0;
    }

    public function getTrip()
    {
        $tripModel  = App::make('tripModel');
        $trip       = $tripModel->select('id')->where('user_id', '=', $this->id)->first();
        if (empty($trip)) {
            return false;
        }
        $trip       = trip::getInstance($trip->id);
        return $trip;
    }
    
    //get the conversation messages of logged in with the receiver
    public function getMessages($receiverId)
    {
    	$messageModel  = App::make('messageModel');
    	$messages       = $messageModel->select('id', 'content', 'sender_id', 'receiver_id')->whereIn('receiver_id', array($receiverId, $this->id))->whereIn('sender_id', array($receiverId, $this->id))->orderBy('created_at')->get()->all();    	
    	return $messages; 
    }
    
    public function getContacts()
    {
    	$messageModel  	= App::make('messageModel');
    	$contactsIds        		= $messageModel->select('sender_id')->where('receiver_id', '=', $this->id)->groupBy('sender_id')->get()->all();    	
    	if (empty($contactsIds)) {
    		return false;
    	}
    	$contacts = array();
    	foreach ($contactsIds as $contact) {
    		$contacts[$contact->sender_id] = $this->getInstance($contact->sender_id); 
    	}

    	return $contacts;
    }

}