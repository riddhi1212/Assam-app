<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

  const TABLE_NAME = 'users';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = User::TABLE_NAME;

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
			return $this->hasMany('FindPeople', 'looker_id');  
		}
		
		return NULL;
	}

  // each User of type Finder can try to register found records for many people
  public function foundPeople() {
    if ($this->finder) {
      // specifying second param because default foreign key will be 'user_id' (check)
      return $this->hasMany('FoundPeople', 'finder_id');  
    }
    
    return NULL;
  }

  // each User of type DonationCauseAdder can try to add many donation causes
  public function donationCausesAdded() {
    if ($this->donationcause_adder) {
      // specifying second param because default foreign key will be 'user_id' (check)
      return $this->hasMany('DonationCause', 'poster_id');  
    }
    
    return NULL;
  }

	// each User of type Looker can try to register find requests for many people
	public function contributedArmyUpdates() {
		if ($this->contributor) {
			// specifying second param because default foreign key will be 'user_id'
			return $this->hasMany('ArmyUpdates', 'contributor_id');  
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
    $this->save();
	}

	// make contributor
	public function makeContributor() {
		$this->contributor = true;
    $this->save();
	}

  // make finder
  public function makeFinder() {
    $this->finder = true;
    $this->save();
  }

  // make donation cause adder
  public function makeDonationCauseAdder() {
    $this->donationcause_adder = true;
    $this->save();
  }

  // Creates new message   
  // ONLY works if user is looker
  // Write to Looker's dashboard, and create alert in Nav-bar
  // TODO : might need to show alert
  public function createNewMessageForLooker($alert_text, $match_table, $match_count) {
      if (!$this->looker)
        return;

      $message = new Message;
      $message->alert = $alert_text;

      $intro = 'Good news! Your Find-Person post generated ';
      $intro = $intro . (string)$match_count . ' match';
      if ($match_count > 1) {
        $intro = $intro . 'es';
      }
      $intro = $intro . ' from ' . $match_table; 

      $message->textbody = $intro;
      
      $message->setUserID($this->id);
      $message->save();
  }




	// ===============================================================
	//			Static Methods
	// ===============================================================


	// Returns the Looker object
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

  // Returns the Finder object
  // TODO: fire new Message with Congratulations on becoming Finder and thank you note.
  public static function createFinderAndSave($fname, $lname, $mobile) {
      Log::info("===Creating Finder " . $fname);

      Log::info($lname);
      Log::info($mobile);

      $user = new User;
      $user->fname = $fname;
      $user->lname = $lname;
      $user->mobile = $mobile;
      $user->makeFinder();
      // $mobile is str
      $user->password = Hash::make($mobile);  //TODO : add mix of first name and mob num
      $user->save();


      // Return id so we can save id of this looker User into find people
      Log::info("===Returning finder id ====");
      $user_id_str = (string) $user->id;
      Log::info("Id is " . $user_id_str);
      return $user;
  }

  // Returns the user object
  public static function createDCAdderAndSave($fname, $lname, $mobile) {
      Log::info("===Creating DC Adder " . $fname);

      Log::info($lname);
      Log::info($mobile);

      $user = new User;
      $user->fname = $fname;
      $user->lname = $lname;
      $user->mobile = $mobile;
      $user->makeDonationCauseAdder();
      // $mobile is str
      $user->password = Hash::make($mobile);  //TODO : add mix of first name and mob num
      $user->save();

      return $user;
  }


}
