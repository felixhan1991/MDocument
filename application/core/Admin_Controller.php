<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller  {

  
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
            if ($this->_checkAdmin()) return BYPASS;
            
            $datas= $this->module_m->getPermission($this->_idUsersPermit,
                    $this->_idUserActive, $this->get('idModule'));
            
            
            if (count($datas)>0) return PERMITTED; //permitted 
            return NPERMITTED;//belum ada akses

        }
        
        private function _checkAdmin()
        {
            foreach ($this->_idUsersPermit as $us)
            {
                if ($us->id_akun===$this->_idUserActive)
                {
                    if ($us->id_hak_akses==2)  {return true;}
                }
            }
        }

    

   
        
        
        
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */