<?php

class FindPeopleController extends BaseController {   

    // public function add() {
    //     return View::make( 'options/new' );
    // }
    
    // POST to /find
    public function create() {
        //check if its our form 
        // TODO #7
        // if ( Session::token() !== Input::get( '_token' ) ) {
        //     return Response::json( array(
        //         'msg' => 'Unauthorized attempt to create option'
        //     ) );
        // }
 
        $find_name = Input::get( 'find-name' );
        $find_age = Input::get( 'find-age' );

        Log::info("===========================in FindPeopleController create [start]");
        Log::info($find_name);
        Log::info($find_age); // find_age is str

        // If not logged in, it could be New User or Returning User
        if ( Auth::guest() ) {
            /////// Create User of type Looker

            $looker_first_name = Input::get('looker-first-name');
            $looker_last_name = Input::get('looker-last-name');
            $looker_mobile = Input::get('looker-mobile');

            $returning_user = User::where('mobile', '=', $looker_mobile)->get()->first();
            if ( $returning_user ) {
                Auth::login($returning_user, true);
            } else {
                // New user
                $looker_obj = User::createLookerAndSave($looker_first_name, $looker_last_name, $looker_mobile);

                // Manually logging in user and 'Remember me' = true. 
                // So no need to use Auth::attempt
                Auth::login($looker_obj, true);
            }
        }

        if ( !Auth::user()->looker ) {
            Auth::user()->makeLooker();
        }

        // TODO: check for duplicates before creating another record
        $fip = FindPeople::createNewForLooker($find_name, $find_age, Auth::user()->id);

        // If we wanted to print the findPeople per user. 
        // $fp = User::find($looker_id)->findPeople()->get();
        // Log::info($fp);
 
        // Now that 'Looker' has created a new 'Fip', we should try to match this Fip against AU and FOP
        // TODO This code might need to move somewhere else 
        // Doing only AU for now. TODO do FOP 
        $au_search_results = ArmyUpdates::searchWithNameAndAge($find_name, $find_age);
        Log::info("==[AU search results]==");
        Log::info($au_search_results);

        // If the number of search_results > 0, i.e. matches found, create matches on FIP. (Alerts to FIP->Looker fired automatically)
        // FIP->hasMany(Matches)
        if (count($au_search_results))
            $fip->createNewMatches(ArmyUpdates::TABLE_NAME, $au_search_results);


        $fop_search_results = FoundPeople::searchWithNameAndAge($find_name, $find_age);
        if (count($fop_search_results)) {
            $fip->createNewMatches(FoundPeople::TABLE_NAME, $fop_search_results);
        }

        Log::info("========[in FindPeopleController -> fop__search_result is]==========");
        Log::info($fop_search_results);

        $num_matches = count($au_search_results) + count($fop_search_results);

        $response = array(
            'status' => 'success',
            'username' => Auth::user()->fname,
            'notificationCount' => $num_matches,
            'fname' => Helper::getDisplayFirstNameFrom($find_name),
            'lname' => Helper::getDisplayLastNameFrom($find_name),
            'age'   => $find_age,
            'msgCount' => Auth::user()->messages()->count(),
            'msg' => 'Person inserted in Find-People Table successfully', // figure out how to use this future-TODO
        );

        Log::info("===========================in FindPeopleController create [end]");

        return Response::json( $response );
    }

    // POST to /deletefip
    public function delete() {
        $fip_id = Input::get( 'fip-id' );
        $why = Input::get('why');

        Log::info("===========================in FindPeopleController delete [fip_id] is =>");
        Log::info($fip_id);
        Log::info($why);

        Match::deleteMatchesForFip($fip_id);

        $fip = FindPeople::find($fip_id);
        $fip->why = $why;
        $fip->save();
        $fip->delete();

        return Redirect::to('dashboard');
    }


    // POST to route('find.person.edit')
    public function edit() {
        $fip_id = Input::get( 'fip-id' );

        Log::info("===========================in FindPeopleController EDIT [fip_id] is =>");
        Log::info($fip_id);

        $fip = FindPeople::find($fip_id);

        // Storing the image
        $image_file = Input::file('fip-photo-file');
        if ($image_file) {
            $image_file_name = 'FIP_id_' . $fip_id . '.' . $image_file->guessClientExtension();
            $image_file_location = 'images/FIP_photos/';
            $image_file->move($image_file_location, $image_file_name);

            if ($fip->photo_url) {
                // delete old upload
                unlink(app_path().'/../public'.$fip->photo_url);
            }
            $fip->photo_url = '/' . $image_file_location . $image_file_name;
        }
        $fip->description = Input::get( 'fip-desc' );
        $fip->save();

        return Redirect::route('find.person.show', $fip_id);
    }


}