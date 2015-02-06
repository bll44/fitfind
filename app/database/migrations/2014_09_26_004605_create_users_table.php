<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('displayname');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('street')->nullable()->default(null);
			$table->string('unit')->nullable()->default(null);
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->integer('zip')->nullable();
			$table->date('dob')->nullable();
			$table->string('gender')->nullable();
			$table->bigInteger('phone')->nullable();
			$table->tinyInteger('notifyEmail')->default(0);
			$table->tinyInteger('notifyText')->default(0);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
