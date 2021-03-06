<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
       Schema::create('messages', function(Blueprint $table)
        {
        	$table->increments('id');
        	$table->integer('sender_id');
        	$table->integer('receiver_id');
            $table->text('content');
            //read unread
            $table->tinyInteger('status')->index();
            //mail send or pending
            $table->tinyInteger('action')->index();
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
		 Schema::drop('messages');
	}

}
