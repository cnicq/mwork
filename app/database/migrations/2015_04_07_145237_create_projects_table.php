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
            $table->integer('client_id')->unsigned()->index();
            $table->integer('owner_id')->unsigned()->index();
            $table->string('title');
            $table->string('content');
            $table->string('purchase_order');
            $table->string('urgency');
            $table->integer('job_id');
            $table->string('brief');
            $table->string('search_strategy');
            $table->string('created_at');
            $table->string('update_at');
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
