<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Admin_Controller  {

	public function index()
	{
            $this->about();
	}
        
        function about()
        {
            $this->title="Welcome Page";
            $this->display('start_about_view');
        }

    public function set_idModule() {
        $this->idModule=2;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */