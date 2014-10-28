<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class FindPeople extends Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	//protected $fillable = ['first-name', 'age', 'looker-id'];

    const TABLE_NAME = 'FindPeopleTable';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = FindPeople::TABLE_NAME;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');


    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getFullName() {
        $name = $this->getFirstName();
        if ($this->getLastName() !== null) {
            $name = $name . " " . $this->getLastName();
        }
        return $name;
    }

    public function getDescription() {
        return $this->description;
    }
    

    public function addedByCurrentUser() {
        if ($this->getLookerID() == Auth::user()->id)
            return true;
        else
            return false;
    }

	// each FIP hasMany matches
	public function matches() {
		return $this->hasMany('Match', 'fip_id');  
	}

	public function getLookerID() {
		return $this->looker_id;
	}

	public function getLooker() {
		return User::find($this->getLookerID());
	}

    // ASSUMES $this->found = true; 
    public function getMatchTableName() {
        if ($this->found) {
            if ($this->found_in_army_updates)
                return ArmyUpdates::TABLE_NAME;
            elseif ($this->found_in_found_people)
                return FoundPeople::TABLE_NAME;
            else
                return NULL; // this should never happen (by design)
        }
        return NULL; // this should never happen (by assumption)
    }

    // ASSUMES $this->found = true; 
    public function getFoundTablePostURL() {
        if ($this->found) {
            if ($this->found_in_army_updates)
                return ArmyUpdates::find($this->found_table_id)->fb_url;
            elseif ($this->found_in_found_people)
                return "foundperson/show/" . $this->found_table_id;
            else
                return NULL; // this should never happen (by design)
        }
        return NULL; // this should never happen (by assumption)
    }

    // takes a single result
    public function createNewMatch($match_table, $found) {
        Log::info("*********************[Creating new match]*********************");
        Log::info("********[found]************");
        Log::info($found);
        $match = new Match;
        $match->fip_id = $this->id;
        $match->match_table_id = $found['id']; // TODO try $found->id
        if ($match_table == ArmyUpdates::TABLE_NAME) {
            $match->match_army_update = true;
        } elseif ($match_table == FoundPeople::TABLE_NAME) {
            $match->match_found_person = true;
        }
        $match->save();
    }


    // takes an array of results
	public function createNewMatches($match_table, $found_results) {

		foreach ($found_results as $found) {
            $this->createNewMatch($match_table, $found);
		}

		$this->getLooker()->createNewMessageForLooker('New Matches', $match_table, count($found_results));
	}


	// ===============================================================
	//			Static Methods
	// ===============================================================


    // returns created $fip
    public static function createNewForLooker($name, $age, $looker_id) {
        $fip = new FindPeople;

        Helper::setFirstAndLastNameFor($name, $fip);

        $fip->age = $age;
        $fip->looker_id = $looker_id;
        $fip->save();
        return $fip;
    }


	// returns a results array
	// Called from FoundPeopleController when posting a new Found Person Report
    public static function searchWithNameAndAge($find_name, $find_age) {
        return FindPeople::searchWithParam($find_name, $find_age);
    }

    // returns a results array
    // TODO : add more searchable params here
    public static function searchWithParam($find_name, $find_age) {
        return FindPeople::getBuilderWithParam($find_name, $find_age)
                            ->where('deleted_at', '=', NULL)  // Important because FIP can be soft_deleted and raw mysql query does not care about that
                            ->get();
    }

	// returns a chainable Builder object
    // example: the output of FOP::where() ... ->get() has not been called yet
    // TODO explanation
    private static function getBuilderWithParam($find_name, $find_age) {

        Log::info("*********************[FindPeople::getBuilderWithParam]*********************");
        Log::info("********[find_name]************");
        Log::info($find_name);
        Log::info("********[find_age]************");
        Log::info($find_age);

        $name = false;
        $age = false;
        if ($find_name) { 
            $name = true;
        } 
        if ($find_age) {
            $age = true;
        }

        $results =  array();
        $explanation = "";
        if ($name && !$age) {
            // Only Name Specified

            // First-name and Last-name search
            // $results = DB::table('FoundPeople')
            //                     ->where('first-name', '=', $updates_name)
            //                     ->orWhere('last-name', '=', $updates_name)
            //                     ->get();

        	// Substr match
            // $results = FindPeople::whereRaw('first_name LIKE ? and last_name LIKE ?', array(
            //                                     '%'.$find_first_name.'%', '%'.$find_last_name.'%'
            //                                 ));

            $results = Helper::searchTableForName(FindPeople::TABLE_NAME, $find_name);

            // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = FindPeople::where('age', '=', $find_age);
        } elseif ($name && $age) {
            // Name, Age Specified

            // $results = FindPeople::whereRaw('( first_name LIKE ? and last_name LIKE ? ) and age = ?', array(
            //                             '%'.$find_first_name.'%', '%'.$find_last_name.'%', $find_age
            //                         ));

            $results = Helper::searchTableForNameAndAge(FindPeople::TABLE_NAME, $find_name, $find_age);

            // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}
