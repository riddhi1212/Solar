<?php

class UsersController extends BaseController {   


	// POST from Contact Me form
	public function contactMe() {
    	$purpose = Input::get( 'purpose' );
        $text_body = Input::get( 'comments' );
        $guest_first_name = Input::get('guest-first-name');
        $guest_last_name = Input::get('guest-last-name');
        $guest_mobile = Input::get('guest-mobile');

        $commenter_first_name = NULL;
        $commenter_last_name = '';
        $commenter_mobile = NULL;
        $is_guest = true;

        if (Auth::user()) {
        	$commenter_first_name = Auth::user()->fname;
        	$commenter_last_name = Auth::user()->lname;
        	$commenter_mobile = Auth::user()->mobile;
        	$is_guest = false;
        } else {
        	$commenter_first_name = $guest_first_name;
        	$commenter_last_name = $guest_last_name;
        	$commenter_mobile = $guest_mobile;
        }

        ContactMe::createNew($purpose, $text_body, $commenter_first_name, $commenter_last_name, $commenter_mobile, $is_guest);

        $response = array(
        	'status' => 'success'
        );

        return Response::json( $response );

	}

}