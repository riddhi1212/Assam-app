<?php

class ArmyUpdatesTableSeeder extends Seeder {

    // CSV format
    // |  contributor | s-no |  first-name  | last-name |  age  |  address |  fb-date | fb-url  |  child  |
	private function loadCSV() {
 
        $csvFile = app_path() . '/database/seedWithCSV/418-443.csv';
 
        $csv = $this->readCSV($csvFile);
 
        foreach ($csv as $listings) {

        	//Log::info($listings);
 
            // HAVE-TODO: Create contributor user for each contributor name in seedCSV file and use that id below
            $contributor_user = User::where('fname','Riddhi')->get()->first();
            $contributor_user->makeContributor();
            $contributor_user->save(); // TODO: can this go into makeContributor function ? and makeLooker function?


            $s_no = $listings[1];
            $first_name = $listings[2];
            $last_name = $listings[3];
            $age = $listings[4];
            $fb_url = $listings[7];


 			// TODO: add col update-fb-date

            $update = ArmyUpdates::createNewForContributor(
                                        $s_no,
                                        $first_name,
                                        $last_name,
                                        $age,
                                        $fb_url,
                                        $contributor_user->id
                                    );


            // $update = ArmyUpdates::create([ // add contributor
            //  'contributor'=> $contributor_user->fname,
            // 	's-no' 		 => $listings[1],
            // 	'first-name' => $listings[2],
            // 	'last-name'	 =>	$listings[3],
            // 	'age'		 => $listings[4],
            // 	'address' 	 => $listings[5], // add fb-date
            // 	'fb-url'     => $listings[7],
            // 	'child'		 => $listings[8]
            // ]);

            
            //echo $listings[0] . 'recorded added <br />';
        }
        //echo 'done';
    }
 
    private function readCSV($csvFile) {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return array_slice($line_of_text,1); // excluding row 0 because that has the col names
    }

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//var_dump("======== in A-U-Seeder");
		$this->loadCSV();
	}

}
