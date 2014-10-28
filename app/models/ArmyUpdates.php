<?php


class ArmyUpdates extends Eloquent {

	//protected $fillable = ['first-name', 'age'];

    const TABLE_NAME = 'ArmyUpdatesTable';

    const SHOW_PER_PAGE = 25;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = ArmyUpdates::TABLE_NAME;



	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');


	public function setContributorID($id) {
		$this->contributor_id = $id;
        $this->save();
	}

    public function getFullName() {
        $name = $this->first_name;
        if ($this->last_name !== null) {
            $name = $name . " " . $this->last_name;
        }
        return $name;
    }

    // each AU hasMany FIP reports
    public function fips() {
        return $this->hasMany('FindPeople', 'found_table_id')
                    ->where('found_in_army_updates', '=', true);  
    }
    
    // returns a User obj
    // TODO : assert if this is always of type Looker, because only Lookers can claim AUs
    public function getClaimer() {
        $original_fip = $this->fips()
                             ->where('duplicate', '=', false)  // Query Builder
                             ->first();  

        return User::find($original_fip->getLookerID());
    }


	// ===============================================================
	//			Static Methods
	// ===============================================================


    // returns created $au
    // TODO : do programmatically split of first name and last name and set first_name_has_spaces
    public static function createNewForContributor($s_no, $first_name, $last_name, $age, $fb_url, $contributor_id) {
        
        $au = new ArmyUpdates;
        $au->s_no = $s_no;
        $au->first_name = $first_name;
        $au->last_name = $last_name;
        $au->age = $age;
        $au->fb_url = $fb_url;
        $au->contributor_id = $contributor_id;
        $au->save();
        return $au;

        // TODO : AUTO-RUN search against FIP DB here
    }

    // returns a results array
    public static function searchUnclaimedWithParam($find_sno, $find_name, $find_age) {
        return ArmyUpdates::getBuilderWithParam($find_sno, $find_name, $find_age)
                            ->where('claimed', '=', false)
                            ->get();
    }

    // returns a results array
    // Called from FindPeopleController::create
    public static function searchWithNameAndAge($find_name, $find_age) {
        return ArmyUpdates::searchWithParam("", $find_name, $find_age);
    }

    // returns a results array
    // TODO explanation
    // Called from ArmyUpdatesController. No matching capability yet? // TODO can add 'Claim' in future
    public static function searchWithParam($find_sno, $find_name, $find_age) {
        return ArmyUpdates::getBuilderWithParam($find_sno, $find_name, $find_age)->get();
    }

	// returns a chainable thingie. A Builder object I think
    // example: the output of AU::where() ... ->get() has not been called yet
    // TODO explanation
    private static function getBuilderWithParam($find_sno, $find_name, $find_age) {

        $sno = false;
        $name = false;
        $age = false;
        if ($find_name) {
            $name = true;
        } 
        if ($find_age) {
            $age = true;
        }
        if ($find_sno) {
            $sno = true;
        }


        $results =  ArmyUpdates::where('s_no', '=', 0); // This returns an empty Builder obj // TODO : figure out better way
        $explanation = "";
        if ($sno) {
            // This can only return one row (I think . TODO: check assumption)
            $results = ArmyUpdates::where('s_no', '=', $find_sno);

            $explanation = "Do not search on 'S.no.' and Another field together. 'S.no.' is unique for every update, so it will never match 2 records. This search is returning results for 'S.no.' = ".$find_sno.".";
        } elseif ($name && !$age) {
            // Only Name Specified

            $results = Helper::searchTableForName(ArmyUpdates::TABLE_NAME, $find_name);

            // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = ArmyUpdates::where('age', '=', $find_age);

        } elseif ($name && $age) {
            // Name, Age Specified

            $results = Helper::searchTableForNameAndAge(ArmyUpdates::TABLE_NAME, $find_name, $find_age);

            // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}


