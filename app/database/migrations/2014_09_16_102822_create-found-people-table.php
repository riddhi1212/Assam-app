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
		// TODO : add drop if exists
		Schema::dropIfExists('found-people');
		Schema::create('found-people', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();
			$table->string('by')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('found-people', function(Blueprint $table)
		{
			Schema::dropIfExists('found-people');
		});
	}

}
