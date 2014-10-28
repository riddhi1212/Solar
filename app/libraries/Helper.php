<?php 

// TODO add in future (namespace Helpers;)

class Helper {


    // Returns Builder obj
    // you have to call ->get() on it. or you can append more queries.
    public static function searchTableForName($table_name, $name) {

        $find_first_name_arr = Helper::getFirstNameArrayFrom($name);
        $find_first_name_count = count($find_first_name_arr);
        $find_last_name = Helper::getDisplayLastNameFrom($name);

        

        Log::info("= in Helper::searchWName =");
        Log::info($find_first_name_arr);
        Log::info($find_last_name);

        if ($find_last_name === "") {
            // only one word name specified. I want to give user the benefit of the doubt and run this through first name and last name searches

            $find_first_name = $find_first_name_arr;

            Log::info("***(last name is empty)");
            Log::info($find_first_name);

            return DB::table($table_name)->whereRaw('(     first_name = ? or last_name = ? 
                                                        or first_name LIKE ?
                                                        or first_name LIKE ?
                                                        or first_name LIKE ?
                                                     )', array(
                                                        $find_first_name, $find_first_name,
                                                        $find_first_name . ' %', // starts with find_first_name
                                                        '% ' . $find_first_name . ' %', // middle word is find_first_name
                                                        '% ' . $find_first_name  // ends with find_first_name
                                                    )); 
        } elseif ( $find_first_name_count === 1 ) { // have one first_name word and one last_name word

            $find_first_name = $find_first_name_arr[0];

            // Yes if first-name matches and last-name = ""
            // Yes if first-name and last-name matches
            // Yes if first-name matches (our lastname) and last-name is empty 

            $first_name_last_name = $find_first_name . ' ' . $find_last_name;

            return DB::table($table_name)->whereRaw('(     ( first_name = ? and last_name = "" )
                                                        or ( first_name = ? and last_name = "" )
                                                        or ( first_name = ? and last_name = ? )
                                                        or ( first_name = ? )
                                                        or ( first_name LIKE ? )
                                                        or ( first_name LIKE ? )
                                                        or ( first_name LIKE ? )
                                                        or ( first_name LIKE ? and last_name = ? )
                                                        or ( first_name LIKE ? and last_name = ? )
                                                        or ( first_name LIKE ? and last_name = ? )
                                                     )', array(
                                                        $find_first_name, 
                                                        $find_last_name, // their first_name matches our_last_name
                                                        $find_first_name, $find_last_name,
                                                        $first_name_last_name, // equal to phrase
                                                        $first_name_last_name . ' %', // starts with
                                                        '% ' . $first_name_last_name . ' %', // middle phrase
                                                        '% ' . $first_name_last_name, // ends with
                                                        $find_first_name.' %', $find_last_name,  // starts with
                                                        '% '.$find_first_name.' %', $find_last_name,  // middle
                                                        '% '.$find_first_name, $find_last_name  // ends with
                                                    ));

        } else {
            Log::info("*******Find first name count is : ");
            Log::info($find_first_name_count);

            $first = $find_first_name_arr[0];
            $second = $find_first_name_arr[1];
            $last = $find_last_name;
            $first_second = $first . ' ' . $second;
            $first_second_last = $first_second . ' ' . $last;

            $results_first_second_last = DB::table($table_name)->whereRaw('(    ( first_name = ? and last_name = "" )
                                                                             or ( first_name = ? and last_name = "" )
                                                                             or ( first_name = ? and last_name = "" )
                                                                             or ( first_name = ? and last_name = ? )
                                                                             or ( first_name = ? and last_name = ? )
                                                                             or ( first_name = ? and last_name = ? )
                                                                             or ( first_name = ? and last_name = ? )
                                                                             or ( first_name LIKE ? and last_name = ? )
                                                                             or ( first_name LIKE ? and last_name = ? )
                                                                             or ( first_name LIKE ? and last_name = ? )
                                                                             or ( first_name = ? )
                                                                             or ( first_name LIKE ? )
                                                                             or ( first_name LIKE ? )
                                                                             or ( first_name LIKE ? )
                                                                             or ( first_name LIKE ? and last_name = ? )
                                                                         )', array(
                                                                            $first,
                                                                            $second,
                                                                            $last,
                                                                            $first, $second,
                                                                            $first, $last,
                                                                            $second, $last,
                                                                            $first_second, $last,  // equal to first_second
                                                                            '% ' . $first_second, $last,  // starts with first_second
                                                                            '% ' . $first_second . ' %', $last, // middle is first_second
                                                                            $first_second . ' %', $last, // ends with first_second
                                                                            $first_second_last,
                                                                            $first_second_last . ' %', // starts with
                                                                            ' %' . $first_second_last . ' %', // middle
                                                                            ' %' . $first_second_last,  // ends with
                                                                            $first . ' % ' . $second, $last
                                                                        ));


            if ($find_first_name_count === 2) {
                Log::info($first);
                Log::info($second);
                Log::info($last);

                return $results_first_second_last;

            } else {
                Log::info("******* [:(] BIG Find first name count of : ");
                Log::info($find_first_name_count);

                // first_name_count is 3 or more
                $third = $find_first_name_arr[2];
                $first_third = $first . ' ' . $third;

                return $results_first_second_last->orWhereRaw('   ( first_name = ? and last_name = "" )
                                                               or ( first_name = ? and last_name = ? )
                                                               or ( first_name = ? and last_name = ? )
                                                               or ( first_name = ? and last_name = ? )
                                                            ', array(
                                                                    $third,
                                                                    $third, $last,
                                                                    $first_second, $third,
                                                                    $first_third, $last
                                                            ));
            }
        }
    }

    // Returns Builder obj
    // you have to call ->get() on it. or you can append more queries.
    public static function searchTableForNameAndAge($table_name, $name, $age) {
        Log::info("= in Helper::searchWName AND Age =");
        Log::info($age);

        return Helper::searchTableForName($table_name, $name)->where('age', '=', $age);
    }



    /*

    Ali 19
        -   should match
            -   Ali                         19      DONE
            -   Ali Basher                  19      DONE
            -   Arif Ali                    19      DONE
            -   (first name spaces)
            -   Ali Arif Mohd               19      DONE
            -   Arif Ali Mohd               19      DONE
            -   Arif Mohd Ali               19      DONE
            -   One Two Three Ali           19      DONE
            -   Ali One Two Three           19      DONE
        -   should not match
            -   ( think ! )


        -   where ( first_name = "sandeep"              // exact match
                 or first_name LIKE "sandeep %"         // first word
                 or first_name LIKE "% sandeep"         // last word
                 or first_name LIKE "% sandeep %"       // middle word
                 or last_name = "sandeep" );


    Mihir Ali 19 
        -   should match
            -   Mihir               19          DONE
            -   Mihir Ali           19          DONE
            -   Ali                 19          DONE
            -   Mihir Ali Khan      19          DONE
            -   Mihir Khan Ali      19          DONE
            -   Dr. Mihir Ali       19          DONE
            -   
            -   One Mihir Ali last              DONE
            -   Mihir Ali one two               DONE
            -   one two Mihir Ali               DONE
        -   should not match
            -   Ali ban     19
            -   Mihir Pu    19
            -   Sub Ali     19
            -   Ali mihir   19 (????)


    Mohd Arif Ali               19
        -   should match
            -   Mohd            19              DONE
            -   Arif            19              DONE
            -   Ali             19              DONE
            -   Mohd Arif       19              DONE
            -   Mohd Ali        19              DONE
            -   Arif Ali        19 (????)       DONE
            -   (first name spaces)
            -   Mohd Arif Ali                   DONE
            -   Mohd Arif Ali Khan              DONE
            -   Mohd Arif Ahmed Ali             DONE
            -   Mohd Khan Arif Ali              DONE     // starts_with first. ends_with second. last
        -   should not match
            -   Mohd Basher     19
            -   Ali Mohd        19
            -   Arif Mohd       19
            -   Ba Mohd         19
            -   Arif basher     19
            -   
            -   (first name spaces)
            -   Abdul Arif Mohd         19
            -   Arif Ali Mohd           19

    (Mrs Bashir Ahemed Banu)
    Dr Sp Sandeep Kaur               (Dr Sandeep Kaur)
        -   try listing out should matches
            -   Dr
            -   Sp
            -   Sandeep
            -   Kaur
            -   Dr Kaur
            -   Sp Kaur                 (????) -> maybe not
            -   Sandeep Kaur
            -   Dr Sp
        ->   Dr Sandeep Kaur
            -   Dr
            -   Sandeep
            -   Kaur
            -   Dr Sandeep
            -   Dr Kaur
            -   Sandeep Kaur
            -   Dr Sandeep Kaur
        ->   Dr Sp Kaur
            -   Dr
            -   Sp
            -   Kaur
            -   Dr Sp
            -   Dr Kaur
            -   Sp Kaur
            -   Dr Sp Kaur
        -   Put together without repetitions            matched-by          matches
            -   Dr                                         DONE             DONE
            -   Sp                                         DONE             DONE
            -   Sandeep                                    DONE             DONE
            -   Kaur                                       DONE             DONE
            -   Dr Sp                                      DONE             DONE
            -   Dr Sandeep        :()                       :(              :()
            -   Sp Kaur                                    DONE             DONE
            -   Dr Kaur                                    DONE             DONE
            -   Sandeep Kaur                               DONE             DONE
            -   Dr Sp Kaur                                 DONE             DONE
            -   Dr Sandeep Kaur                            DONE             DONE
            -   Dr Sp Sandeep                              DONE             DONE

        -   should not match
            -   everything else


    */



	// assumes $obj has the following cols :
	//					$first_name
	//					$last_name
	//					$first_name_has_spaces
	//	Returns nothing
	public static function setFirstAndLastNameFor($name_str, $obj) {
		$first_name = "";
		$last_name = "";
		$first_name_has_spaces = false;

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) === 1) {
        	$first_name = $name_str;
        } elseif (count($name_arr) === 2) {
        	$first_name_arr = array_splice($name_arr, 0, 1 );
        	$first_name = join('', $first_name_arr);

        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        } else {
        	$first_name_has_spaces = true;

        	$first_name_arr = array_splice($name_arr, 0, count($name_arr)-1 );
        	$first_name = join(' ', $first_name_arr);
        	
        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        }

        $obj->first_name = $first_name;
        $obj->last_name = $last_name;
        $obj->first_name_has_spaces = $first_name_has_spaces;
	}

    // returns array
    public static function getFirstNameArrayFrom($name_str) {
        $name_arr = explode(' ', $name_str);

        if (count($name_arr) === 1) {
            return $name_str;
        } else {
            return array_splice($name_arr, 0, count($name_arr)-1 );
        }
    }


	// Purely for display purposes
    public static function getDisplayFirstNameFrom($name_str) {
        $first_name = "";

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) === 1) {
        	$first_name = $name_str;
        } else {
        	$first_name_arr = array_splice($name_arr, 0, count($name_arr)-1 );
        	$first_name = join(' ', $first_name_arr);
        }

        return $first_name;
    }

	// Purely for display purposes
    public static function getDisplayLastNameFrom($name_str) {
        $last_name = "";

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) > 1) {
        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        }

        return $last_name;
    }

    // ============================================================
    //          CSV file reading from contributors for Army Updates
    // ============================================================

    // returns the file as an array of listing arrays
    private static function readCSV($csvFile) {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return array_slice($line_of_text,1); // excluding row 0 because that has the col names
    }

    // CSV format
    // | s-no |  first-name  | last-name |  age  |  address | fb-url  |  child  |
    public static function createArmyUpdatesFromFileForContributor($csvFile, $contributor_id) {
 
        $csv = Helper::readCSV($csvFile);
 
        foreach ($csv as $listing) {
            Helper::createFromCSVFormat1($listing, $contributor_id);
        }
    }

    // | s-no |  first-name  | last-name |  age  |  address | fb-url  |  child  |
    private static function createFromCSVFormat1($listing, $contributor_id) {
        $s_no = $listing[0];
        $first_name = $listing[1];
        $last_name = $listing[2];
        $age = $listing[3];
        $fb_url = $listing[5];

        // TODO: add col address and w-child and additional

        $update = ArmyUpdates::createNewForContributor(
                                    $s_no,
                                    $first_name,
                                    $last_name,
                                    $age,
                                    $fb_url,
                                    $contributor_id
                                );
    }

    // TODO : create Format3 where they just contribute 'name' and I programmatically break it into first-name and last-name

    public static function createArmyUpdatesFromFile($csvFile) {
 
        $csv = Helper::readCSV($csvFile);

        foreach ($csv as $listing) {
            Helper::createFromCSVFormat2($listing);
        }
    }



    // Contributor fname,lname,mob,S.no.,First name,Last name,Child,Age,Address,City,FB URL,w Child ?,Additional
    private static function createFromCSVFormat2($listing) {
        $contributor_fname = $listing[0];
        $contributor_lname = $listing[1];
        $contributor_mob = $listing[2];
        $s_no = $listing[3];
        $first_name = $listing[4];
        $last_name = $listing[5];
        $age = $listing[7];
        $fb_url = $listing[10];
        $w_child = $listing[11];

        $contributor = User::createContributorIfNotExists($contributor_fname, $contributor_lname, $contributor_mob);

        // TODO: add col address and w-child and additional

        $update = ArmyUpdates::createNewForContributor(
                                    $s_no,
                                    $first_name,
                                    $last_name,
                                    $age,
                                    $fb_url,
                                    $contributor->id
                                );
    }


    public static function moveImgFileAndGetURL($dc_img_file, $dc_id) {
        $dc_img_url = NULL;
        if ($dc_img_file) {
            Log::info("inside if statement. So some file was uploaded");
            $image_file_name = 'DC_id_' . $dc_id . '.' . $dc_img_file->guessClientExtension();
            $image_file_location = 'images/DC_photos/';
            $dc_img_file->move($image_file_location, $image_file_name);

            if (Auth::user()->img_url) {
                // delete old upload
                unlink(app_path().'/../public/'.Auth::user()->img_url);
            }
            $dc_img_url = '/' . $image_file_location . $image_file_name;
        }
        return $dc_img_url;
    }

    public static function moveImgFileAndGetURLFor($prefix, $img_file, $id) {
        $img_url = NULL;
        if ($img_file) {
            Log::info("inside if statement. So some file was uploaded");
            $image_file_name = $prefix . '_id_' . $id . '.' . $img_file->guessClientExtension();
            $image_file_location = 'images/' . $prefix . '_photos/';
            $img_file->move($image_file_location, $image_file_name);
            $img_url = '/' . $image_file_location . $image_file_name;
        }
        return $img_url;
    }
 

}
