<?php

class DonationCauseController extends BaseController {   

	public function create() {
		$dc_name = Input::get( 'dc-name' );
        $dc_desc = Input::get( 'dc-desc' );

        $dc_donation_url = Input::get( 'dc-donation-url' );
        $dc_instructions = Input::get( 'dc-instructions' );

        if ( Auth::guest() ) {
            /////// Create User of type donationcause_adder

            $dcadder_first_name = Input::get('dcadder-first-name');
            $dcadder_last_name = Input::get('dcadder-last-name');
            $dcadder_mobile = Input::get('dcadder-mobile');

            $dcadder_obj = User::createDCAdderAndSave($dcadder_first_name, $dcadder_last_name, $dcadder_mobile);

            // =====[start]================================================
            // Manually logging in user and 'Remember me' = true. 
            // So no need to use Auth::attempt
            Auth::login($dcadder_obj, true);
            // =====[end]================================================
        } 
 
        if ( Auth::guest() ) {
            dd('why is there no Authenticated User here');
        }

        if ( !Auth::user()->donationcause_adder ) {
            Auth::user()->makeDonationCauseAdder();
        }

        // Storing the image
        $dc_img_file = Input::file( 'dc-img-file' );

        DonationCause::createNewForPosterFromImgFile($dc_name, $dc_desc, $dc_img_file, $dc_donation_url, $dc_instructions, Auth::user()->id);

        return Redirect::route('donate');
	}

    public function edit() {
        Log::info("editing");

        $dc_id = Input::get( 'dc-id' );
        $dc_name = Input::get( 'dc-name' );
        $dc_desc = Input::get( 'dc-desc' );

        // Storing the image
        $dc_img_file = Input::file( 'dc-img-file' );
        $dc_img_url = Helper::moveImgFileAndGetURL($dc_img_file, $dc_id);

        Log::info($dc_img_url);

        $dc_donation_url = Input::get( 'dc-donation-url' );
        $dc_instructions = Input::get( 'dc-instructions' );

        DonationCause::updateWithID($dc_id, $dc_name, $dc_desc, $dc_img_url, $dc_donation_url, $dc_instructions);

        return Redirect::route('donation.channel.show', $dc_id);

    }

    public function delete($id) {
        DonationCause::find($id)->delete();
        return Redirect::to('dashboard');
    }



}