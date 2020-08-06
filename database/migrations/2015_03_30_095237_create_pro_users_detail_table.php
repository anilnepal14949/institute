<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProUsersDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_users_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('address');
			$table->string('contact')->nullable();
			$table->string('email')->nullable();
			$table->enum('gender',['m','f']);
			$table->date('dob')->nullable();
			$table->string('image')->nullable();
			$table->integer('user_type')->unsigned();
			$table->foreign('user_type')->references('id')->on('pro_users_type')->onDelete('cascade');

			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->softDeletes();
			$table->boolean('status')->default(0);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pro_users_detail');
	}

}
