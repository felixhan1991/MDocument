<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_Controller extends MY_Controller  
{
    /**
    * Construct dari My Controller
    * @package Controller
    * @todo finish Modules dan Permission
    */
   
    public function __construct()
	{
		parent::__construct();
	}
	
	protected function _getPermit()
	{
		return PERMITTED; //permitted
	}    
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */