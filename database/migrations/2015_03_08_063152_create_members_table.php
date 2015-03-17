<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cid', 20)->comment('会员卡号');
			$table->string('name',40)->comment('会员名');
			$table->enum('gender', ['男', '女', '保密'])->default('保密');
			$table->string('phone',18)->comment('联系手机号');
			$table->string('level',10)->comment('会员等级');
			$table->tinyInteger('status')->comment('会员状态');
			$table->dateTime('expiration')->comment('过期时间');
			$table->integer('integral')->comment('用户积分');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
