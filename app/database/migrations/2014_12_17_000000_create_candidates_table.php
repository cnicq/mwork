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

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('englishname');
            $table->string('chinesename');
            $table->string('gender');
            $table->string('materialstatus');
            $table->string('location');
			$table->string('hometown');
			$table->string('label'); //tags
			$table->string('mobile');
			$table->string('email');
			$table->string('company');
			$table->string('title');
			$table->string('status');
			$table->string('resumes');
			$table->text('notes');
            $table->string('creater');
            $table->string('QQ');
            $table->string('Wechat');
            $table->timestamps('update_at');
        });
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
