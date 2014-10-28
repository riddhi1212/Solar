<?php


class RegisteredDonatedSupply extends Eloquent {

    const TABLE_NAME = 'RegisteredDonatedSupplies';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = RegisteredDonatedSupply::TABLE_NAME;

	public static function createNew($expanded_id, $supply_number, $supply_name_id) {
		$supply = new RegisteredDonatedSupply;
		$supply->expanded_id = $expanded_id;
		$supply->supply_number = $supply_number;
		$supply->supply_name_id = $supply_name_id;
		$supply->save();
		return $supply;
	}

}
