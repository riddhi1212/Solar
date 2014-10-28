<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredDonatedSuppliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(RegisteredDonatedSupply::TABLE_NAME, function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

			$table->integer('expanded_id')->unsigned();

			$table->integer('supply_number');
			$table->integer('supply_name_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(RegisteredDonatedSupply::TABLE_NAME);
	}

}
