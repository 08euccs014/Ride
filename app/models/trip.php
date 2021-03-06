<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class tripModel extends Eloquent {

	use UserTrait, RemindableTrait;

    public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'trips';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function getTableName()
    {
        return $this->table;
    }

    public function getRidersWithin($startPoints, $endPoints)
    {
    	$riders = $this->select('user_id')->whereIn('from', $startPoints)->whereIn('to', $endPoints)->get()->all();

    	return $riders;
    }

}
