<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drive extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model(array('documents/document_m','documents/enroll_m','kategori/kategori_m',
                'documents/mapk_m', 'file/file_m','favorite_m','documents/mapdep_m'));
        }
        
	public function index()
	{
            $this->title="Dataku";
                   
            $data['state'] = 'mydrive';
            //dokumen release + share sesuai departemen yang telah menjadi favorite 
            $dok_fav =$this->favorite_m->getMyDocument($this->_idUserActive);
            $dok_share = $this->document_m->getShareDocumentbyDepart($this->_idUserActive);
            $data['documents'] = $this->_merge_document($dok_fav,$dok_share);
            
            
            $authors=array();
            
            foreach ($data['documents'] as $doc)
            {
                $temp=  new stdClass();
                $temp->author=$this->enroll_m->getNameDrafter($doc->id_dokumen);
                $temp->name_file=$this->file_m->getLastFile($doc->id_dokumen);
                $authors[$doc->id_dokumen]=$temp;
            }
            
            $data['authors']= $authors;
            $data['logs'] = array();
            
            $this->display('main',$data);
	}
        
        private function _merge_document($docs1, $docs2)
        {
            $array=array();
            foreach ($docs1 as $d)
            {
                array_push($array,$d);
            }
            
            foreach ($docs2 as $d)
            {
                if (!in_array($d->id_dokumen,$array)) {continue;}
                array_push($docs1, $d);
            }
            return $docs1;
        }
        
        private function _isPermit($id)
        {
            //handling untuk Favorite yang double
            if ($this->favorite_m->checkDoubleFav($this->_idUserActive,$id)) return false;
            else return true;
        }
        public function add($id)
        {
            $res = $this->_isPermit($id);
            if ($res ) {
                $doc = $this->document_m->getDocumentbyId($id);
                if ($doc->id_status==6)
                {
                    $res = $this->favorite_m->addFav($id,$this->_idUserActive);
                    if ($res){
                        $this->session->set_flashdata('messageLib', "Dokuemn telah masuk ke Favorite Anda");
                        redirect(base_url().'library','refresh');
                    }

                }
                else {
                    $this->session->set_flashdata('messageLib', "Dokumen masih belum dapat di-share!!");
                    redirect(base_url().'library','refresh');
                }
            }
            else {
                $this->session->set_flashdata('messageLib', "Dokumen sudah ada di Favorite Anda!");
                    redirect(base_url().'library','refresh');
            }
        }
        
        public function view($id)
        {
            $this->title="Deskripsi Dokumen";
            if ($id===null || $id==""){ redirect (base_url().'drive/');}
            
            $data['state']='view_form_document';
            $data['logs'] = array();
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