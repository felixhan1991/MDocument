<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documents extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('document_m','logging_m','enroll_m','file/file_m','mapk_m','job/review_m'));
        }
        
	public function index($page=1)
	{
            $this->load->library('pagination');
            $this->load->library('paginationlib');
            
            
            $this->title="Manajemen Dokumen";
            try
            {
                //$pagingConfig   = $this->paginationlib->initPagination("/documents/index",count($this->document_m->getAvailableDocument()));
                
                //$data["pagination_helper"]   = $this->pagination;
                //$data["documents"] = $this->document_m->getAvailableDocument((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
                //print_r($data['documents']);
                
                //print_r ($this->pagination->create_links());


            }
            catch (Exception $err)
            {
                log_message("error", $err->getMessage());
                return show_error($err->getMessage());
            }
            //Admin Utama: semua dokumen yang aktif
            //Admin Unit: semua dokumen yang dia tangani
            $data['documents'] = $this->document_m->getAvailableDocument() ;
            
            //print_r($data['documents']);
            
  
           
           

            $data['state'] = 'document';
            $data['logs'] = array();//get to database
            $this->display('main',$data);
	}        
        
        public function sendToTrash($id)
        {
            $data['modified_akun']=$this->_idUserActive;
            $this->document_m->sendToTrash($id,$data);
            redirect(base_url().'documents/trash');
        }
        
        public function sendToDraft($id)
        {
            $data['modified_akun']=$this->_idUserActive;
            $this->document_m->sendToDraft($id,$data);
            redirect(base_url().'documents');
        }       
        public function done($id)
        {
            $doc = $this->document_m->getDocumentbyId($id);
            if ($doc->id_status==5)
            {
                $data['modified_akun']=$this->_idUserActive;
                $this->document_m->sendToShare($id,$data);
                redirect(base_url().'documents');
            }
            else {
                $this->session->set_flashdata('message', "Dokumen harus di-approve terlebih dahulu!");
                redirect(base_url().'documents','refresh');
            }
        }
        
//        public function undone($id)
//        {
//            $doc = $this->document_m->getDocumentbyId($id);
//            if ($doc->id_status==6)
//            {
//                $data['modified_akun']=$this->_idUserActive;
//            $this->document_m->sendToRelease($id,$data);
//            redirect(base_url().'documents');
//            }
//            else {
//                $this->session->set_flashdata('message', "Dokumen harus sudah dishare terlebih dahulu!");
//                redirect(base_url().'documents','refresh');
//            }
//            
//        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
