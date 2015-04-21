<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trip extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('trips', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('from');
            $table->integer('to');
            //for future use like per kilometer amount or actual road distance or toll tax extra
            $table->text('params');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('trips');
	}

}
