<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProSubjectInquiriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_subject_inquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('subject_id')->unsigned();
			$table->foreign('subject_id')->references('id')->on('pro_subjects')->onDelete('cascade');

			$table->string('name');
			$table->string('address');
			$table->string('contact')->nullable();
			$table->string('email')->nullable();
			$table->string('image')->nullable();
			$table->time('preferred_time')->nullable();

			$table->string('parent_name')->nullable();
			$table->string('parent_contact')->nullable();
			$table->string('parent_email')->nullable();
			$table->text('other_preference')->nullable();

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
		Schema::drop('pro_subject_inquiries');
	}

}
