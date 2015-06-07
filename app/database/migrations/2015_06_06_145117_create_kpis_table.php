<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpisTable extends Migration {

/**
* Run the migrations.
*
* @return void
*/
public function up()
{
		if(Schema::hasTable('kpis'))
		{
			print "talbe : kpis already exist.\n";
			return;
		}

		Schema::create('kpis', function($table)
		{

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('recommend')->unsigned();
			$table->integer('coldcall')->unsigned();
			$table->integer('note')->unsigned();
			$table->integer('resume')->unsigned();
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
Schema::drop('kpis');
}

}

