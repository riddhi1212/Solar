<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmyUpdatesTable extends Migration {

	private $tableName = ArmyUpdates::TABLE_NAME;

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{		
		Schema::create($this->tableName, function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('contributor');
		    $table->integer('s_no')->unsigned();
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->boolean('first_name_has_spaces')->default(false);
			$table->integer('age')->unsigned();
			$table->string('address')->nullable();
			$table->date('update_fb_date')->nullable();
			$table->string('fb_url');
			$table->integer('child')->unsigned()->default('0');

			// Relationships
			// Each army-updates row has a Contributor user
			$table->integer('contributor_id')->unsigned();

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
		Schema::dropIfExists($this->tableName);
	}

}
