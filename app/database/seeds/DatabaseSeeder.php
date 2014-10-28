<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		// $this->call('ArmyUpdatesTableSeeder');
		// $this->call('DonationCausesTableSeeder');
		$this->call('DonatedSuppliesListTableSeeder');
	}

}
