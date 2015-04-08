<?php

class ParentController extends BaseController {

    function Titles()
    {
        $PageTitle = 'MAPPING';
        $NickName = 'TODO';
        $BigTitle = '桌面';
        $SmallTitle = '';
        $Menu1 = '';
        $Menu2 = '';
        return compact('PageTitle', 'NickName', 'BigTitle', 'SmallTitle', 'Menu1', 'Menu2');
    }
}