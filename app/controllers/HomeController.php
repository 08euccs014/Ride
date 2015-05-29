<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home()
	{

        $filters     = Input::get('searchdata', array());

        $user        = Auth::user();
        $riderModel  = App::make('riderModel');
        $riders      = $riderModel->getRiders($filters);
        $pagination  = $riderModel->getPagination();
		$data        = array('riders' => $riders, 'pagination' =>$pagination, 'loggedUser' =>$user, 'filters' => $filters);

		return View::make('home', $data);
	}

    public function aboutus()
    {
        return View::make('informations/aboutus');
    }
    
    public function sendFeedback()
    {
    	$msg = Input::get('feedback', '');
    	$from = Input::get('from', '');
    	try {
    		rFactory::sendMail('emails.feedback', array('content' => $msg), array('support@joinmyway.net', 'Feedback'), array($from, 'Feedback'), 'Feedback');
    	}
    	catch(Exception $e) {
    		return Response::json(array('status' => 0));
    	}
    	return Response::json(array('status' => 1));
    }

}
