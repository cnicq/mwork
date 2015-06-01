<?php
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the candidate table
        Schema::create('candidates', function($table)
        {
            $table->engine = 'InnoDB'; // fulltext search can use InnoDB engine after mysql 5.6
            $table->increments('id');
            $table->string('englishname');
            $table->string('chinesename');
            $table->string('gender');
            $table->string('maritalstatus');
            $table->string('location');
            $table->string('city');
			$table->string('birthday');
            $table->string('hometown');
			$table->string('label'); //tags
			$table->string('mobile');
            $table->string('tel');
			$table->string('email');
			$table->string('company'); //company 
			$table->string('position');
			$table->string('status');
			$table->string('resumes');
            $table->string('cvsite');
            $table->string('cvNO');
            $table->string('cvPath');
			$table->text('notes');
            $table->integer('creater_id')->unsigned();
            $table->string('QQ');
            $table->string('wechat');
            $table->text('searchtext'); // for fulltext search
            $table->timestamps();
        });

        DB::statement('ALTER TABLE candidates ADD FULLTEXT search(searchtext)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidates');
    }

}
