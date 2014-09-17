<?php


class ArmyUpdates extends Eloquent {

	protected $fillable = ['first-name', 'age'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ARMY-Updates';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

	public function setContributorID($id) {
		$this->setAttribute('contributor-id', $id);
	}

}
