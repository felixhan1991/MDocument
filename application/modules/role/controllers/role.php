<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('role_m');
        }
        
	public function index()
	{
            $this->title='Akses';
            $data['state']='role';
            $data['status']=$this->role_m->getAllRole();
            $data['logs']=array();
           
            $this->form_validation->set_rules('nm_role', 'Nama Role', 'trim|required|callback_addRole');
            
            $r = $this->form_validation->run();
            if($r == FALSE)
            {
                $this->display('main',$data);
            }
            else
            {
                //Go to private area
                redirect(base_url().'role');
            }
            
	}
        
        public function addRole($nm_role)
        {
             $result=$this->role_m->addRole($nm_role);    
             if (!$result)
             {
                 $this->form_validation->set_message('addRole', 'Info: Nama Akses sudah terpakai');
             }
             return $result;
            
        }
        
        public function editRole()
        {
            $data=array(
                'nama_role'=>  $this->input->post('val')
            );
            $id=$this->input->post('id');
            
             $result = $this->role_m->editRole($data,$id);
             if ($result === 'success')
             {
                $status = array("STATUS"=>"true");
             }
             else $status = array("STATUS"=>"false");
                 
             echo json_encode($status);
        }
        
        public function removeRole()
        {
            $id=$this->input->post('id');
            $result = $this->role_m->removeRole($id);
             if ($result === 'success')
             {
                $status = array("STATUS"=>"true");
             }
             else $status = array("STATUS"=>"false");
                 
             echo json_encode($status);
        }
        

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */