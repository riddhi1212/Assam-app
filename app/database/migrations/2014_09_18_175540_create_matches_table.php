<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('id');
		    $table->timestamps();

			$table->integer('fip_id');
			$table->integer('match_table_id');
			$table->boolean('match_army_update')->default(false);
			$table->boolean('match_found_person')->default(false);
			$table->boolean('claimed')->default(false);

			// Message->HasMany(Matches). So each match belongs to one msg
			$table->integer('msg_id')->unsigned();
			// TODO should I include ? User is same as msg->user-id or fip->user-id
			$table->integer('user_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('matches');
	}

}
