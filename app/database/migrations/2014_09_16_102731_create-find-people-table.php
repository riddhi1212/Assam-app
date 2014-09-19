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

		Schema::dropIfExists('find-people');

	}

}
