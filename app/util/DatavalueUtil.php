<?php

class DatavalueUtil
{
	private static $_instance;

    private $cacheDataTypes  = array(); // key : name, value : row data
    private $cacheDataValues = array(); // key : type_name, value : row data
    public static function getInstance()    
    {    
        if(!(self::$_instance instanceof self) ) {    
            self::$_instance = new self();    
        }    
        return self::$_instance;    
    }    

    public function __construct(){

        $this->refreshData();
    }

    public function refreshData()
    {
        $this->cacheDataTypes = array();
        $types = DB::table('datatypes')->get();
        foreach ($types as $key => $value) {
            $this->cacheDataTypes[$value->name] = $value;
        }

        $this->cacheDataValues = array();
        $values = DB::table('datavalues')->get();
        foreach ($values as $key => $value) {
            $this->cacheDataValues[$value->type.'_'.$value->name] = $value;
        }
        
    }

    public function getDataTypeText($typeName){
        if(!in_array($typeName, $this->cacheDataTypes))
        {
            return '/';
        }
        return $this->cacheDataTypes[$typeName]->text;
    }

    public function getDataValueText($typeName, $valueName){
        $sKey = $typeName.'_'.$valueName;
        if(empty($this->cacheDataValues[$sKey]))
        {
            return '/';
        }
        return $this->cacheDataValues[$sKey]->text;
    }

    public function getGenderText($gender)
    {
        if($gender == 'male' || $gender == 1)
        {
            return '男';
        }

        if($gender == 'female' || $gender == 0)
        {
            return '女';
        }
    }
}
