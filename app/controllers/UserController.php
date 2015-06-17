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
        try {
        	$postData = $this->sanitize($postData, array('group', 'gender', 'firstname', 'timefrom', 'timeto', 'ridefrom', 'rideto', 'email', 'password'));
        }
        catch (Exception $e) {
        	return Response::json(array('status' => 0, 'message' => $e->getMessage()));
        }
        
        try {
	        $user   = $this->createUser($postData);
	        $this->saveLocation($postData, $user);
        }
        catch (Exception $e) {
        	return Response::json(array('status' => 0, 'message' => $e->getMessage()));
        }

		Event::fire('user.signup', array($user));
        
        $message = "Hurray! You have been <b>successfully registered</b>. One click <b>verification link</b> has been sent to your email.";
        Session::put('message', $message);
        
	    return Response::json(array('status' => 1, 'message' => 'successfully registered', 'url' => url('/')));
	}

    /**
     * it will filter all the infected user provided data
     * @param array $dirtyData
     * @return array
     */
    public function sanitize($dirtyData = array(), $requiredData = array())
    {
    	$sanitizedData = array();

    	foreach ($dirtyData as $key => $value) {
    		if (in_array($key, $requiredData)) {
    			if ( isset($dirtyData[$key]) && $dirtyData[$key] != null) {
    				$sanitizedData[$key] = $value;
    			}
    			else {
    				throw new Exception("$key can not be empty", '503');
    			}
    		}
    		$sanitizedData[$key] = $value;
    	}
    	 
        return $sanitizedData;
    }

    private function createUser($userData = array())
    {
		$model = App::make('riderModel');
		$riders = $model->getRecords(array('email' => array('=' , $userData['email'])));
		if (!empty($riders)) {
			$rider = array_pop($riders);
			 return rider::getInstance($rider->id);
		}
    	
        $user = rider::getInstance();
        $user->firstname = $userData['firstname'];
        $user->lastname  = $userData['lastname'];
        $user->gender    = $userData['gender'];
        $user->group    = $userData['group'];
        $user->email     = $userData['email'];
        $user->phone     = $userData['contact'];
        $user->username  = $userData['email'];
        $user->password  = Hash::make($userData['password']);
        $user->lastname  = $userData['lastname'];
        $currentDate = date('Y-m-d H:i:s');
        $user->activation =  md5($user->email.$currentDate);

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
        try {
        	$postData = $this->sanitize($postData, array('email', 'password'));
        }
        catch (Exception $e) {
        	return Response::json(array('status' => 0, 'message' => $e->getMessage()));
        }

        //do the login code here
        if (Auth::attempt(array('email' => $postData['email'], 'password' => $postData['password'] ))) {
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
	           	    $data       = array('rider' => $rider, 'userLoggedIn' => $userLoggedIn);
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
                Session::flash('success', Lang::get('Password reset link has been sent to your email account.'));
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
    	$receiverId = Input::get('receiverId', 0);
    	$senderId = Input::get('senderId', 0);
    	$contactMsg = Input::get('msg', '');
    	$replyToMsg = Input::get('replyToMsg', 0);
    	

    	try {
	    	$message = message::getInstance(0, array('sender_id' => $senderId, 'receiver_id' => $receiverId, 'content' => $contactMsg, 'parent_id' => $replyToMsg));
	    	$message->save();
    	}
    	catch(Exception $e) {
    		return Response::json(array('status' => 0));
    	}
    	return Response::json(array('status' => 1));
    } 
    
    public function displayMessages()
    {
		$loggedIn = Auth::user()->id;
		$rider  = rider::getInstance($loggedIn);
		$contacts = $rider->getContacts();
		
    	$data = array('userLoggedIn' => $rider, 'contacts' => $contacts);
    	return View::make('rider/message',$data);
    }
    
    private function verifyUser($id)
    {
		$user = rider::getInstance($id);
		$user->verify = 1;		
		return $user->save();
    }

    public function userVerification($token = '')
    {
    	if($token) {
    		$userModel = App::make('riderModel');
    		$records = $userModel->getRecords(array('activation' => array('=', $token)));
    		if(empty($records)) {
    			return View::make('error.system_error', array('error' => array('heading'=>'Broken verification link', 'description' => 'kindly try again or contact us.') ));
    		}
    		$record = array_pop($records);
    		$this->verifyUser($record->id);

    		$msg = "Hurray, You have <b>successfully verified,</b> your email. Kindly proceed to login.";
    		Session::put('message', $msg);

    		return Redirect::to('login');
    	}

    	return View::make('error.system_error', array('error' => array('heading'=>'Broken verification link', 'description' => 'kindly try again or contact us.') ));
    }
    
    public function getConversation()
    {
    	$contactId = Input::get('contactId', 0);
    	
    	if ($contactId == 0) {
    		return Response::json(array('status' => 0));
    	}
    	
   		$loggedIn = Auth::user()->id;
		$rider  = rider::getInstance($loggedIn);
		$messages = $rider->getMessages($contactId);
    	
		return Response::json(array('status' => 1, 'content' => $messages));
    }
}