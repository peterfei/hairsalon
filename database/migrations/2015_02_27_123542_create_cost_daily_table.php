<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostDailyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('cost_daily')) {
			Schema::create('cost_daily', function(Blueprint $table)
			{
				$table->decimal('topup', 10, 2);
				$table->decimal('card_cost', 10, 2);			
				$table->decimal('non_card_cost', 10, 2);
				$table->date('created_at');
				$table->integer('unixtime');
				$table->primary('created_at');
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
		Schema::drop('cost_daily');
	}

}
