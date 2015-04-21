<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class locationModel extends Eloquent {

	use UserTrait, RemindableTrait;

    public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

    public function getTableName()
    {
        return $this->table;
    }

}
