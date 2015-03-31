<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Management_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model(array('documents/document_m','documents/enroll_m','kategori/kategori_m',
                'documents/mapk_m','drive/favorite_m','integra/akun_m'));
        }
        
	public function index()
	{
            $this->title="Dashboard";
                   
            $data['state'] = 'dashboard';
            $data['logs'] = array();
           
            $data['dokumen_kat']=$this->document_m->getDokumenPerKategori();
            $data['dokumen_stat']=$this->document_m->getDokumenPerStatus();
            
           
            $data['results']=array();
            $data['draftDoc']=$this->document_m->getJobDraftDocumentbyStatus($this->_idUserActive,2);
            
            $data['reviewDoc']=$this->document_m->getJobReviewDocumentbyStatus($this->_idUserActive,3);
            
            $data['approveDoc']=$this->document_m->getJobApproveDocumentbyStatus($this->_idUserActive,4);
            

            $data['num_release']=count($this->document_m->getAllDocumentbyStatus(5));
            $data['num_shared']=count($this->document_m->getAllDocumentbyStatus(6));

            $data['num_fav']=count($this->favorite_m->getMyDocument($this->_idUserActive));
     
           
            $this->display('main',$data);
	}
         public function logout()
    {
       
        $this->akun_m->removeTimeAccess($this->_idUserActive,null);
        session_start();
        $this->session->unset_userdata('edoc_in');
        $this->session->sess_destroy();
        session_destroy();
        
        
        
        redirect('dashboard', 'refresh');
    }
        

     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */