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
                'name'      => 'cvsite',
                'text'      => '简历来源',
            ),
            array(
                'name'      => 'step',
                'text'      => '推荐状态',
            ),
            array(
                'name'      => 'projstate',
                'text'      => '项目状态',
            ),
            array(
                'name'      => 'castatus',
                'text'      => '候选人状态',
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

        $positionTexts = array('工程师-初级','工程师-中级','工程师-高级','架构师','首席技术官CTO','销售-初级','销售-中级','销售-高级','销售-总监', '助理顾问', '顾问');
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

        $cvsiteTexts = array('智联招聘','51job','猎聘网');
        $cvsites = [];
        for($i = 0; $i < count($cvsiteTexts); $i++)
        {
            array_push($cvsites,   array(
                'type'      => 'cvsite',
                'name'      =>  $i,
                'text'      =>  $cvsiteTexts[$i]
            ));
        }
      

        DB::table('datavalues')->insert( $cvsites );

        $stepTexts = array(
            '等待推荐',           // 0
            '已推荐-等待客户反馈',// 1
            '反馈结果-客户拒绝',  // 2 failed
            '反馈结果-安排面试',  // 3
            '面试结果-通过',      // 4
            '面试结果-失败',      // 5 failed
            '候选人-拒绝面试',    // 6 failed
            '候选人-接Offer',     // 7
            '候选人-拒绝offer',   // 8 failed
            '候选人-入职',        // 9 
            '候选人-保证期完成',  // 10 
            '候选人-保证期内离职' // 11
            );
        $stpes = [];
        for($i = 0; $i < count($stepTexts); $i++)
        {
            array_push($stpes,   array(
                'type'      => 'step',
                'name'      =>  $i,
                'text'      =>  $stepTexts[$i]
            ));
        }
      

        DB::table('datavalues')->insert( $stpes );

        $projTexts = array('准备中','进行中','暂停中', '已完成', '已取消');
        $projs = [];
        for($i = 0; $i < count($projTexts); $i++)
        {
            array_push($projs,   array(
                'type'      => 'projstate',
                'name'      =>  $i,
                'text'      =>  $projTexts[$i]
            ));
        }
      

        DB::table('datavalues')->insert( $projs );

        $castatusTexts = array('未知','明确看机会','考虑看机会','不看机会');
        $castatus = [];
        for($i = 0; $i < count($castatusTexts); $i++)
        {
            array_push($castatus,   array(
                'type'      => 'castatus',
                'name'      =>  $i,
                'text'      =>  $castatusTexts[$i]
            ));
        }
      

        DB::table('datavalues')->insert( $castatus );

    }

}
