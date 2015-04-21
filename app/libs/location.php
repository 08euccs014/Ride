<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 19/4/15
 * Time: 2:02 PM
 */

class location extends lib
{
    public static $name = 'location';

    public $latitude = '';
    public $longitude = '';
    public $description = '';

    public function reset()
    {
        $this->latitude = '';
        $this->longitude = '';
        $this->description = '';
    }

}