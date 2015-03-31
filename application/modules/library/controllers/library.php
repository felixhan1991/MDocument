<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model(array('documents/document_m','documents/logging_m','documents/enroll_m','file/file_m',
                'status/status_m','kategori/kategori_m','documents/mapk_m','documents/mapdep_m'));
        }
        
	public function index()
	{
            $this->title="Perpustakaan Dokumen";
            $data['documents'] = $this->document_m->getShareDocument() ;
            $data['kategoris']= $this->kategori_m->getParentKategoriTree();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['state'] = 'document';
            $this->display('main',$data);
	}
        
        public function view($id)
        {
            $this->title="Isi Dokumen";
            if ($id===null || $id==""){ redirect (base_url().'library/');}
            
            $data['state']='view_form_document';
            
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['get_kategori']= $this->mapk_m->getIdKategoris($id);
            $data['get_departemen']= $this->mapdep_m->getIdDepartemens($id);
            $data['urlView']="";
            $fileView=$this->_getLastFilePDF($id);
            if ($fileView)
                $data['urlView']=  'uploads/'.$fileView->id_dokumen.'/'.$fileView->nama_file;
            
            $this->display('form_view',$data);
        }
    

     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */