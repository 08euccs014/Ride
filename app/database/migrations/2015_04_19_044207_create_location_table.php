<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration {

	/**
	 * create location table
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('locations', function(Blueprint $table)
        {
            //location id
            $table->increments('id');
            //latitute of location
            $table->double('latitude');
            //longitude of location
            $table->double('longitude');
            //description for location like, address name
            $table->string('description');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('location');
	}

}
