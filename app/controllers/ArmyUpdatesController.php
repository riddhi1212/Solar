<?php

class ArmyUpdatesController extends BaseController {   
    
    // This is the function a form button will POST to
    public function search() {
        //check if its our form  (prevents cross site injections)
        // TODO #7
        // if ( Session::token() !== Input::get( '_token' ) ) {
        //     return Response::json( array(
        //         'msg' => 'Unauthorized attempt to create option'
        //     ) );
        // }

        Log::info(Input::all());

        $updates_sno = Input::get('updates-sno');
        $updates_name = Input::get( 'updates-name' );
        $updates_age = Input::get( 'updates-age' );

        Log::info("===[AU Search]===");
        Log::info($updates_sno);
        Log::info($updates_name);
        Log::info($updates_age);

        $results = ArmyUpdates::searchWithParam($updates_sno, $updates_name, $updates_age);

        Log::info("===[AU Search Results]===");
        Log::info(json_encode($results));

        $response = array(
            'status' => 'success',
            'results' => json_encode($results)
        );
 
        return Response::json( $response );
    }

    // POSTed to from Contribute now form
    public function addContributor() {
        $contributor_first_name = Input::get('contributor-first-name');
        $contributor_last_name = Input::get('contributor-last-name');
        $contributor_mobile = Input::get('contributor-mobile');

        $contributor_obj = NULL;
        if ( Auth::guest() ) {
            $contributor_obj = User::createContributorAndSave($contributor_first_name, $contributor_last_name, $contributor_mobile);
            Auth::login($contributor_obj, true);
        } else {
            // A user is logged in already. The contributor name and mobile can be same or different
            // ONLY checking by mobile right now. TODO : check if this is OK
            if ( $contributor_mobile != Auth::user()->mobile ) {
                Log::info("mobile num not equal. MAKE NEW CONTRIB USER !!");

                // Using same contributor twice. Or uses existing user as contributor without knowing that they exist on this platform
                $contributor_obj = User::createContributorIfNotExists($contributor_first_name, $contributor_last_name, $contributor_mobile);
            } else {
                Log::info("mobile num equal. Auth is Contributor !! "); 
                $contributor_obj = Auth::user();
                $contributor_obj->makeContributor();
            }

        }

        $au_file = Input::file('au-file');

        $upload_number = Auth::user()->incrementUploadNumber();

        $new_file_name = $contributor_first_name . $contributor_mobile . '_uploaded_by_' . Auth::user()->fname . $upload_number . '.csv';
        $new_file_location = app_path() . '/database/seedAfterReview/';

        $au_file->move($new_file_location, $new_file_name);

        // I will review. No automatic upload
        //$file_full_path = $new_file_location . $new_file_name;
        //Helper::createArmyUpdatesFromFileForContributor($file_full_path, $contributor_obj->id);

        return Redirect::to('dashboard');
    }


}