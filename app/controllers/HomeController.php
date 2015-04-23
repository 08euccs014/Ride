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
		$riders =  array( 
											array('name' => 'jimmy', 'vehical' => 'innova' ),
											array('name' => 'tomy', 'vehical' => 'ciaz' )
										) ;

        $riderModel = App::make('riderModel');
        $riders = $riderModel->getRiders();
        $pagination = $riderModel->getPagination();

		$data = array('riders' => $riders, 'pagination' =>$pagination);
		return View::make('home', $data);
	}

    public function aboutus()
    {
        return View::make('informations/aboutus');
    }

}
