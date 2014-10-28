<?php


class Match extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'matches';

	// public function setUserID($id) {
	// 	$this->setAttribute('user-id', $id);
	// }

	public function getName() {
		if ($this->match_army_update) {
			return ArmyUpdates::find($this->match_table_id)->getFullName();
		}
		if ($this->match_found_person) {
			return FoundPeople::find($this->match_table_id)->getFullName();
		}
	}

	public function getAge() {
		if ($this->match_army_update) {
			return ArmyUpdates::find($this->match_table_id)->age;
		}
		if ($this->match_found_person) {
			return FoundPeople::find($this->match_table_id)->age;
		}
	}

	public function getSource() {
		if ($this->match_army_update) {
			return 'ARMY Updates';
		}
		if ($this->match_found_person) {
			return 'Found Person Record';
		}
	}

	// returns true or false
	public function isSourceClaimed() {
		if ($this->match_army_update) {
			return ArmyUpdates::find($this->match_table_id)->claimed;
		}
		if ($this->match_found_person) {
			return FoundPeople::find($this->match_table_id)->claimed;
		}
	}

	// Call isSourceClaimedFirst !!
	// this function assumes that source is claimed
	// returns User obj
	public function getSourceClaimer() {
		if ($this->match_army_update) {
			return ArmyUpdates::find($this->match_table_id)->getClaimer();
		}
		if ($this->match_found_person) {
			return FoundPeople::find($this->match_table_id)->getClaimer();
		}
	}

	// Call isSourceClaimedFirst !!
	// this function assumes that source is claimed
	// returns string
	public function getSourceClaimerName() {
		return $this->getSourceClaimer()->getFullName();
	}

	// returns true or false
	public function isSourceClaimerCurrentUser() {
		return ($this->getSourceClaimer()->id === Auth::user()->id);
	}


	// ===============================================================
	//			Static Methods
	// ===============================================================

	public static function deleteMatchesForFip($fip_id) {
		Match::where('fip_id', '=', $fip_id)->delete();
	}

	public static function deleteMatchesForFop($fop_id) {
		Match::where('match_found_person', '=', true)
			 ->where('match_table_id', '=', $fop_id)
		 	 ->delete();
	}

}
