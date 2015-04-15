<?php

class BaseController extends Controller {

	function Titles($bigTitle = '', $smallTitle = '', $nickName = 'Joyce')
    {
        $PageTitle = 'MAPPING';
        $Menu1 = '';
        $Menu2 = '';
        $BigTitle = $bigTitle;
        $SmallTitle = $smallTitle;
        $NickName = $nickName;

        return compact('PageTitle', 'NickName', 'BigTitle', 'SmallTitle', 'Menu1', 'Menu2');
    }
    
    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}