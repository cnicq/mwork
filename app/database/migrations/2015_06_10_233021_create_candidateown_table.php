<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateownTable extends Migration {

/**
* Run the migrations.
*
* @return void
*/
public function up()
{
		if(Schema::hasTable('candidateowns'))
		{
			print "talbe : candidateowns already exist.\n";
			return;
		}

		Schema::create('candidateowns', function($table)
		{

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('owner_id')->unsigned();
			$table->integer('ca_id')->unsigned();
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
Schema::drop('candidateowns');
}

}

