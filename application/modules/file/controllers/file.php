<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends Public_Controller {
    public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m','documents/enroll_m',
                'file_m','documents/mapk_m'));
        }
        
        private function _preDownload($id_document,$nama_file)
        {
            
            if (empty($id_document)){
                echo "Parameter Dokumen hilang!";
                return false;
            }
            if (empty($nama_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
                        
            $document = $this->document_m->getDocumentbyId($id_document);
            if (count($document)<=0) {
                echo "File tidak didaftar di database!";
                return false;
            }
            return true;
        }
        
        public function downloadFile()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('id_file',TRUE);
            
            if (!$this->_preDownload($id_document,$nama_file))
                return;
            
            $file_tujuan="uploads/".$id_document."/".$nama_file;
            
            $data=  @file_get_contents($file_tujuan);
            if ($data===FALSE)
            {
                echo "File tidak ditemukan di-server!";
                return ;
            }
            
            $name=$nama_file;


            force_download($name, $data); 
        }
        
        public function downloadFileReferensi()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('id_file',TRUE);
            
            if (!$this->_preDownload($id_document,$nama_file))
                return;
            
            $file_tujuan="uploads/".$id_document."/lampiran/".$nama_file;
            
            $data=  @file_get_contents($file_tujuan);
            if ($data===FALSE)
            {
                echo "File tidak ditemukan di-server!";
                return ;
            }
            
            $name=$nama_file;


            force_download($name, $data); 
        }
        
        public function removeFileReferensi()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('nama_file',TRUE);
            $id_file = $this->input->get('id_file',TRUE);
            $link=$this->input->get('link',TRUE);
            
            if (empty($id_document)){
                echo "Parameter Dokumen hilang!";
                return false;
            }
            if (empty($nama_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
            if (empty($id_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
            
            $file_tujuan="uploads/".$id_document."/lampiran/".$nama_file;
            
            $res = @unlink($file_tujuan);
            if (!$res)
            {
                echo 'Data tidak dapat dihapus, karena tidak ditemukan Filenya!';
                return;
            }
            
            $this->file_m->deleteFileFromDatabase($id_file);
            if ($link==null || $link=='') 
                redirect(base_url().'documents/form/editFiles/'.$id_document);
            else 
                redirect($link);
        }
}