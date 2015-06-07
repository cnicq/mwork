<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the position table
        Schema::create('projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->integer('owner_user_id')->unsigned();
            $table->integer('head_count')->unsigned();

            $table->string('position_name');
            $table->string('projstate_name');
            $table->string('city_name')->default("");
            $table->string('income')->default("");
            $table->string('location')->default("");
            $table->text('desc');
            $table->string('starttime');
            $table->string('endtime');

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
        Schema::drop('projects');
	}

}
