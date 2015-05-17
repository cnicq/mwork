<?php
use Illuminate\Database\Migrations\Migration;

class CreateCaCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the candidate table
        Schema::create('cacomments', function($table)
        {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type');
            $table->string('auth_id');
            $table->string('ca_id'); // candidate id
            $table->string('proj_id'); // project id
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
        Schema::drop('cacomments');
    }

}
