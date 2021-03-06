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
	protected $hidden = array('remember_token');

    public $pagination = "";

    public function getTableName()
    {
        return $this->table;
    }

    public function getRiders($filters = array())
    {
    	$user = Auth::user();
    	try{
    		
    		
    	$loggedIn = 0;
    	if (isset($user)) {
    		$loggedIn = $user->id;
    	}
    		
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
				if ($loggedIn != $rider->user_id) {
					$riderIds[] = $rider->user_id;
				}
			}

			$riders = $this->select('*')->whereIn('id', $riderIds)->where('verify', '=', 1)->orderBy('created_at', 'desc')->paginate(RIDER_PAGINATION);
		}
	    else {
			$riders = $this->select('*')->where('id', '!=', $loggedIn)->where('verify', '=', 1)->orderBy('created_at', 'desc')->paginate(RIDER_PAGINATION);
		}
    	}
    	catch (Exception $e) {
    		$riders = array();
    	}

        if(!empty($riders)) {
            $this->pagination = $riders->appends(array('searchdata' => $filters))->links();
        }

        return $riders;
    }

    public function getPagination()
    {
        return $this->pagination;
    }
    
    public function getRecords($filters = array(), $pagination = false)
    {
    	if (empty($filters)) {
    		if($pagination) {
    			$riders = $this->select('*')->paginate(RIDER_PAGINATION);
    		}
			else {
    			$riders = $this->select('*')->get()->all();
    		}
    	}
    	else {
    		$riders = $this->select('*');
    		foreach ($filters as $key => $value) {
    			$riders = $riders->where($key, $value[0], $value[1]);
    		}
    		if($pagination) {
    			$riders = $riders->paginate(RIDER_PAGINATION);
    		}else {
    			$riders = $riders->get()->all();
    		}
    	}
    	if($pagination && !empty($riders)) {
    		$this->pagination = $riders->appends(array('filter' => $filters))->links();
    	}
    	
    	return $riders;
    }
}
