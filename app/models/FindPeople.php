<?php


class FindPeople extends Eloquent {

	protected $fillable = ['first-name', 'age', 'looker-id'];

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


    public function getFirstName() {
        return $this->getAttribute('first-name');
    }

    public function getLastName() {
        return $this->getAttribute('last-name');
    }

    public function getFullName() {
        $name = $this->getFirstName();
        if ($this->getLastName() !== null) {
            $name = $name . " " . $this->getLastName();
        }
        return $name;
    }

    

	// each FIP hasMany matches
	public function matches() {
		return $this->hasMany('Match', 'fip_id');  
	}

	public function getLookerID() {
		return $this->getAttribute('looker-id');
	}

	public function getLooker() {
		return User::find($this->getLookerID());
	}

    // takes a single result
    public function createNewMatch($match_table, $found) {
        Log::info("*********************[Creating new match]*********************");
        Log::info("********[found]************");
        Log::info($found);
        $match = new Match;
        $match->fip_id = $this->id;
        $match->match_table_id = $found['id']; // TODO try $found->id
        if ($match_table == 'ArmyUpdates') {
            $match->match_army_update = true;
        } elseif ($match_table == 'FoundPeople') {
            $match->match_found_person = true;
        }
        $match->save();
    }


    // takes an array of results
	public function createNewMatches($match_table, $found_results) {

		foreach ($found_results as $found) {
            $this->createNewMatch($match_table, $found);
		}

		$this->getLooker()->createNewMessageForLooker('New Matches', $match_table, count($found_results));
	}


	// ===============================================================
	//			Static Methods
	// ===============================================================


	// returns a results array
	// Called from FoundPeopleController when posting a new Found Person Report
    public static function searchWithNameAndAge($find_name, $find_age) {
        return FindPeople::searchWithParam($find_name, $find_age);
    }

    // returns a results array
    // TODO : add more searchable params here
    public static function searchWithParam($find_name, $find_age) {
        return FindPeople::getBuilderWithParam($find_name, $find_age)->get();
    }

	// returns a chainable Builder object
    // example: the output of FOP::where() ... ->get() has not been called yet
    // TODO explanation
    private static function getBuilderWithParam($find_name, $find_age) {

        Log::info("*********************[FindPeople::getBuilderWithParam]*********************");
        Log::info("********[find_name]************");
        Log::info($find_name);
        Log::info("********[find_age]************");
        Log::info($find_age);

        $name = false;
        $age = false;
        if ($find_name) {
            $name = true;
        } 
        if ($find_age) {
            $age = true;
        }

        $results =  array();
        $explanation = "";
        if ($name && !$age) {
            // Only Name Specified

            // First-name and Last-name search
            // $results = DB::table('FoundPeople')
            //                     ->where('first-name', '=', $updates_name)
            //                     ->orWhere('last-name', '=', $updates_name)
            //                     ->get();

        	// Substr match
            $results = FindPeople::whereRaw('`first-name` LIKE ? or `last-name` LIKE ?', array(
                                                '%'.$find_name.'%', '%'.$find_name.'%'
                                            ));

            // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = FindPeople::where('age', '=', $find_age);
        } elseif ($name && $age) {
            // Name, Age Specified

            $results = FindPeople::whereRaw('( `first-name` LIKE ? or `last-name` LIKE ? ) and age = ?', array(
                                        '%'.$find_name.'%', '%'.$find_name.'%', $find_age
                                    ));

            // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}
