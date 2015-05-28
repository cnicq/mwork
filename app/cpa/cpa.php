<?php

// 严格开发模式
ini_set('display_errors', 'On');
ini_set('memory_limit', '64M');
error_reporting(E_ALL);

require_once 'phpanalysis.class.php';

class Cpa
{
    private static $_instance;

    private  $do_fork = true; //岐义处理
    private  $do_unit = true; //新词识别
    private  $do_multi = false;//多元切分
    private  $do_prop = false; //词性标注
    private  $pri_dict = false;//是否预载全部词条
    private  $pa = null;

    public static function getInstance()    
    {    
        if(!(self::$_instance instanceof self) ) {    
            self::$_instance = new self();    
        }    
        return self::$_instance;    
    }    

    public function __construct(){

        //初始化类
        PhpAnalysis::$loadInit = false;
        $this->pa = new PhpAnalysis('utf-8', 'utf-8', $this->pri_dict);
        
        //载入词典
        $this->pa->LoadDict();
    }

    public function parse($str){
        //执行分词
        $this->pa->SetSource($str);
        $this->pa->differMax = $this->do_multi;
        $this->pa->unitWord = $this->do_unit;
        
        $this->pa->StartAnalysis( $this->do_fork );
        //输出分词结果
        $okresult = $this->pa->GetFinallyResult(' ', $this->do_prop);
        
        $pa_foundWordStr = $this->pa->foundWordStr;
        
        return $okresult;
    }
}