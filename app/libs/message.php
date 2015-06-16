<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 19/4/15
 * Time: 2:02 PM
 */

class message extends lib
{
    public static $name = 'message';

    public $sender_id = 0;
    public $receiver_id = 0;
    public $content = "";
    public $status = 0;
    public $action = 0;
    public $parent_id = 0;

    public function reset()
    {
        $this->sender_id = 0;
        $this->receiver_id = 0;
        $this->content = "";
        $this->status = 0;
        $this->action = 0;
        $this->parent_id = 0;
    }
    
    public function receiver()
    {
    	$receiver = rider::getInstance($this->receiver_id);
    	return $receiver;
    }

    public function sender()
    {
    	$sender = rider::getInstance($this->sender_id);
    	return $sender;
    }
}