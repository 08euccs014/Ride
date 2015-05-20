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

    
    public function getRecords($lat, $lng, $range = 5)
    {
		$query = "SELECT id, ( 6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians(longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM locations HAVING distance < $range ORDER BY distance";
		
        //To search by kilometers instead of miles, replace 3959 with 6371.
        $locations = DB::select($query);

        return $locations;
    }
}

