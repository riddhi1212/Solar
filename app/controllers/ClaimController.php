<?php

class ClaimController extends BaseController {   

	// this function is POSTed to
	// and return a JSON response
	public function claim() 
	{
		return $this->doClaim(false);
	}

	public function duplicateClaim() {
		return $this->doClaim(true);
	}

	private function doClaim($is_duplicate) {
		$claim_match_id = Input::get( 'match-id' );

		Log::info("======[claim_match_id]======");
		Log::info($claim_match_id);
		Log::info(Input::all());

		$match = Match::find($claim_match_id);
		$fip = FindPeople::find($match->fip_id);


		// MARK match as claimed and FIP as found
		$match->claimed = true;
		$match->save();
		$fip->found = true;
		$fip->duplicate = $is_duplicate;
		if ($match->match_army_update) {
			$fip->found_in_army_updates = true;

			$au = ArmyUpdates::find($match->match_table_id);
			$au->claimed = true;
			$au->save();

			// not deleting. allowing duplicate claims instead
			//Match::where('match_table_id', '=', $au->id)->delete();
		}
		if ($match->match_found_person) {
			$fip->found_in_found_people = true;

			$fop = FoundPeople::find($match->match_table_id);
			$fop->claimed = true;
			$fop->save();

			//Match::where('match_table_id', '=', $fop->id)->delete();
		}
		$fip->found_table_id = $match->match_table_id;
		$fip->save();

		Match::deleteMatchesForFip($fip->id);

		// TODO : also send back the id in the table it was matched to
		// Turn into Found

		$response = array(
            'status' => 'success',
            'fip-id' => $fip->id
        );
 
        return Response::json( $response );
	}

}