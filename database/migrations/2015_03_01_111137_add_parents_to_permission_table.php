<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentsToPermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('permissions', function(Blueprint $table)
		{
			
			 $table->integer('parent_id')->comment('上级编号');
			 $table->string('auth_action',20)->comment('模块');
			 $table->string('auth_func',20)->comment('功能');
		     $table->string('url',40)->comment('地址');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('permissions', function(Blueprint $table)
		{
			//
		});
	}

}
