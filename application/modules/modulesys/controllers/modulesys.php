<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModuleSys extends Admin_Controller {

        public function __construct() {
            parent::__construct();
        }
        
	public function index()
	{
             $this->title='Daftar Module Sistem';
             $data['state']='hak_akses';
             $data['status'] = $this->module_m->getAllModule();
             $this->display('main',$data);	
            
	}
   
        

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */