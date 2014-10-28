<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    // Required 
		    // User input
			$table->string('fname');
			$table->string('lname');
			$table->bigInteger('mobile');

			// Required, I will set
			//$table->string('type'); // Looker / Finder / Contributor
			$table->boolean('looker')->default(false);
			$table->boolean('finder')->default(false);
			$table->boolean('contributor')->default(false);
			$table->boolean('donationcause_adder')->default(false);

			$table->integer('upload_number')->default(0);
			$table->enum('affiliation', array('army', 'ndrf', 'media', 'medical', 'person', 'ngo', 'other', 'unspecified'))->default('unspecified');


			$table->string('password'); // hash of mobile for now
			$table->rememberToken(); // put again for Auth

			// Optional
			$table->integer('age')->unsigned()->nullable();
			$table->string('email')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::dropIfExists('users');
	}

}
