<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (! Schema::hasTable('item_data')) {
			Schema::create('item_data', function(Blueprint $table)
			{
				$table->string('group', 50);			
				$table->string('name', 50);
				$table->string('value', 50);
				$table->string('editor', 10)->default('text');
				$table->primary(array('group', 'name'));
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
		Schema::drop('item_data');
	}

}
