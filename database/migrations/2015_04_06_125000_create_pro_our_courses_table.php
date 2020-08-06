<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProOurCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_our_courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('room_id')->unsigned()->index();
			$table->foreign('room_id')->references('id')->on('pro_room')->onDelete('cascade');
			$table->integer('subject_id')->unsigned()->index();
			$table->foreign('subject_id')->references('id')->on('pro_subjects')->onDelete('cascade');
			$table->integer('teacher_id')->unsigned()->index();
			$table->foreign('teacher_id')->references('id')->on('pro_teachers')->onDelete('cascade');
			$table->integer('status_id')->unsigned()->index();
			$table->foreign('status_id')->references('id')->on('pro_status')->onDelete('cascade');

            $table->string('name');
			$table->string('capacity')->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->time('start_time')->nullable();
			$table->time('end_time')->nullable();

			$table->float('course_fee');
			$table->float('form_fee')->nullable();
			$table->text('description');

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
		Schema::drop('pro_our_courses');
	}

}
