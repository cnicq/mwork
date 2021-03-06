<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectinfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('projectinfos', function($table)
        {
        	print "talbe : projectinfos up.\n";

            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('proj_id')->unsigned(); // project id
            $table->integer('auth_id')->unsigned(); // author /user id
            $table->integer('ca_id')->unsigned(); 	// candidate id
            $table->integer('step'); 				// candidate process step ,in data value
            $table->string('content');

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
		Schema::drop('projectinfos');
	}

}
