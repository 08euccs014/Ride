<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class riderModel extends Eloquent {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'riders';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    public $pagination = "";

    public function getTableName()
    {
        return $this->table;
    }

    public function getRiders()
    {
        $riders = $this->select('*')->where('group', '=', 0)->paginate(10);

        if(!empty($riders)) {
            $this->pagination = $riders->links();
        }

        return $riders;
    }

    public function getPagination()
    {
        return $this->pagination;
    }
}
