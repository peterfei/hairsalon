<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomAttrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('custom_attr')) {
			Schema::create('custom_attr', function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('attrgroup', 50)->nullable()->comment('自定义属性组名称');
				$table->string('attrname', 50)->comment('自定义属性名称');	
				$table->string('attrvalue', 50)->nullable()->comment('属性值');
				$table->string('store', 50)->nullable()->comment('门店名称, xx总店或者xx分店');
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
		//
	}

}
