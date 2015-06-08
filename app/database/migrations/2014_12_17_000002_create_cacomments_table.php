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
            print "talbe : cacomments up.\n";

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('auth_id');  // who create this comment
            $table->integer('ca_id');    // candidate id
            $table->integer('proj_id');  // project id
            $table->text('content');     // comment
            $table->string('created_at_old');
            $table->string('cvPath');

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
