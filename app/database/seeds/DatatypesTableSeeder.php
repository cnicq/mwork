<?php

class DatatypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('datatypes')->delete();

        $types = array(
            array(
                'name'      => 'city',
                'text'      => '城市',
            ),
            array(
                'name'      => 'tag',
                'text'      => '标签',
            ),
            array(
                'name'      => 'industry',
                'text'      => '行业',
            ),
            array(
                'name'      => 'position',
                'text'      => '职位',
            )
        );

        DB::table('datatypes')->insert( $types );


    }

}
