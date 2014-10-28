<?php


class FoundPeople extends Eloquent {

	//protected $fillable = ['first-name', 'age', 'finder_id'];

    const TABLE_NAME = 'FoundPeopleTable';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = FoundPeople::TABLE_NAME;

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

    public function getFinderID() {
        return $this->finder_id;
    }

    public function getFinder() {
        return User::find($this->getFinderID());
    }

    public function addedByCurrentUser() {
        if ($this->getFinderID() == Auth::user()->id)
            return true;
        else
            return false;
    }

    // each FOP can hasMany FIP reports
    public function fips() {
        return $this->hasMany('FindPeople', 'found_table_id')
                    ->where('found_in_found_people', '=', true);  
    }
    
    // returns a User obj
    // TODO : assert if this is always of type Looker, because only Lookers can claim FOPs
    public function getClaimer() {
        $original_fip = $this->fips()
                             ->where('duplicate', '=', false)  // Query Builder
                             ->first();  

        return User::find($original_fip->getLookerID());
    }

	// ===============================================================
	//			Static Methods
	// ===============================================================

    // returns created $fop
    public static function createNewForFinder($name, $age, $father_name, $finder_id) {
        $fop = new FoundPeople;

        Helper::setFirstAndLastNameFor($name, $fop);

        $fop->age = $age;
        $fop->father_name = $father_name;
        $fop->finder_id = $finder_id;
        $fop->save();
        return $fop;
    }


	// returns a results array
	// Called from FindPeopleController when posting a new Missing Person Report
    public static function searchWithNameAndAge($find_name, $find_age) {
        return FoundPeople::searchWithParam($find_name, $find_age);
    }

    // returns a results array
    // TODO : add more searchable params here
    public static function searchWithParam($find_name, $find_age) {
        return FoundPeople::getBuilderWithParam($find_name, $find_age)->get();
    }

	// returns a chainable Builder object
    // example: the output of FOP::where() ... ->get() has not been called yet
    // TODO explanation
    private static function getBuilderWithParam($find_name, $find_age) {

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
            // $results = FoundPeople::whereRaw('first_name LIKE ? and last_name LIKE ?', array(
            //                                     '%'.$find_first_name.'%', '%'.$find_last_name.'%'
            //                                 ));

            $results = Helper::searchTableForName(FoundPeople::TABLE_NAME, $find_name);

            // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = FoundPeople::where('age', '=', $find_age);
        } elseif ($name && $age) {
            // Name, Age Specified

            // $results = FoundPeople::whereRaw('( first_name LIKE ? and last_name LIKE ? ) and age = ?', array(
            //                             '%'.$find_first_name.'%', '%'.$find_last_name.'%', $find_age
            //                         ));

            $results = Helper::searchTableForNameAndAge(FoundPeople::TABLE_NAME, $find_name, $find_age);

            // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}
