<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('employee')) {
			Schema::create('employee', function(Blueprint $table)
			{
				$table->string('name', 50);			
				$table->string('eid', 20);
				$table->tinyInteger('age');
				$table->tinyInteger('work_age');
				$table->tinyInteger('status');
				$table->string('phone', 11);
				$table->tinyInteger('sex');
				$table->text('remark');
				$table->string('type', 10);
				$table->integer('created_at');
				$table->string('level', 10);
				$table->primary('eid');
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
		Schema::drop('employee');
	}

}
