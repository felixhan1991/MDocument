<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approve extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'review_m','documents/mapdep_m'));
        }
        
        public function index($id)
        {
            $approveDocs=$this->document_m->getJobApproveDocumentbyStatus($this->_idUserActive);
            if (!$this->_checkAvailableDoc($id, $approveDocs)) {
                echo 'Data Dokumen tidak ditemukan!';
                return;
            }
            $this->enroll_m->finishapprove($id,$this->_idUserActive);
            $stepBackward=false; //parameter kembali
            $notyet_approve=false; //parameter belum mereview
            
            $approves= $this->enroll_m->getIdApproval($id);
            foreach ($approves as $r) {
                if ($this->enroll_m->checkNotYetApprove($id,$r)){
                        $notyet_approve=true;
                        break;
                    }
                if (!$this->enroll_m->checkFinishedApprove($id,$r)) {
                    $stepBackward=true;
                }
            }
            if ($notyet_approve) {redirect(base_url().'job');}
            if (!$stepBackward){ $data['modified_akun']=$this->_idUserActive; $this->document_m->sendToRelease($id);}
            redirect(base_url().'job');
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
