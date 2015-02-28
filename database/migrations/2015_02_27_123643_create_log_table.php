<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('log')) {
			Schema::create('log', function(Blueprint $table)
			{
				$table->increments('logid');
				$table->string('controller', 50);			
				$table->string('action', 50);
				$table->text('querystring', 11);
				$table->integer('userid');
				$table->string('username', 20);
				$table->string('ip', 15);
				$table->dateTime('timestamp');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('log');
	}

}
