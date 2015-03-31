<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'review_m','documents/mapdep_m'));
        }

        
        public function index($id)
        {
            $this->title="Isi Dokumen";
            $data['state']='view_form_document';
            $data['logs'] = $this->logging_m->getLog($id);
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['version']=$this->file_m->getNumberVersion($id);
            $data['files']=$this->file_m->getFilesFromIdDocument($id);
            $data['lampiran']=$this->file_m->getReferensiFromIdDocument($id);
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['get_kategori']= $this->mapk_m->getIdKategoris($id);
            $data['get_departemen']= $this->mapdep_m->getIdDepartemens($id);
            $data['status'] = $this->status_m->getAllStatus();
            $data['reviews'] = $this->review_m->getReviews($id);
            $data['urlView']="";
            $fileView=$this->_getLastFilePDF($id);
            if ($fileView)
                $data['urlView']=  'uploads/'.$fileView->id_dokumen.'/'.$fileView->nama_file;
            
            $this->display('form_view',$data);
            
        }
    
        

     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
