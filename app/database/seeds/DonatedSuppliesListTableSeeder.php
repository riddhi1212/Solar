<?php

class DonatedSuppliesListTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        // MAYBE TODO : Call appropriate migration directly
        $mig = new CreateDonatedSuppliesListTable;
        $mig->down();
        $mig->up();

        
        DonatedSuppliesList::createNew("Fever medicine", "Medical");
        DonatedSuppliesList::createNew("Cough medicine", "Medical");
        DonatedSuppliesList::createNew("Dehydration medicine", "Medical");
        DonatedSuppliesList::createNew("Rice", "Food");
        DonatedSuppliesList::createNew("Potable Drinking Water Packets", "Drinks");
        DonatedSuppliesList::createNew("O.R.S. Packets", "Medical");
        DonatedSuppliesList::createNew("Shirts", "Clothes");
        DonatedSuppliesList::createNew("Pants", "Clothes");
        DonatedSuppliesList::createNew("Blankets", "Shelter");
        DonatedSuppliesList::createNew("Mosquito nets", "Shelter");
    }   

}
