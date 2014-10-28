<?php


class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	public function setUserID($id) {
		$this->setAttribute('user-id', $id);
	}

}
