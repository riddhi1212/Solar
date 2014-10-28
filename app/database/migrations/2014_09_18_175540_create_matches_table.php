<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('id');
		    $table->timestamps();

		    // Relationships
		    // Each FIP hasMany Matches. So each match has a fip_id
			$table->integer('fip_id');

			$table->integer('match_table_id');
			$table->boolean('match_army_update')->default(false);
			$table->boolean('match_found_person')->default(false);
			$table->boolean('claimed')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('matches');
	}

}
