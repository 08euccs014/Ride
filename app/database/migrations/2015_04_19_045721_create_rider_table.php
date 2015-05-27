<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('riders', function(Blueprint $table)
        {
            //rider id
            $table->increments('id');
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->char('gender', 1);
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            //group of user weather rider or passenger
            $table->smallInteger('group');
            //user is activate or blocked
            $table->smallInteger('block');
            //user is actual user want to verify him
            $table->smallInteger('verify');
            //for future use like driving license or any other
            $table->text('params');
            //activate link it could be a number or whole link or token
            $table->string('activation');
            $table->smallInteger('remember_token');
            //it checks token has been sent or not it could be on mobile or mail
            $table->smallInteger('sendconfimation');

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
        Schema::drop('riders');
	}

}
