<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactEmails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_emails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_hash',20)->unique();
			$table->timestamps();
			$table->tinyInteger('status');
			$table->string('subject',255);
			$table->text('body');
			$table->integer('user_id')->unsigned();
			$table->integer('contact_id')->unsigned();
			$table->foreign('contact_id')->references('id')->on('contacts');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact_emails');
	}

}
