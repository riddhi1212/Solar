<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactMeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ContactMe', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->enum('purpose', array('feedback', 'feature', 'error', 'help', 'dev', 'other'));
		    $table->text('comments');

			$table->string('fname');
			$table->string('lname');
			$table->bigInteger('mobile');
			$table->boolean('is_guest');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ContactMe');
	}

}
