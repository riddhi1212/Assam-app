<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmyUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{		
		Schema::create('ARMY-Updates', function(Blueprint $table)
		{
		    $table->increments('id');
		    $table->timestamps();

			$table->string('contributor');
		    $table->integer('s-no')->unsigned();
			$table->string('first-name');
			$table->string('last-name')->nullable();
			$table->integer('age')->unsigned();
			$table->string('address')->nullable();
			$table->date('update-fb-date')->nullable();
			$table->string('fb-url')->nullable();
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
		Schema::dropIfExists('ARMY-Updates');
	}

}
