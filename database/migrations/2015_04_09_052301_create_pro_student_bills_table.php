<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProStudentBillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_student_bills', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('bill_no')->index();
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('pro_students')->onDelete('cascade');

			$table->boolean('bill_type')->default(0);

			$table->integer('our_course_id')->unsigned();
			$table->foreign('our_course_id')->references('id')->on('pro_our_courses')->onDelete('cascade');

			$table->integer('student_enroll_id')->unsigned();
			$table->foreign('student_enroll_id')->references('id')->on('pro_student_enroll')->onDelete('cascade');

			$table->float('amount');
			$table->float('tax')->nullable();
			$table->float('due');

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
		Schema::drop('pro_student_bills');
	}

}
