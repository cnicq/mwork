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
            $table->string('class');
            $table->string('text');
            $table->string('value');
        });

		 // Creates the dataclass table
        Schema::create('dataclass', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('class');
            $table->string('value');
        });


		// Creates the locations table
        Schema::create('locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('name');
            $table->string('text');
        });

        // Creates the candidate tags
        Schema::create('tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('text');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('datatypes');
		Schema::drop('dataclass');
		Schema::drop('locations');
    }
}
