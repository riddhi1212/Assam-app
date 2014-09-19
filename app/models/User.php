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

  public function getFullName() {
      $name = $this->getAttribute('fname');
      if ($this->getAttribute('lname') !== null) {
          $name = $name . " " . $this->getAttribute('lname');
      }
      return $name;
  }
    
	// each User has many Dashboard Messages
	public function messages() {
		// specifying second param because default foreign key will be 'user_id'
		return $this->hasMany('Message', 'user-id');  
	}

	// num of Dashboard Messages
	public function numMessages() {
		return $this->messages()->count();  
	}

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

	// each User of type Looker can try to register find requests for many people
	public function numContributed() {
		if ($this->contributor) {
			return count($this->contributedArmyUpdates()->get());  
		}
		
		return 0;
	}

	// make looker
	public function makeLooker() {
		$this->looker = true;
	}

	// make contributor
	public function makeContributor() {
		$this->contributor = true;
	}

  // creates new message
  // TODO might need to SHOW alert
  public function createNewMessage($alert_text, $source_table, $match_table, $source_table_id, $search_results_obj) {

  	$message = new Message;
  	$message->alert = $alert_text;
  	$intro = 'Good news! Your Find-Person post generated ';
  	$match_count = count($search_results_obj);
  	$intro = $intro . (string)$match_count . ' match';
  	if ($match_count > 1) {
  		$intro = $intro . 'es';
  	}
  	$message->textbody = $intro;
  	
  	$message->setUserID($this->id);
  	$message->save();

  	if ($source_table === 'FindPeople') {
  		// this was searched for Name and Age

  		foreach ($search_results_obj as $search_result) {
  			$match = new Match;

  			$match->fip_id = $source_table_id;
  			$match->match_table_id = $search_result['id'];
  			if ($match_table == 'ArmyUpdates') {
  				$match->match_army_update = true;
  			}
  			elseif ($match_table == 'FoundPeople') {
  				$match->match_found_person = true;
  			}
  			$match->msg_id = $message->id;
  			$match->user_id = $this->id;
  			
  			$match->save();
  		}
  	} // No other case RIGHT NOW
  }

  //   // creates new message
  //   // TODO might need to SHOW alert
  //   public function createNewMessage($alert_text, $matches) {

		// $message = new Message;
  //   	$message->alert = $alert_text;

  //   	foreach ($matches as $match_obj) {
  //   		$find_people_id = $match_obj->fip_id;


  //   		$intro = 'Good news! Your Find-Person post generated ';
  //   		$match_count = count($search_results_obj);
  //   		$intro = $intro . (string)$match_count . ' match';
  //   		if ($match_count > 1) {
  //   			$intro = $intro . 'es';
  //   		}
  //   		$message->textbody = $intro;
    		
  //   		$message->setUserID($this->id);
  //   		$message->save();

	 //    	if ($match_obj->match_army_update) {
	 //    		$army_update_id = $match_obj->match_table_id;
	 //    	}
  //   	}
    	



  //   	if ($source_table === 'FindPeople') {
  //   		// this was searched for Name and Age
  //   		$message = new Message;
  //   		$message->alert = $alert_text;
  //   		$intro = 'Good news! Your Find-Person post generated ';
  //   		$match_count = count($search_results_obj);
  //   		$intro = $intro . (string)$match_count . ' match';
  //   		if ($match_count > 1) {
  //   			$intro = $intro . 'es';
  //   		}
  //   		$message->textbody = $intro;
    		
  //   		$message->setUserID($this->id);
  //   		$message->save();
  //   	}
  //   }

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
