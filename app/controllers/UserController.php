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
        $user = rider::getIntance();
        $user->firstname = $userData['firstname'];
        $user->lastname  = $userData['lastname'];
        $user->gender    = $userData['gender'];
        $user->group    = $userData['group'];
        $user->email     = $userData['email'];
        $user->phone     = $userData['contact'];
        $user->username  = $userData['username'];
        $user->password  = md5($userData['password']);
        $user->lastname  = $userData['lastname'];

        $user->save();

        return $user;
    }

    private function saveLocation($locationData = array(), $user)
    {
        $locationFrom = location::getIntance();
        $locationFrom->latitude = $locationData['ridefrom']['lat'];
        $locationFrom->longitude = $locationData['ridefrom']['lng'];
        $locationFrom->description = $locationData['ridefrom']['loc'];
        $locationFrom->save();

        $locationTo = location::getIntance();
        $locationTo->latitude = $locationData['rideto']['lat'];
        $locationTo->longitude = $locationData['rideto']['lng'];
        $locationTo->description = $locationData['rideto']['loc'];
        $locationTo->save();

        $trip           = trip::getIntance();
        $trip->user_id  = $user->getId();
        $trip->from     = $locationFrom->getId();
        $trip->to       = $locationTo->getId();
        $trip->save();

        return true;

    }
}
