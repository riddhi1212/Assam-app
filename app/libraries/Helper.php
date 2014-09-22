<?php 

// TODO add in future (namespace Helpers;)

class Helper {


    // Returns Builder obj
    // you have to call ->get() on it. or you can append more queries.
    public static function searchTableForName($table_name, $name) {

        $find_first_name = Helper::getFirstNameFrom($name);
        $find_last_name = Helper::getLastNameFrom($name);

        if ($find_last_name === ""){
            // only one word name specified. I want to give user the benefit of the doubt and run this through first name and last name searches

            return DB::table($table_name)->whereRaw(' first_name LIKE ? or last_name LIKE ? ', array(
                                                    '%'.$find_first_name.'%', '%'.$find_first_name.'%'
                                                ));
        } else {
            return DB::table($table_name)->whereRaw(' first_name LIKE ? and last_name LIKE ? ', array(
                                                    '%'.$find_first_name.'%', '%'.$find_last_name.'%'
                                                ));    
        }


    }

    // Returns Builder obj
    // you have to call ->get() on it. or you can append more queries.
    // EXACT MATCHES FOR NOW. TODO : substr matches with LIKE instead of = . LIKE ? . "%arg%"
    public static function searchTableForNameAndAge($table_name, $name, $age) {

        $find_first_name = Helper::getFirstNameFrom($name);
        $find_last_name = Helper::getLastNameFrom($name);

        Log::info("= in Helper::searchWNameandAge =");
        Log::info($find_first_name);
        Log::info($find_last_name);
        Log::info($age);

        if ($find_last_name === "") {
            // only one word name specified. I want to give user the benefit of the doubt and run this through first name and last name searches

            Log::info("***(last name is empty)");


            // Yes if 

            return DB::table($table_name)->whereRaw('( first_name = ? or last_name = ? ) and age = ?', array(
                                                $find_first_name, $find_first_name, $age
                                            )); 
        } else {

            // Yes if first-name and age matches and last-name = ""
            // Yes if first-name and last-name and age matches
            // Yes if first-name matches (our lastname) and last-name is empty and age matches

            return DB::table($table_name)->whereRaw('(     ( first_name = ? and last_name = "" )
                                                        or ( first_name = ? and last_name = ? )
                                                        or ( first_name = ? and last_name = "" )
                                                     ) and age = ?', array(
                                                        $find_first_name, 
                                                        $find_first_name,
                                                        $find_last_name, 
                                                        $find_last_name, // their first_name matches our_last_name
                                                        $age
                                                    ));

        }


    }

    /*

    Ali 19
        -   should match
            -   Ali             19
            -   Ali Basher      19
            -   Arif Ali        19
            -   (first name spaces)
            -   Ali Arif Mohd   19
            -   Arif Ali Mohd   19
            -   Arif Mohd Ali   19
        -   should not match
            -   ( think ! )


        -   where ( first_name = "sandeep"              // exact match
                 or first_name LIKE "sandeep %"         // first word
                 or first_name LIKE "% sandeep"         // last word
                 or first_name LIKE "% sandeep %"       // middle word
                 or last_name = "sandeep" );


    Mihir Ali 19 
        -   should match
            -   Mihir      19
            -   Mihir Ali  19
            -   Ali        19
        -   should not match
            -   Ali ban     19
            -   Mihir Pu    19
            -   Sub Ali     19
            -   Ali mihir   19 (????)


    Mohd Arif Ali               19
        -   should match
            -   Mohd            19
            -   Arif            19
            -   Ali             19
            -   Mohd Arif       19
            -   Mohd Ali        19
            -   Arif Ali        19 (????)
            -   (first name spaces)
            -   Mohd Arif Ali   10
        -   should not match
            -   Mohd Basher     19
            -   Ali Mohd        19
            -   Arif Mohd       19
            -   Ba Mohd         19
            -   Arif basher     19
            -   
            -   (first name spaces)
            -   Abdul Arif Mohd         19
            -   Arif Ali Mohd           19


    Dr Sp Sandeep Kaur               (Dr Sandeep Kaur)
        -   try listing out should matches
            -   Dr
            -   Sp
            -   Sandeep
            -   Kaur
            -   Dr Kaur
            -   Sp Kaur                 (????) -> maybe not
            -   Sandeep Kaur
            -   Dr Sp
        ->   Dr Sandeep Kaur
            -   Dr
            -   Sandeep
            -   Kaur
            -   Dr Sandeep
            -   Dr Kaur
            -   Sandeep Kaur
            -   Dr Sandeep Kaur
        ->   Dr Sp Kaur
            -   Dr
            -   Sp
            -   Kaur
            -   Dr Sp
            -   Dr Kaur
            -   Sp Kaur
            -   Dr Sp Kaur
        -   Put together without repetitions
            -   Dr
            -   Sp
            -   Sandeep
            -   Kaur
            -   Dr Sp
            -   Dr Sandeep
            -   Sp Kaur
            -   Dr Kaur
            -   Sandeep Kaur
            -   Dr Sp Kaur
            -   Dr Sandeep Kaur

        -   should not match
            -   everything else


    */



	// assumes $obj has the following cols :
	//					$first_name
	//					$last_name
	//					$first_name_has_spaces
	//	Returns nothing
	public static function setFirstAndLastNameFor($name_str, $obj) {
		$first_name = "";
		$last_name = "";
		$first_name_has_spaces = false;

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) === 1) {
        	$first_name = $name_str;
        } elseif (count($name_arr) === 2) {
        	$first_name_arr = array_splice($name_arr, 0, 1 );
        	$first_name = join('', $first_name_arr);

        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        } else {
        	$first_name_has_spaces = true;

        	$first_name_arr = array_splice($name_arr, 0, count($name_arr)-1 );
        	$first_name = join(' ', $first_name_arr);
        	
        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        }

        $obj->first_name = $first_name;
        $obj->last_name = $last_name;
        $obj->first_name_has_spaces = $first_name_has_spaces;
	}

	// Purely for display purposes
    public static function getFirstNameFrom($name_str) {
        $first_name = "";

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) === 1) {
        	$first_name = $name_str;
        } else {
        	$first_name_arr = array_splice($name_arr, 0, count($name_arr)-1 );
        	$first_name = join(' ', $first_name_arr);
        }

        return $first_name;
    }

	// Purely for display purposes
    public static function getLastNameFrom($name_str) {
        $last_name = "";

        $name_arr = explode(' ', $name_str);

        if (count($name_arr) > 1) {
        	$last_name_arr = array_splice($name_arr, -1, 1 );
        	$last_name = join('', $last_name_arr);
        }

        return $last_name;
    }

    // ============================================================
    //          CSV file reading from contributors for Army Updates
    // ============================================================

    // returns the file as an array of listing arrays
    private static function readCSV($csvFile) {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return array_slice($line_of_text,1); // excluding row 0 because that has the col names
    }

    // CSV format
    // | s-no |  first-name  | last-name |  age  |  address | fb-url  |  child  |
    public static function createArmyUpdatesFromFileForContributor($csvFile, $contributor_id) {
 
        $csv = Helper::readCSV($csvFile);
 
        foreach ($csv as $listing) {
            Helper::createFromCSVFormat1($listing, $contributor_id);
        }
    }

    // | s-no |  first-name  | last-name |  age  |  address | fb-url  |  child  |
    private static function createFromCSVFormat1($listing, $contributor_id) {
        $s_no = $listing[0];
        $first_name = $listing[1];
        $last_name = $listing[2];
        $age = $listing[3];
        $fb_url = $listing[5];

        // TODO: add col address and w-child and additional

        $update = ArmyUpdates::createNewForContributor(
                                    $s_no,
                                    $first_name,
                                    $last_name,
                                    $age,
                                    $fb_url,
                                    $contributor_id
                                );
    }

    // TODO : create Format3 where they just contribute 'name' and I programmatically break it into first-name and last-name

    public static function createArmyUpdatesFromFile($csvFile) {
 
        $csv = Helper::readCSV($csvFile);

        foreach ($csv as $listing) {
            Helper::createFromCSVFormat2($listing);
        }
    }



    // Contributor fname,lname,mob,S.no.,First name,Last name,Child,Age,Address,City,FB URL,w Child ?,Additional
    private static function createFromCSVFormat2($listing) {
        $contributor_fname = $listing[0];
        $contributor_lname = $listing[1];
        $contributor_mob = $listing[2];
        $s_no = $listing[3];
        $first_name = $listing[4];
        $last_name = $listing[5];
        $age = $listing[7];
        $fb_url = $listing[10];
        $w_child = $listing[11];

        $contributor = User::createContributorIfNotExists($contributor_fname, $contributor_lname, $contributor_mob);

        // TODO: add col address and w-child and additional

        $update = ArmyUpdates::createNewForContributor(
                                    $s_no,
                                    $first_name,
                                    $last_name,
                                    $age,
                                    $fb_url,
                                    $contributor->id
                                );
    }
 

}
