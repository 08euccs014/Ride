<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 19/4/15
 * Time: 2:02 PM
 */

class trip extends lib
{
    public static $name = 'trip';

    public $user_id = 0;
    public $from = 0;
    public $to = 0;

    public function reset()
    {
        $this->user_id = 0;
        $this->from = 0;
        $this->to = 0;
    }

    public function from()
    {
        return location::getIntance($this->from);
    }

    public function to()
    {
        return location::getIntance($this->to);
    }
}