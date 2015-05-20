<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class riderModel extends Eloquent implements UserInterface, RemindableInterface {

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
	protected $hidden = array('password' ,'remember_token');

    public $pagination = "";

    public function getTableName()
    {
        return $this->table;
    }

    public function getRiders($filters = array())
    {
    	$user = Auth::user();
    	try{
		if(!empty($filters)) {
			$from 	= App::make('locationModel')->getRecords($filters['ridefrom']['lat'],$filters['ridefrom']['lng']);
			$to   		= App::make('locationModel')->getRecords($filters['rideto']['lat'],$filters['rideto']['lng']);
           
			if ( empty($from) || empty($to) ){
				throw new Exception('No User Available');
			}

			foreach ($from as $loc) {
           		$startPoints[] = $loc->id;
			}
			foreach ($to as $loc) {
				$endPoints[] = $loc->id;
			}

			$riderRecords = App::make('tripModel')->getRidersWithin($startPoints, $endPoints);
			
			if ( empty($riderRecords) ){
				throw new Exception('No User Available');
			}

			foreach ($riderRecords as $rider) {
				$riderIds[] = $rider->user_id;
			}

			$riders = $this->select('*')->whereIn('id', $riderIds)->where('group', '=', 0)->paginate(10);
		}
	    else {
			$riders = $this->select('*')->where('group', '=', 0)->paginate(10);
		}
    	}
    	catch (Exception $e) {
    		$riders = array();
    	}

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
