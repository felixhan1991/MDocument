<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trash extends Admin_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('date','download','file');
		$this->load->model(array('document_m','logging_m','enroll_m','file/file_m'));
	}
        
	public function index()
	{    
		$this->title="Arsip";
		$data['documents'] = $this->document_m->getTrashDocument();
		
		$data['logs'] = array();//get to database
		$data['state']='trash';
		$this->display('main_trash',$data);
	}        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */