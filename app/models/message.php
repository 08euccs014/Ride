<?php

class messageModel extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

    public $pagination = "";

    public function getTableName()
    {
        return $this->table;
    }
    
    public function getPendingMessages()
    {
    	$messages = $this->where('status', '=', 0)->where('action', '=', 0)->take(10)->get()->all();

    	return $messages;
    }
    
    public function sender()
    {
    	return $this->belongsTo('riderModel', 'sender_id', 'id');
    }
    public function receiver()
    {
    	return $this->belongsTo('riderModel', 'receiver_id', 'id');
    }
}
