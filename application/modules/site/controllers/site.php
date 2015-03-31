<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends Admin_Controller {

	
	public function index()
	{
           $this->about();
	}
        
        function about()
        {
            
            $this->display('welcome_message');
        }

        public function set_idModule() {
            $this->idModule=1;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */