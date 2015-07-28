<?php
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the positions table
        Schema::create('positions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('GUID');
            $table->string('name');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('positions');
    }
}

