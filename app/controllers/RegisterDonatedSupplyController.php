<?php

class RegisterDonatedSupplyController extends BaseController {   

	public function create() {
		$supply_number_arr = Input::get( 'supply-number' );
        $supply_name_arr = Input::get( 'supply-name' );
        $comments = Input::get( 'comments' );
        $receipt_file = Input::file( 'receipt-file' );

        Log::info($supply_number_arr);
        Log::info($supply_name_arr);

        $supplies_arr = array();

        foreach ($supply_number_arr as $idx => $supply_number) {
            $supply_name = $supply_name_arr[$idx];
            if ($supply_number > 0)
                $supplies_arr[$supply_number] = $supply_name;
        }

        Log::info($supplies_arr);

        if ( Auth::guest() ) {
            /////// Create User of type donated_supply_registerer

            $guest_first_name = Input::get('guest-first-name');
            $guest_last_name = Input::get('guest-last-name');
            $guest_mobile = Input::get('guest-mobile');

            $guest_obj = User::createAndSave($guest_first_name, $guest_last_name, $guest_mobile);

            // =====[start]================================================
            // Manually logging in user and 'Remember me' = true. 
            // So no need to use Auth::attempt
            Auth::login($guest_obj, true);
            // =====[end]================================================
        } 
 
        if ( Auth::guest() ) {
            dd('why is there no Authenticated User here');
        }

        RegisteredDonatedSupplyExpanded::createNew(Auth::user()->id, $supplies_arr, $comments, $receipt_file);

        return Redirect::route('donate.supplies');
	}


}