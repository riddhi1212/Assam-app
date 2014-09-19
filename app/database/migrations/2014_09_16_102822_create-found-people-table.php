<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundPeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('found-people', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();
			$table->string('by')->nullable();

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

		Schema::dropIfExists('found-people');

	}

}
