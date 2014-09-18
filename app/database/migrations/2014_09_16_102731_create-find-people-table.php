<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFindPeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('find-people', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();

			// Relationships
			// Each find-people row has a Looker user
			$table->integer('looker-id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::dropIfExists('find-people');

	}

}
