<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('hak_akses_m');
            
        }
        
	public function index()
	{
            $this->title='Hak Akses';
            $data['state']='hak_akses';
            $data['hakakses']=$this->hak_akses_m->getAllAkses($this->idApp);
            $data['logs']=array();
           
            $this->display('main',$data);
            
	}
        
        
        public function viewDetail()
        {
            $this->title='Rincian dan Mapping Hak Akses';
            $data['state']='hak_akses';
            $id_akses= $this->input->get('id');
            
            if ($id_akses==null || $id_akses==2 )
            {    
                redirect(base_url().'hakakses');
            }
            $akses = $this->hak_akses_m->getAksesbyId($this->idApp,$id_akses);
            if($akses==null) redirect(base_url().'hakakses');
            $modules = $this->module_m->getAllModule();
            $mappedModule=$this->_getMappedModule($id_akses);
            
            $data['logs']=array();
            $data['cols']=$modules;
            $data['module_data']=$mappedModule;
            $data['ent']=$akses;
            //print_r($akses);
            $this->display('details',$data);
        }
        
        public function map()
        {
            $this->title='Daftar User dengan Hak Akses';
            $data['state']='hak_akses';
            $data['users']=$this->module_m->getAkunsDelegation($this->idApp);
            $this->display('map',$data);
        }
        
        
        public function editDetAkses()
        {
            //hapus semua modulexakses
            $id_akses=$this->input->post('id');
            $modules=$this->input->post('modules');
          
            $result = $this->hak_akses_m->editDetAkses($id_akses,$modules);
            
             redirect(base_url().'hakakses');
        }
        
        private function _getMappedModule($id_akses)
        {
            $result= $this->hak_akses_m->getModules($id_akses);
            $arr = array();
            foreach ($result as $r)
            {
                array_push($arr, $r->id_module);
            }
            return $arr;
        }
   
     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */