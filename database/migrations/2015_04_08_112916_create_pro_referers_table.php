<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProReferersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_referers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('pro_users_detail')->onDelete('cascade');

			$table->string('qualification')->nullable();
			$table->string('profession')->nullable();
			$table->string('relation')->nullable();
			$table->string('description')->nullable();

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
		Schema::drop('pro_referers');
	}

}
