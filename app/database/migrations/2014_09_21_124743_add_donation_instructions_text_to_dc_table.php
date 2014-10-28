<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDonationInstructionsTextToDcTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(DonationCause::TABLE_NAME, function(Blueprint $table)
		{
			$table->text('instructions')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(DonationCause::TABLE_NAME, function(Blueprint $table)
		{
			$table->dropColumn('instructions');
		});
	}

}
