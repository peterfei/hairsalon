<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('cost')) {
			Schema::create('cost', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('action', 10);			
				$table->string('cid', 20);
				$table->string('eid', 20);
				$table->string('aid', 20);
				$table->decimal('payables', 10, 2)->nullable();
				$table->decimal('discount', 10, 2)->nullable();
				$table->decimal('real_pay', 10, 2)->nullable();
				$table->tinyInteger('point')->nullable();
				$table->tinyInteger('operate_id')->nullable();
				$table->integer('created_at');
				$table->integer('updated_at')->nullable();
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
		Schema::drop('cost');
	}

}
