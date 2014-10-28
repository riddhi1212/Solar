<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundPeopleTable extends Migration {

	private $tableName = FoundPeople::TABLE_NAME;

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
			$table->string('father_name');
			
			// Other optional info fields
			$table->string('photo_url')->nullable();
			$table->text('description')->default('');

			// Relationships
			// Each found-people row has a Finder user
			$table->integer('finder_id')->unsigned();

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
