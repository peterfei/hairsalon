<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverviewDailyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('overview_daily')) {
			Schema::create('overview_daily', function(Blueprint $table)
			{
				$table->decimal('card_topup', 10, 2)->comment('当日会员充值总额');
				$table->decimal('card_cost', 10, 2)->comment('当日会员刷卡收入');			
				$table->decimal('non_card_cost', 10, 2)->comment('当日现金收入');
				$table->integer('new_mem_num')->comment('每日新增会员数量');
				$table->integer('total_mem_num')->comment('会员总数');
				$table->integer('card_cost_num')->comment('当日会员消费人次');
				$table->integer('non_card_cost_num')->comment('当日非会员消费人次');
				$table->date('created_date');
				$table->integer('created_time');
				$table->primary('created_date');
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
