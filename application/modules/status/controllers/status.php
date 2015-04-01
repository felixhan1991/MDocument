<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_m');	
	}
        
	public function index()
	{
		$this->title='Status';
		$data['state']='status';
		$data['status']=$this->status_m->getAllStatus();
		$data['logs']=array();
	   
		$this->form_validation->set_rules('nm_status', 'Nama Status', 'trim|required|callback_addStatus');
		
		$r = $this->form_validation->run();
		if($r == FALSE)
		{
			$this->display('main',$data);
		}
		else
		{
			//Go to private area
			redirect(base_url().'status');
		}            
	}
        
	private function addStatus($nm_status)
	{
		$result=$this->status_m->addStatus($nm_status);    
		if (!$result)
		{
			$this->form_validation->set_message('addStatus', 'Info: Nama Status sudah terpakai');
		}
		return $result;
	}
        
	private function editStatus()
	{
		$data=array(
			'nama_status'=>  $this->input->post('val')
		);
		$id=$this->input->post('id');
		
		$result = $this->status_m->editStatus($data,$id);
		if ($result === 'success')
		{
			$status = array("STATUS"=>"true");
		}
		else $status = array("STATUS"=>"false");
			 
		echo json_encode($status);
	}
        
	private function removeStatus()
	{
		$id=$this->input->post('id');
		$result = $this->status_m->removeStatus($id);
		if ($result === 'success')
		{
			$status = array("STATUS"=>"true");
		}
		else $status = array("STATUS"=>"false");
			 
		echo json_encode($status);
	}
        
	public function set_idModule() 
	{
		$this->idModule=1;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */