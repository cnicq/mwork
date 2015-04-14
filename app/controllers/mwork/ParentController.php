<?php

class ParentController extends BaseController {

    protected $bigTitle = '';
    protected $smallTitle = '';

    function Titles($bigTitle, $smallTitle, $nickName = 'Joyce')
    {
        $PageTitle = 'MAPPING';
        $Menu1 = '';
        $Menu2 = '';
        $BigTitle = $bigTitle;
        $SmallTitle = $smallTitle;
        $NickName = $nickName;

        return compact('PageTitle', 'NickName', 'BigTitle', 'SmallTitle', 'Menu1', 'Menu2');
    }
}