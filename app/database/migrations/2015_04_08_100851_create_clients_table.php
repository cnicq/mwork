<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

/**
* Run the migrations.
*
* @return void
*/
public function up()
{
if(Schema::hasTable('clients'))
{
	print "talbe : clients already exist.\n";
	return;
}

Schema::create('clients', function($table)
{

$table->engine = 'InnoDB';
$table->increments('id')->unsigned();
$table->integer('company_id')->unsigned();
$table->integer('owner_user_id')->unsigned();
$table->integer('BD_user_id')->unsigned();

 // contract info
$table->integer('fee')->unsigned();
$table->timestamp('contract_start');
$table->timestamp('contract_end');
$table->string('contract_filePath');

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
Schema::drop('clients');
}

}
