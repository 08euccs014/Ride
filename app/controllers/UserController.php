<?php

class UserController extends BaseController {

    public function signupForm()
    {
        return View::make('rider/signup');
    }

	public function signup()
	{
        $postData = Input::get('userdata', array());

        //let's sanitize the data
        $postData = $this->sanitize($postData);

        $user   = $this->createUser($postData);
        $this->saveLocation($postData, $user);

	    return Response::json(array('status' => 1, 'message' => 'successfully registered', 'url' => url('/')));
	}

    /**
     * it will filter all the infected user provided data
     * @param array $dirtyData
     * @return array
     */
    public function sanitize($dirtyData = array())
    {
        return $dirtyData;
    }

    private function createUser($userData = array())
    {
        $user = rider::getInstance();
        $user->firstname = $userData['firstname'];
        $user->lastname  = $userData['lastname'];
        $user->gender    = $userData['gender'];
        $user->group    = $userData['group'];
        $user->email     = $userData['email'];
        $user->phone     = $userData['contact'];
        $user->username  = $userData['username'];
        $user->password  = Hash::make($userData['password']);
        $user->lastname  = $userData['lastname'];

        $user->save();

        return $user;
    }

    private function saveLocation($locationData = array(), $user)
    {
        $locationFrom = location::getInstance();
        $locationFrom->latitude = $locationData['ridefrom']['lat'];
        $locationFrom->longitude = $locationData['ridefrom']['lng'];
        $locationFrom->description = $locationData['ridefrom']['loc'];
        $locationFrom->save();

        $locationTo = location::getInstance();
        $locationTo->latitude = $locationData['rideto']['lat'];
        $locationTo->longitude = $locationData['rideto']['lng'];
        $locationTo->description = $locationData['rideto']['loc'];
        $locationTo->save();

        $trip           = trip::getInstance();
        $trip->user_id  = $user->getId();
        $trip->from     = $locationFrom->getId();
        $trip->to       = $locationTo->getId();
        $trip->save();

        return true;

    }

    public function loginForm()
    {
        return View::make('rider/login');
    }

    public function login()
    {
        $postData = Input::get('userdata', array());

        //let's sanitize the data
        $postData = $this->sanitize($postData);

        $password = $postData['password'];

        //do the login code here
        if (Auth::attempt(array('email' => $postData['email'], 'password' => $password ))) {
            $res = true;
            $msg = 'successfully login';
        }
        else {
            $res = false;
            $msg = 'Try again';
        }

        return Response::json(array('status' => $res, 'message' => $msg, 'url' => url('/')));
    }

    public function contact()
    {
        $userLoggedIn = Auth::user();
        $res          = false;
        $msg          = "Hi fella, You need to logged in to view details.";
        $content      = "";
        $url          = url('login');
        $js 				= "";

        if(!empty($userLoggedIn)) {
            $res = true;
            $msg = "You are authorized to see these details";

            $riderId = Input::get('riderId', 0);
            if ($riderId == 0) {
                $res = false;
                $msg = "Sorry!, You are not authorized to see his details";
                Session::put('message', $msg);
            }
            else {

                $rider      = rider::getInstance($riderId);
                if ($rider->gender != $userLoggedIn->gender) {
                	$msg = "Sorry!, Only same gender user are allowed to view this profile.";
                	$content    = View::make('rider/contact', array('error'=> $msg))->render();
                }
                else {
	           	    $data       = array('rider' => $rider);
	                $content    = View::make('rider/contact',$data)->render();
                }
                $js         = "$('#riderModal').modal('show');";
            }
        }
		else{
			Session::put('message', $msg);
		}
        return Response::json(array('status' => $res, 'message' => $msg, 'content' => $content, 'redirectUrl' => $url, 'js' => $js));
    }
    
    public function logout()
    {
    	Auth::logout();
    	return Redirect::to('/');
    }
    public function passwdReqForm()
    {
        $data = array('request'=>true);
    	return View::make('rider/password_reset',$data);
    }
    
    public function passwdResetReq()
    {

        $response=Password::remind(Input::only('email'), function($message)
        {
            $message->subject('Password Reset');
        });
        switch ($response)
        {
            case Password::INVALID_USER:
                Session::flash('error', Lang::get($response));
            case Password::REMINDER_SENT:
                Session::flash('success', Lang::get($response));
        }

    	return $this->passwdReqForm();
    }

    public function passwdResetForm($token = '')
    {
        $data = array('reset'=> true,'token' => $token);
        return View::make('rider/password_reset',$data);
    }

    public function passwdResetDone()
    {
        $email          = Input::get('email', '');
        $password       = Input::get('password', '');
        $passwordCnfrm  = Input::get('password_confirmation', '');
        $token          = Input::get('token', '');

        $credentials = array('email' => $email, 'password' => $password, 'password_confirmation' => $passwordCnfrm, 'token' => $token);

        $res = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();

        });

        if($res == 'reminders.reset') {
            Session::flash('success', Lang::get('Your password has been reset'));
            return Redirect::to('login');
        }
		else{
            Session::flash('error', Lang::get('Kindly, Try again there is some error while resetting password'));

            return Redirect::action('UserController@passwdResetForm', array($token));
        }
    }

    public function sendContactMsg()
    {
    	$userId = Input::get('userId', 0);
    	$contactMsg = Input::get('msg', '');

    	$rider = rider::getInstance($userId);

    	try {
    		rFactory::sendMail('emails.contact_msg', array('content' => $contactMsg), array($rider->email, $rider->firstname), array('support@joinmyway.net', 'Your Team'), 'You got a new message from JoinMyWay');
    	}
    	catch(Exception $e) {
    		return Response::json(array('status' => 0));
    	}
    	return Response::json(array('status' => 1));
    	
    	
    } 
}