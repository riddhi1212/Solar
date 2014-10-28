<?php

class SessionController extends BaseController {   

	// TODO : DO these need to be here ????? Or in another controller ???

	public function showLogin()
	{
		if (Auth::check()) { // check if there is some user already authenticated
			return Redirect::route('dashboard');

			//return Redirect::to('dashboard')->with(......)



			// Example of passing parameters with Redirect::to
			// These can be accessed by Session::get('username')
			//	->with('username', Auth::user()->fname)
		}

		// show the form
		return View::make('showlogin');
	}

	// Returns if Auth was successful or not
	public function doLogin()
	{
		// process the form

		// validate the info, create rules for the inputs
		$rules = array(
			'fname'    => 'required', // make sure the email is an actual email
			'mobile' => 'required|integer' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('mobile')); // send back the input (not the password) so that we can repopulate the form
		} else {

			$plaintext_pwd = Input::get('mobile');

			// create our user data for the authentication
			$userdata = array(
				'fname' 	=> Input::get('fname'),
				'password' 	=> $plaintext_pwd
			);

			// attempt to do the login
			// 'remember me' activated
			if (Auth::attempt($userdata, true)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return Redirect::route('dashboard');

				//return true;

			} else {
				// validation not successful, send back to form	
				return Redirect::to('login')
					->withInput(Input::except('mobile'));;

				//return false;
			}
		}
	}

	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('login'); // redirect the user to the login screen
	}

}