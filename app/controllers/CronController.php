<?php

class CronController extends Controller {

	public function trigger()
	{
		//check the time between two successive cron time then trigger
		try{
			$result = Event::fire('cron.trigger');
		}
		catch (Exception $e) {
			return "cron execution have some problem".$e->getMessage();
		}
		return "cron executed successfully";
		
	}

}
