<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProStudentEnrollTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_student_enroll', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('pro_students')->onDelete('cascade');

			$table->integer('referer_id')->unsigned()->nullable();
			$table->foreign('referer_id')->references('id')->on('pro_referers')->onDelete('cascade');

			$table->integer('our_course_id')->unsigned();
			$table->foreign('our_course_id')->references('id')->on('pro_our_courses')->onDelete('cascade');

			$table->date('enroll_date');
			$table->text('account_note')->nullable();
			$table->text('admin_note')->nullable();

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
		Schema::drop('pro_student_enroll');
	}

}
