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

	// ===============================================================
	//			Static Methods
	// ===============================================================

    public static function searchWithNameAndAge($find_name, $find_age) {
        return ArmyUpdates::searchWithParam("", $find_name, $find_age);
    }

	// returns a results array
    // TODO explanation
    public static function searchWithParam($updates_sno, $updates_name, $updates_age) {

        $name = false;
        $age = false;
        $sno = false;
        if ($updates_name) {
            Log::info("ya name");
            $name = true;
        } 
        if ($updates_age) {
            Log::info("ya age");
            $age = true;
        }
        if ($updates_sno) {
            Log::info("ya sno");
            $sno = true;
        }

        $results =  array();
        $explanation = "";
        if ($sno) {
            // This can only return one row (I think . TODO: check assumption)
            $results = ArmyUpdates::where('s-no', '=', $updates_sno)->get();
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
                                                ))->get();

                // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = ArmyUpdates::where('age', '=', $updates_age)->get();
        } elseif ($name && $age) {
            // Name, Age Specified
            // $results = ArmyUpdates::where('age', '=', $updates_age)
            //                         ->where('first-name', '=', $updates_name)
            //                         ->get();
            //                         //TODO : last name search!


            $results = ArmyUpdates::whereRaw('( `first-name` LIKE ? or `last-name` LIKE ? ) and age = ?', array(
                                        '%'.$updates_name.'%', '%'.$updates_name.'%', $updates_age
                                    ))->get();

                // TODO : separate out exact matches and substr matches and disp them separately
        }

        return $results;
    }

}
