<?php


class DonatedSuppliesList extends Eloquent {

    const TABLE_NAME = 'DonatedSuppliesList';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = DonatedSuppliesList::TABLE_NAME;

	public static function createNew($name, $category) {
		$supply = new DonatedSuppliesList;
		$supply->name = $name;
		$supply->category = $category;
		$supply->save();
		return $supply;
	}

	public static function getListAsArray() {
		$arr = array();

		$all = DonatedSuppliesList::all();

		foreach ($all as $supply) {
			$arr[$supply->id] = $supply->name;
		}

		return $arr;
	}

}
