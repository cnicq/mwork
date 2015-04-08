<?php
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// Creates the companys table
        Schema::create('companys', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('chinesename');
            $table->string('englishname');
            $table->integer('city');
            $table->string('location');
            $table->integer('industry');
            $table->integer('contract');
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps('updated_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('companys');
    }
}
