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
            $table->integer('castatus');   // current status, datatype:castatus
            $table->string('cvPath')->default('');
            $table->string('created_at_old')->default('');
            $table->text('searchtext'); // for fulltext search
            

            $table->timestamps();
        });

        DB::statement('ALTER TABLE cacomments ADD FULLTEXT search(searchtext)');
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
