<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends Admin_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper(array('date','download','file'));
		$this->load->model(array('document_m','logging_m','enroll_m','file/file_m','mapk_m',
								 'status/status_m','kategori/kategori_m','job/review_m','mapdep_m'));
	}
        
	public function index()
	{
		$this->title="Formulir Dokumen";
		$data['state']='form_document';
		
		$data['status'] = $this->status_m->getAllStatus();
		$data['users'] = $this->document_m->getAllAkuns();
		$data['users_del']=$this->document_m->getOperatorDocument($this->idApp);
		$data['departemens']=$this->document_m->getAllDepartemens();
		$data['kategoris']= $this->kategori_m->getAllKategori();
		
		$this->form_validation->set_rules('judul', 'Form Check', 'callback_actionSubmit');
		$result_val=$this->form_validation->run();
		if ($result_val == FALSE)
		{
			$this->display('form_new',$data);
		}
		else
		{
			$this->session->set_flashdata('message', "Data telah tersimpan!");
			redirect(base_url().'documents');
		}
		
	}
	
	public function view($id)
	{
		$this->title="Formulir Dokumen";
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
		$data['users'] = $this->document_m->getAllAkuns();
		$data['drafters']= $this->enroll_m->getIdDrafter($id);
		$data['reviewers']= $this->enroll_m->getIdReviewer($id);
		$data['approvals']= $this->enroll_m->getIdApproval($id);
		$data['reviews'] = $this->review_m->getReviews($id);
		//print_r($data['logs']);
		$this->display('form_view',$data);
	}
	
	public function edit($id)
	{
		$this->title="Formulir Dokumen";
		$data['state']='edit_form_document';
		$data['logs'] = $this->logging_m->getLog($id);
		$data['status'] = $this->status_m->getAllStatus();
		$data['users'] = $this->document_m->getAllAkuns();
		$data['users_del']=$this->document_m->getOperatorDocument($this->idApp);
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
			
			$this->display('form_edit',$data);
		}
		else
		{
			$this->session->set_flashdata('message', "Data telah tersimpan!");
			redirect(base_url().'documents','refresh');
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
	
	
	public function actionUpdate()
	{
		
		$data['id_dokumen'] = $this->input->post('id_dokumen');
		
		$data['no_serial']= $this->input->post('nomor');
		$data['nama_dokumen']= $this->input->post('judul');
		$data['kode_dokumen'] = str_replace(' ','_',$data['nama_dokumen']);
		$data['deskripsi']= $this->input->post('deskripsi');
		$data['id_status'] = $this->input->post('status');
		if ($this->_changeStatus($data['id_dokumen'],$data['id_status']))
		{
			
			$tempData['id_dokumen']=$data['id_dokumen'];
			$tempData['id_user_log']=$this->_idUserActive;
			$tempData['destination_status']=$data['id_status'];
			$this->logging_m->sendTo($tempData);
		}
		$data['modified_akun']=$this->_idUserActive;
		$result = $this->document_m->updateDocument($data);
		if ($result)
		{
			$this->mapdep_m->unroll($data['id_dokumen']);
			$this->enroll_m->unroll($data['id_dokumen']);
			$this->mapk_m->unroll($data['id_dokumen']);
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
		$curdate = date_create();
		$data['nama_dokumen']= $this->input->post('judul');
		$data['deskripsi']= $this->input->post('deskripsi');
		$data['id_status'] = 2;
		$data['no_serial']= $this->input->post('nomor');
		$data['kode_dokumen'] = str_replace(' ','_',$data['nama_dokumen']);
		
		$tanggal_dokumen = $curdate->format('d-m-Y G:i:s');
		$data['tanggal_dokumen'] = $curdate->format('Y-m-d H:i:s');
		
		$data['admin_id']=$this->input->post('admin');
		$data['modified_akun']=$this->_idUserActive;
		
		$result = $this->document_m->submitDocument($data);
		$documentAfterSubmit = $this->document_m->getDocumentbyCode($data['kode_dokumen']);
		if ($result)
		{
			$this->mapk_m->setKategori($this->input->post('kategoris'),$documentAfterSubmit[0]->id_dokumen);
			$this->mapdep_m->setDepartemen($this->input->post('departemens'),$documentAfterSubmit[0]->id_dokumen);
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
					$time=  str_replace('-', '', $tanggal_dokumen);
					$time=  str_replace(':', '', $time);
					$time=  str_replace(' ', '', $time);
					$name_file = $documentAfterSubmit[0]->nama_dokumen.'_'.$version.
							'_'.$time.$documentAfterSubmit[0]->id_dokumen;
					$hasil= $this->upload($name_file,'doc',
						array(
							'tanggal_dokumen' => $tanggal_dokumen,
							'id_dokumen'=>$documentAfterSubmit[0]->id_dokumen
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
	
	private function _changeStatus($id_dokumen, $id_status)
	{
		$dok = $this->document_m->getDocumentbyId($id_dokumen);
		if ($dok->id_status != $id_status)
			return true;
		else return false;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
