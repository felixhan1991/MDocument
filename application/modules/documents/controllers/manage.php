<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
             $this->load->model(array('document_m','logging_m','enroll_m','file/file_m','mapk_m',
                                     'status/status_m','kategori/kategori_m','job/review_m','mapdep_m'));
        }
        
	public function index()
	{    
            $this->title="Manajemen Dokumen";
            //Admin Utama: semua dokumen yang aktif
            //Admin Unit: semua dokumen yang dia tangani
            $data['documents'] = $this->document_m->getManageDocument($this->_idUserActive) ;
            
            $data['state'] = 'document';
            
            $data['logs'] = array();//get to database
            
            $this->display('main_manage',$data);
	}        
        
        public function edit($id)
        {
            $this->title="Formulir Dokumen";
            $data['state']='edit_form_document';
            $data['logs'] = array();
            
            $data['users'] = $this->document_m->getAllAkuns();
            $data['document'] = $this->document_m->getDocumentbyId($id);
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['get_kategori']= $this->mapk_m->getIdKategoris($id);
            $data['get_departemen']= $this->mapdep_m->getIdDepartemens($id);
            $data['drafters']= $this->enroll_m->getIdDrafter($id);
            $data['reviewers']= $this->enroll_m->getIdReviewer($id);
            $data['approvals']= $this->enroll_m->getIdApproval($id);
            $data['files']=$this->file_m->getFilesFromIdDocument($id);
            $data['version']=$this->file_m->getNumberVersion($id);
            $data['reviews'] = $this->review_m->getReviews($id);
            $this->form_validation->set_rules('judul', 'Form Check', 'callback_actionUpdate');
            $result_val=$this->form_validation->run();
            if ($result_val == FALSE)
            {
                
                $this->display('form_manage_edit',$data);
            }
            else
            {
                $this->session->set_flashdata('message', "Data telah tersimpan!");
                redirect(base_url().'documents','refresh');
            }
            
        }
        
        public function form()
        {
            $this->title="Formulir Dokumen";
            $data['state']='form_document';
            $data['logs'] = array();
            
            $data['users'] = $this->document_m->getAllAkuns();
            $data['departemens']=$this->document_m->getAllDepartemens();
            $data['kategoris']= $this->kategori_m->getAllKategori();
            $this->form_validation->set_rules('judul', 'Form Check', 'callback_actionSubmit');
            $result_val=$this->form_validation->run();
            if ($result_val == FALSE)
            {
                $this->display('form_manage_new',$data);
            }
            else
            {
                $this->session->set_flashdata('message', "Data telah tersimpan!");
                redirect(base_url().'documents','refresh');
            }
            
        }
        
        public function actionUpdate()
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
                $this->mapdep_m->unroll($data['id_dokumen']);
                $this->mapk_m->unroll($data['id_dokumen']);
                $this->enroll_m->unroll($data['id_dokumen']);
                $this->mapdep_m->setDepartemen($this->input->post('departemens'),$data['id_dokumen']);
                $this->mapk_m->setKategori($this->input->post('kategoris'),$data['id_dokumen']);
                $this->enroll_m->setReviewer($this->input->post('reviewer'),$data['id_dokumen']);
                $this->enroll_m->setDrafter($this->input->post('drafter'),$data['id_dokumen']);
                $this->enroll_m->setApproval($this->input->post('approval'),$data['id_dokumen']);
                
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
                            $hasil=  $this->upload($name_file,'doc',
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
                        $this->form_validation->set_message('actionSubmit', $hasil['message'].' '.$hasil2['message']);
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
                $this->form_validation->set_message('actionSubmit', 'Info: Judul Dokumen Ganda!');
                
                return false;
            }
            
        }


        public function actionSubmit()
        {
            //new Document
            $data['nama_dokumen']= $this->input->post('judul');
            $data['deskripsi']= $this->input->post('deskripsi');
            $data['id_status'] = 2;
            $data['no_serial']= $this->input->post('nomor');
            $data['kode_dokumen'] = str_replace(' ','_',$data['nama_dokumen']);
            $data['tanggal_dokumen'] = date('d-m-Y G:i:s',now());
            $data['admin_id']=$this->_idUserActive;
            $data['modified_akun']=$this->_idUserActive;
            $result = $this->document_m->submitDocument($data);
            $documentAfterSubmit = $this->document_m->getDocumentbyCode($data['kode_dokumen']);
            if ($result)
            {
                $this->mapk_m->setKategori($this->input->post('kategoris'),$documentAfterSubmit[0]->id_dokumen);
                $this->enroll_m->setReviewer($this->input->post('reviewer'),$documentAfterSubmit[0]->id_dokumen);
                $this->enroll_m->setDrafter($this->input->post('drafter'),$documentAfterSubmit[0]->id_dokumen);
                $this->enroll_m->setApproval($this->input->post('approval'),$documentAfterSubmit[0]->id_dokumen);
                if (!empty($_FILES['doc']['name']) ||!empty($_FILES['ref']['name']) )
                 {
                     $hasil=$hasil2=array(
                         'result'=>false,
                         'message'=>'kosong'
                         );
                     $version=$this->file_m->getNumberVersion($documentAfterSubmit[0]->id_dokumen)+1;
                     if (!empty($_FILES['doc']['name'])) {
                            $time=  str_replace('-', '', $data['tanggal_dokumen']);
                            $time=  str_replace(':', '', $time);
                            $time=  str_replace(' ', '', $time);
                            $name_file = $documentAfterSubmit[0]->nama_dokumen.'_'.$version.
                                    '_'.$time.$documentAfterSubmit[0]->id_dokumen;
                            $hasil= $this->upload($name_file,'doc',
                                array(
                                    'tanggal_dokumen' => $data['tanggal_dokumen'],
                                    'id_dokumen'=>$documentAfterSubmit[0]->id_dokumen
                                )
                                );
                     }
                      if (!empty($_FILES['ref']['name']))
                      {
                            $time=  str_replace('-', '', $data['tanggal_dokumen']);
                            $time=  str_replace(':', '', $time);
                            $time=  str_replace(' ', '', $time);
                            $name_file = $_FILES['ref']['name'];
                            $hasil2=$this->upload($name_file,'ref',
                                array(
                                    'tanggal_dokumen' => $data['tanggal_dokumen'],
                                    'id_dokumen'=>$documentAfterSubmit[0]->id_dokumen
                                )
                                );
                      }
                       

                    if (($hasil['result']==false )&& ($hasil2['result']==false))
                    {   
                        $this->form_validation->set_message('actionSubmit', $hasil['message'].' '.$hasil2['message']);
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
                $this->form_validation->set_message('actionSubmit', 'Info: Judul Dokumen Ganda!');
                
                return false;
            }
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
        

       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
