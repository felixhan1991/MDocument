<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'review_m','documents/mapdep_m'));
        }
        
	
        public function index($id)
        {
            $reviewDoc=$this->document_m->getJobReviewDocumentbyStatus($this->_idUserActive);
            if (!$this->_checkAvailableDoc($id, $reviewDoc)) {
                echo 'Data Dokumen tidak ditemukan!';
                return;
            }
            if ($this->enroll_m->checkFinishedReview($id,$this->_idUserActive))
            {
                echo 'sudah direview';
                return;
            }
        
            $this->title="Review Document";
            $data['state']='view_form_document';
            $data['logs'] = $this->logging_m->getLog($id);
            $data['users'] = $this->document_m->getAllAkuns();
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['get_kategori']= $this->mapk_m->getIdKategoris($id);
            $data['get_departemen']= $this->mapdep_m->getIdDepartemens($id);
            $data['files']=$this->file_m->getFilesFromIdDocument($id);
            $data['version']=$this->file_m->getNumberVersion($id);
            $data['status'] = $this->status_m->getAllStatus();
            $data['reviews'] = $this->review_m->getReviews($id);
            $data['lampiran']=$this->file_m->getReferensiFromIdDocument($id);
            $data['urlView']="";
            $fileView=$this->_getLastFilePDF($id);
            if ($fileView)
                $data['urlView']=  'uploads/'.$fileView->id_dokumen.'/'.$fileView->nama_file;
            
            $this->form_validation->set_rules('judul', 'Form Check', 'callback_submitReview');
            $result_val=$this->form_validation->run();
            if ($result_val == FALSE)
            {
                $this->display('form_review',$data);
            }
            else
            {
                $this->session->set_flashdata('messageJob', "Data telah tersimpan!");
                redirect(base_url().'job','refresh');
            }
        }
        
        public function finishReview($id)
        {
            $reviewDoc=$this->document_m->getJobReviewDocumentbyStatus($this->_idUserActive);
            if (!$this->_checkAvailableDoc($id, $reviewDoc)) {
                echo 'Data Dokumen tidak ditemukan!';
                return;
            }
            $this->enroll_m->finishreview($id,$this->_idUserActive);
            $stepBackward=false; //parameter kembali
            $notyet_review=false; //parameter belum mereview
            //cek semuanya sudah review dan diterima?
            $reviews= $this->enroll_m->getIdReviewer($id);
            
            foreach ($reviews as $r) {
                if ($this->enroll_m->checkNotYetReview($id,$r)){
                        $notyet_review=true;
                        break;
                    }
                if (!$this->enroll_m->checkFinishedReview($id,$r)) {
                    $stepBackward=true;
                }
            }
            if ($notyet_review) {redirect(base_url().'job');}
            if ($stepBackward) { $data['modified_akun']=$this->_idUserActive; $this->document_m->sendToDraft($id,$data);} 
            if (!$stepBackward){ $data['modified_akun']=$this->_idUserActive; $this->document_m->sendToApprove($id,$data);} 
            redirect(base_url().'job');
            
        }
        public function submitReview()
        {
            $data['id_dokumen'] = $this->input->post('id_dokumen');
            $data['id_akun']=$this->_idUserActive;
            $data['tanggal_review']=date('d-m-Y G:i:s',now());
            $data['isi_review']=$this->input->post('komentar');
            
            
            $result = $this->review_m->submitReview($data);
            
            if ($result)
            {
                $this->enroll_m->revisionReview($data['id_dokumen'],$data['id_akun']);
                $stepBackward=false; //parameter kembali
                $notyet_review=false; //parameter belum mereview
                
                $reviews= $this->enroll_m->getIdReviewer($data['id_dokumen']);
                
                foreach ($reviews as $r) {
                    if ($this->enroll_m->checkRevisionReview($data['id_dokumen'],$r)){
                        $stepBackward=true;
                        
                    }
                    if ($this->enroll_m->checkNotYetReview($data['id_dokumen'],$r)){
                        $notyet_review=true;
                    }
                    
                }
                
                
                if ($stepBackward && !$notyet_review) {$data['modified_akun']=$this->_idUserActive; $this->document_m->sendToDraft($data['id_dokumen'],$data);}
                return true;
            }
            else
            {
                $this->form_validation->set_message('submitReview', 'Info: Terdapat kesalahan data!');
                return false;
            }
            
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
