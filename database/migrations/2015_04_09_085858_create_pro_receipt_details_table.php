<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProReceiptDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_receipt_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('receipt_id')->unsigned();
			$table->foreign('receipt_id')->references('id')->on('pro_receipts')->onDelete('cascade');

			$table->integer('bill_no')->unsigned();

			$table->float('paid_amount');
			$table->float('discount_amount');

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
		Schema::drop('pro_receipt_details');
	}

}
