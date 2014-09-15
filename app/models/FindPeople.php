<?php


class FindPeople extends Eloquent {

	protected $fillable = ['name', 'age'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'find-people';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

}
