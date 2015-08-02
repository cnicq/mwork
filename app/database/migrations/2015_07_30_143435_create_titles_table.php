<?php
use Illuminate\Database\Migrations\Migration;

class CreateTitlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the titles table
        Schema::create('titles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('GUID');
            $table->string('posGUID');
            $table->string('name');
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
        Schema::drop('titles');
    }
}

