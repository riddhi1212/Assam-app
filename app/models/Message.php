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

	// each Message hasMany matches
	// TODO : they don't always need to have a match
	// maybe matches have types. and the ones of type = 'new match' have matches
	public function matches() {
		return $this->hasMany('Match', 'msg_id');  
	}

}
