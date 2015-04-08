<?php

use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `Posts` table
        Schema::create('projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->string('purchase_order');
            $table->string('urgency');
            $table->integer('client_id');
            $table->integer('owner_id');
            $table->integer('job_id');
            $table->string('brief');
            $table->string('search_strategy');
            $table->string('update_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete the `Posts` table
        Schema::drop('projects');
    }

}
