<?php

class ArmyUpdatesTableSeeder extends Seeder {

    // CSV format
    // |  contributor | s-no |  first-name  | last-name |  age  |  address |  fb-date | fb-url  |  child  |
	private function loadCSV() {
 
        $csvFile = app_path() . '/database/seedWithCSV/418-443.csv';
 
        $csv = $this->readCSV($csvFile);
 
        foreach ($csv as $listings) {

        	//Log::info($listings);
 
 			// TODO: add col update-fb-date
            $update = ArmyUpdates::create([ // add contributor
                'contributor'=> $listings[0],
            	's-no' 		 => $listings[1],
            	'first-name' => $listings[2],
            	'last-name'	 =>	$listings[3],
            	'age'		 => $listings[4],
            	'address' 	 => $listings[5], // add fb-date
            	'fb-url'     => $listings[7],
            	'child'		 => $listings[8]
            ]);
            
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
