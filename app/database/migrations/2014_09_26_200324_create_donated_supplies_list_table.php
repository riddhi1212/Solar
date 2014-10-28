<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatedSuppliesListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(DonatedSuppliesList::TABLE_NAME, function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

			$table->string('name');
			$table->enum('category', array('Medical', 'Food', 'Drinks', 'Clothes', 'Shelter', 'Other'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(DonatedSuppliesList::TABLE_NAME);
	}

}
