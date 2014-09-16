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

		Schema::create('found-people', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('s-no')->unsigned();
			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();
			$table->string('address')->nullable();
			$table->string('fb-url')->nullable();
			$table->date('update-fb-date')->nullable();
			$table->integer('child')->unsigned()->default('0');
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
