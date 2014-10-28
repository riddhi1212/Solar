<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationCausesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(DonationCause::TABLE_NAME, function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('name');
			$table->text('description');
			$table->string('img_url')->nullable();
			$table->string('donation_url');

        	// TODO : add tag like 'Bank', 'NGO', 'Other' and color code while displaying
        	// use enum

			// Relationships
			// Each donationcause has a Poster user
			$table->integer('poster_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(DonationCause::TABLE_NAME);
	}

}
