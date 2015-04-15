<?php

class DesktopController extends ParentController {


    /**
     * Show a list of all the positions.
     *
     * @return View
     */
    public function getIndex()
    {
    	$this->smallTitle = 'id_desktop';

        return View::make('mwork/index', $this->Titles("", ""));
    }

}