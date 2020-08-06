<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_subjects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_type_level_id')->unsigned();
			$table->foreign('course_type_level_id')->references('id')->on('pro_course_type_levels')->onDelete('cascade');
			$table->string('name');
			$table->text('description')->nullable();

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
		Schema::drop('pro_subjects');
	}

}
