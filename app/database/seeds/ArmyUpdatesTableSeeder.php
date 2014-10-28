<?php

class ArmyUpdatesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Calling appropriate migration directly
        $aut = new CreateArmyUpdatesTable;
        $aut->down();
        $aut->up();

        $csvFile = app_path() . '/database/ToSeed/444-816-with-contributer-details.csv';
		
		// Format 2
    	// Contributor fname,lname,mob,S.no.,First name,Last name,Child,Age,Address,City,FB URL,w Child ?,Additional

        Helper::createArmyUpdatesFromFile($csvFile);
	}

}
