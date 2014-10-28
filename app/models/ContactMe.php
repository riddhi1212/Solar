<?php


class ContactMe extends Eloquent {

	const TABLE_NAME = 'ContactMe';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = ContactMe::TABLE_NAME;

	public static function createNew($purpose, $textbody, $fname, $lname, $mob, $is_guest) {
		$obj = new ContactMe;
		$obj->purpose = $purpose;
		$obj->comments = $textbody;
		$obj->fname = $fname;
		$obj->lname = $lname;
		$obj->mobile = $mob;
		$obj->is_guest = $is_guest;
		$obj->save();
		return $obj;
	}

}
