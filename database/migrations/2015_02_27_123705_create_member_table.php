<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('member')) {
			Schema::create('member', function(Blueprint $table)
			{
				$table->string('cid', 20);
				$table->string('name', 10);			
				$table->string('sex', 20);				
				$table->string('level', 10);
				$table->string('preferential_way', 20);
				$table->decimal('blance', 10, 2);
				$table->decimal('cumulative', 10, 2);
				$table->tinyInteger('status');
				$table->string('phone', 11);
				$table->text('remard');
				$table->integer('created_at');
				$table->integer('updated_at');
				$table->integer('expire_at');
				$table->primary('cid');
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
		Schema::drop('member');
	}

}
