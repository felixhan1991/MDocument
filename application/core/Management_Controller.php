<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_Controller extends Admin_Controller  {

  
   /**
    * Construct dari My Controller
    * @package Controller
    * @todo finish Modules dan Permission
    */
   
    public function __construct() {
            parent::__construct();  
            
        }       
        protected function _getPermit()
        {
            
            if (!$this->_getSession()) return NLOGIN;//belum login
            return PERMITTED; //permitted

        }
        
      
    

   
        
        
        
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */