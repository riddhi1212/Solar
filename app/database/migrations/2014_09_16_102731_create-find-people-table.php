<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFindPeopleTable extends Migration {

	private $tableName = FindPeople::TABLE_NAME;

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

			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->boolean('first_name_has_spaces')->default(false);
			$table->integer('age')->unsigned();

			// Relationships
			// Each find-people row has a Looker user
			$table->integer('looker_id')->unsigned();

			$table->softDeletes();
			$table->text('why')->nullable(); // reason for deleting/canceling FIP request (make this enum maybe)

			// Other optional info fields
			$table->string('photo_url')->nullable();
			$table->text('description')->default('');

			$table->boolean('found')->default(false);
			// to be filled if found = true
			$table->boolean('duplicate')->default(false); // true if this is duplicate claim. i.e. AU/FOP has already been claimed by someone else first
			$table->integer('found_table_id')->default(0);
			$table->boolean('found_in_army_updates')->default(false);
			$table->boolean('found_in_found_people')->default(false);
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
