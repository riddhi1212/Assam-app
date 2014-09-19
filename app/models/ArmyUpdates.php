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

    public function getFullName() {
        $name = $this->getAttribute('first-name');
        if ($this->getAttribute('last-name') !== null) {
            $name = $name . " " . $this->getAttribute('last-name');
        }
        return $name;
    }


    // each AU hasMany FIP reports
    public function fips() {
        return $this->hasMany('FindPeople', 'found_table_id')
                    ->where('found_in_army_updates', '=', true);  
    }
    
    // returns a User obj
    // TODO : assert if this is always of type Looker, because only Lookers can claim AUs
    public function getClaimer() {
        $original_fip = $this->fips()
                             ->where('duplicate', '=', false)  // Query Builder
                             ->first();  

        return User::find($original_fip->getLookerID());
    }


	// ===============================================================
	//			Static Methods
	// ===============================================================

    // CAn't get matches without msg_id, won't create msg unless existence of matches confirmed
    // public static function getMatchesForFIPWithNameAndAge($fip_id, $find_name, $find_age) {
    //     $search_results = ArmyUpdates::searchWithNameAndAge($find_name, $find_age);
    //     // $match = new Match;
    //     // $match->match_army_update = true;
    //     // $match->match_table_id = 
    // }



    // returns a results array
    public static function searchUnclaimedWithParam($updates_sno, $updates_name, $updates_age) {
        return ArmyUpdates::getBuilderWithParam($find_sno, $find_name, $find_age)
                            ->where('claimed', '=', false)
                            ->get();
    }

    // returns a results array
    public static function searchWithNameAndAge($find_name, $find_age) {
        return ArmyUpdates::searchWithParam("", $find_name, $find_age);
    }

    // returns a results array
    public static function searchWithParam($find_sno, $find_name, $find_age) {
        return ArmyUpdates::getBuilderWithParam($find_sno, $find_name, $find_age)->get();
    }

	// returns a chainable thingie. A Builder object I think
    // example: the output of AU::where() ... ->get() has not been called yet
    // TODO explanation
    // Called from AU page search button. No matching capability yet? // TODO can add 'Claim' in future
    private static function getBuilderWithParam($updates_sno, $updates_name, $updates_age) {

        $name = false;
        $age = false;
        $sno = false;
        if ($updates_name) {
            $name = true;
        } 
        if ($updates_age) {
            $age = true;
        }
        if ($updates_sno) {
            $sno = true;
        }

        $results =  array();
        $explanation = "";
        if ($sno) {
            // This can only return one row (I think . TODO: check assumption)
            $results = ArmyUpdates::where('s-no', '=', $updates_sno);
            $explanation = "Do not search on 'S.no.' and Another field together. 'S.no.' is unique for every update, so it will never match 2 records. This search is returning results for 'S.no.' = ".$updates_sno.".";
        } elseif ($name && !$age) {
            // Only Name Specified
           // $results = ArmyUpdates::where('first-name', '=', $updates_name)->get();
            // search over last name too
            // $results = DB::table('ARMY-Updates')
            //                     ->where('first-name', '=', $updates_name)
            //                     ->orWhere('last-name', '=', $updates_name)
            //                     ->get();

                $results = ArmyUpdates::whereRaw('`first-name` LIKE ? or `last-name` LIKE ?', array(
                                                    '%'.$updates_name.'%', '%'.$updates_name.'%'
                                                ));

                // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = ArmyUpdates::where('age', '=', $updates_age);
        } elseif ($name && $age) {
            // Name, Age Specified
            // $results = ArmyUpdates::where('age', '=', $updates_age)
            //                         ->where('first-name', '=', $updates_name)
            //                         ->get();
            //                         //TODO : last name search!


            $results = ArmyUpdates::whereRaw('( `first-name` LIKE ? or `last-name` LIKE ? ) and age = ?', array(
                                        '%'.$updates_name.'%', '%'.$updates_name.'%', $updates_age
                                    ));

                // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}
