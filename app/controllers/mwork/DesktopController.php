<?php

class DesktopController extends ParentController {


    /**
     * Show a list of all the positions.
     *
     * @return View
     */
    public function getIndex()
    {
        return View::make('mwork/index', $this->Titles("id_desktop", ""));
    }

}