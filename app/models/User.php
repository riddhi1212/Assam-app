<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//public function authorize

	// ===============================================================
	//			get Methods
	// ===============================================================

	// each User of type Looker can try to register find requests for many people
	public function findPeople() {
		if ($this->looker) {
			// specifying second param because default foreign key will be 'user_id'
			return $this->hasMany('FindPeople', 'looker-id');  
		}
		
		return NULL;
	}

	// each User of type Looker can try to register find requests for many people
	public function contributedArmyUpdates() {
		if ($this->contributor) {
			// specifying second param because default foreign key will be 'user_id'
			return $this->hasMany('ArmyUpdates', 'contributor-id');  
		}
		
		return NULL;
	}

	// make looker
	public function makeLooker() {
		$this->looker = true;
	}

	// make contributor
	public function makeContributor() {
		$this->contributor = true;
	}

	// ===============================================================
	//			Static Methods
	// ===============================================================


	// Return the user object
    public static function createLookerAndSave($fname, $lname, $mobile) {
        Log::info("===Creating Looker " . $fname);

        Log::info($lname);
        Log::info($mobile);

        $user = new User;
        $user->fname = $fname;
        $user->lname = $lname;
        $user->mobile = $mobile;
        $user->makeLooker();
        // $mobile is str
        $user->password = Hash::make($mobile);  //TODO : add mix of first name and mob num
        $user->save();


        // Return id so we can save id of this looker User into find people
        Log::info("===Returning looker id ====");
        $user_id_str = (string) $user->id;
        Log::info("Id is " . $user_id_str);
        return $user;
    }

}
