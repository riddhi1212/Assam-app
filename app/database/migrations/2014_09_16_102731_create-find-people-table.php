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
		// TODO : add drop if exists
		Schema::dropIfExists('find-people');
		Schema::create('find-people', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('find-people', function(Blueprint $table)
		{
			Schema::dropIfExists('find-people');
		});
	}

}
