<?php
use Illuminate\Database\Migrations\Migration;

class CreateDatatypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the datatypes table
        Schema::create('datatypes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('text');
        });

		 // Creates the datavalues table
        Schema::create('datavalues', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type'); // data type name
            $table->string('name');
            $table->string('text');
            $table->string('value');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datatypes');
		Schema::drop('datavalues');
    }
}
