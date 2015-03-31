<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'review_m','documents/mapdep_m'));
        }
        
	public function index()
	{
            $this->title="Pekerjaan Saya";
            $data['state']='job';
            
            $data['drafts']=$this->document_m->getJobDraftDocumentbyStatus($this->_idUserActive);
         
            
            $data['reviews']=$this->document_m->getJobReviewDocumentbyStatus($this->_idUserActive);
         
            
            $data['approvals']=$this->document_m->getJobApproveDocumentbyStatus($this->_idUserActive);
         
            
            $this->display('main',$data);
	}
        
        private function _checkAvailableDoc($id,$array)
        {
            $temp=array();
            foreach ($array as $val)
            {
                array_push($temp, $val->id_dokumen);
            }
            return in_array($id,$temp);
        }
        

     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
