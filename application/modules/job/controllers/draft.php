<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Draft extends Public_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'review_m','documents/mapdep_m'));
        }
      
        public function index($id)
        {
            $draftDocs=$this->document_m->getJobDraftDocumentbyStatus($this->_idUserActive);
            if (!$this->_checkAvailableDoc($id, $draftDocs)) {
                echo 'Data Dokumen tidak ditemukan!';
                return;
            }
            
        
             $this->title="Edit Dokumen";
            $data['state']='edit_form_document';
            $data['logs'] = $this->logging_m->getLog($id);
            $data['status'] = $this->status_m->getAllStatus();
            $data['users'] = $this->document_m->getAllAkuns();
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['get_kategori']= $this->mapk_m->getIdKategoris($id);
            $data['get_departemen']= $this->mapdep_m->getIdDepartemens($id);
            $data['files']=$this->file_m->getFilesFromIdDocument($id);
            $data['version']=$this->file_m->getNumberVersion($id);
             $data['reviews'] = $this->review_m->getReviews($id);
            $this->form_validation->set_rules('judul', 'Form Check', 'callback_submitDraft');
            $result_val=$this->form_validation->run();
            if ($result_val == FALSE)
            {
                
                $this->display('form_draft',$data);
            }
            else
            {
                $this->session->set_flashdata('messageJob', "Data telah tersimpan!");
                redirect(base_url().'job','refresh');
            }
           
        }
        
        public function editFiles($id)
        {
            $this->title="Formulir Dokumen";
            $data['state']='edit_form_document';
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['files']=$this->file_m->getFilesFromIdDocument($id);
            $data['lampiran']=$this->file_m->getReferensiFromIdDocument($id);
                
                $this->display('form_file_edit',$data);
        }
        
        public function submitDraft()
        {
            $data['id_dokumen'] = $this->input->post('id_dokumen');
            
            $data['no_serial']= $this->input->post('nomor');
            $data['nama_dokumen']= $this->input->post('judul');
            $data['kode_dokumen'] = str_replace(' ','_',$data['nama_dokumen']);
            $data['deskripsi']= $this->input->post('deskripsi');
            
            $data['modified_akun']=$this->_idUserActive;
            $result = $this->document_m->updateDocument($data);
            if ($result)
            {
                $this->mapk_m->unroll($data['id_dokumen']);
                $this->mapdep_m->unroll($data['id_dokumen']);
                $this->mapk_m->setKategori($this->input->post('kategoris'),$data['id_dokumen']);
                $this->mapdep_m->setDepartemen($this->input->post('departemens'),$data['id_dokumen']);
                
                $tanggal_dokumen = date('d-m-Y G:i:s',now());
                 if (!empty($_FILES['doc']['name']) ||!empty($_FILES['ref']['name']) )
                 {
                     $hasil=$hasil2=array(
                         'result'=>false,
                         'message'=>'kosong'
                      );
                     $version=$this->file_m->getNumberVersion($data['id_dokumen'])+1;
                     if (!empty($_FILES['doc']['name'])) {
                            $time=  str_replace('-', '', $tanggal_dokumen);
                            $time=  str_replace(':', '', $time);
                            $time=  str_replace(' ', '', $time);
                            $name_file = $data['nama_dokumen'].'_'.$version.'_'.$time.$data['id_dokumen'];
                            $hasil= $this->upload($name_file,'doc',
                                array(
                                    'tanggal_dokumen' => $tanggal_dokumen,
                                    'id_dokumen'=>$data['id_dokumen']
                                )
                                );
                     }
                      if (!empty($_FILES['ref']['name']))
                      {
                            $time=  str_replace('-', '', $tanggal_dokumen);
                            $time=  str_replace(':', '', $time);
                            $time=  str_replace(' ', '', $time);
                            $name_file = $_FILES['ref']['name'];
                            $hasil2= $this->upload($name_file,'ref',
                                array(
                                    'tanggal_dokumen' => $tanggal_dokumen,
                                    'id_dokumen'=>$data['id_dokumen']
                                )
                                );
                      }
                    if (($hasil['result']==false )&& ($hasil2['result']==false))
                    {   
                        $this->form_validation->set_message('submitDraft', $hasil['message'].' '.$hasil2['message']);
                        return false;
                    }
                    else
                    {   
                        return true;
                    }
                }
                
                return true;
            }
            else {
                $this->form_validation->set_message('submitDraft', 'Info: Judul Dokumen Ganda!');
                
                return false;
            }
        }
        
        public function finishDraft($id)
        {
            $draftDocs=$this->document_m->getJobDraftDocumentbyStatus($this->_idUserActive);
            if (!$this->_checkAvailableDoc($id, $draftDocs)) {
                echo 'Data Dokumen tidak ditemukan!';
                return;
            }
            
            if (!$this->_checkAvailableFile($id)){    
                $this->session->set_flashdata('messageJob', "Maaf file PDF belum terupload!");
                redirect(base_url().'job','refresh');
            }
            $data['modified_akun']=$this->_idUserActive;
            $this->document_m->sendToReview($id,$data);
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
