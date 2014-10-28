<?php


class RegisteredDonatedSupplyExpanded extends Eloquent {

    const TABLE_NAME = 'RegisteredDonatedSuppliesExpanded';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = RegisteredDonatedSupplyExpanded::TABLE_NAME;

	public static function createNew($user_id, $supplies_arr, $comments, $receipt_file) {
		$supply_expanded = new RegisteredDonatedSupplyExpanded;
		$supply_expanded->user_id = $user_id;
		$supply_expanded->comments = $comments;
		$supply_expanded->save();

		foreach ($supplies_arr as $supply_number => $supply_name_id) {
			RegisteredDonatedSupply::createNew($supply_expanded->id, $supply_number, $supply_name_id);
		}

		$supply_expanded->receipt_url = Helper::moveImgFileAndGetURLFor('DS', $receipt_file, $supply_expanded->id);
		$supply_expanded->save();

		return $supply_expanded;
	}



}
