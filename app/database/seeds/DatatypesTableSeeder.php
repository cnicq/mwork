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

        DB::table('datavalues')->delete();

        $cityTexts = array('北京','上海','广州','深圳','武汉','西安','杭州','南京','成都','重庆');
        $citys = [];
        for($i = 0; $i < count($cityTexts); $i++)
        {
            array_push($citys,   array(
                'type'      => 'city',
                'name'      =>  $i,
                'text'      =>  $cityTexts[$i]
            ));
        }

        DB::table('datavalues')->insert( $citys );

        $industryTexts = array('互联网','移动互联网','游戏','互联网金融','传统IT','制造业','猎头行业');
        $industrys = [];
        for($i = 0; $i < count($industryTexts); $i++)
        {
            array_push($industrys,   array(
                'type'      => 'industry',
                'name'      =>  $i,
                'text'      =>  $industryTexts[$i]
            ));
        }

      
        DB::table('datavalues')->insert( $industrys );

        $positionTexts = array('工程师-初级','工程师-中级','工程师-高级','架构师','首席技术官','销售-初级','销售-中级','销售-高级','销售-总监', '助理顾问', '顾问');
        $positions = [];
        for($i = 0; $i < count($positionTexts); $i++)
        {
            array_push($positions,   array(
                'type'      => 'position',
                'name'      =>  $i,
                'text'      =>  $positionTexts[$i]
            ));
        }
      

        DB::table('datavalues')->insert( $positions );

    }

}
