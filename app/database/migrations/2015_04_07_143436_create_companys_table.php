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
            // basic info
			$table->string('chinesename');
            $table->string('englishname');
            $table->string('province'); //date value table
            $table->string('city');   // date value table
            $table->string('location');
            $table->string('industry'); // date value table
            // contact info
            $table->string('linkman_chinesename');
            $table->string('linkman_englishname');
            $table->string('linkman_mobile');
            $table->string('linkman_tel');
            $table->string('linkman_email');
            $table->string('linkman_QQ');

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
		Schema::drop('companys');
    }
}
