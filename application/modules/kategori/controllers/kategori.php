<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model(array('kategori_m','documents/document_m'));
            
        }
        
	public function index()
	{
            $this->title='Kategori';
            $data['state']='kategori';
            $data['kategori']=$this->kategori_m->getParentKategoriTree();
            $data['kategoris']=$data['kategori'];
            $data['logs']=array();
           
            $this->form_validation->set_rules('nm_kategori', 'Nama Kategori', 'trim|required|callback_addKategori');
            
            $r = $this->form_validation->run();
            if($r == FALSE)
            {
                $this->display('main',$data);
            }
            else
            {
                //Go to private area
                redirect(base_url().'kategori');
            }
            
	}
        public function viewChild($id)
        {
            if ($id==0) {redirect (base_url().'kategori');}
            $this->title='Kategori';
            $data['state']='kategori';
            $data['kategori']=$this->kategori_m->getChild($id);
            $data['kategoris']=$this->kategori_m->getParentKategoriTree();
            $data['logs']=array();
            $data['current_id']=$id;
            
            $res=$this->kategori_m->getParent($id);
            if (!empty($res))$data['parent_id'] = $res[0]->id_kategori;
            else $data['parent_id']=0;
            
            $this->form_validation->set_rules('nm_kategori', 'Nama Kategori', 'trim|required|callback_addKategori['.$id.']');
            
            $r = $this->form_validation->run();
            if($r == FALSE)
            {
                $this->display('main_child',$data);
            }
            else
            {
                //Go to private area
                redirect(base_url().'kategori/viewChild/'.$id);
            }
        }
        
        
        public function addKategori($nm_kategori,$parent_id=null)
        {
             $result=$this->kategori_m->addKategori($nm_kategori,$parent_id);    
             if (!$result)
             {
                 $this->form_validation->set_message('addKategori', 'Info: Nama Kategori sudah terpakai');
             }
             return $result;
            
        }
        
        public function editKategori()
        {
            $data=array(
                'nama_kategori'=>  $this->input->post('val')
            );
            $id=$this->input->post('id');
            
             $result = $this->kategori_m->editKategori($data,$id);
             if ($result === 'success')
             {
                $status = array("STATUS"=>"true");
             }
             else $status = array("STATUS"=>"false");
                 
             echo json_encode($status);
        }
        
        public function removeKategori()
        {
            $id=$this->input->post('id');
            $result = $this->kategori_m->removeKategori($id);
             if ($result === 'success')
             {
                $status = array("STATUS"=>"true");
             }
             else $status = array("STATUS"=>"false");
                 
             echo json_encode($status);
        }
        
        public function getChild()
        {
            $id=$this->input->get('id');
            if ($id==null)
            {
                echo json_encode (array("Status"=>"false"));
                return;
            }
            $result['list'] = $this->kategori_m->getChild($id);
            $data=$this->document_m->getShareDocumentbyKategori($id);
            
            $result['docs']=$this->_generatorTable($data);
            //print_r($result);
            echo json_encode($result);
        }
        private function _generatorTable($datas)
        {
            
             $strTemplate='
              
                
                    
                        
                    <div class="adv-table">
                        <label class="col-lg-12 control-label" style="text-align: left">
                        </label>
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-hover table-bordered" id="dynamic-table-draft">
                    <thead>
                    <tr >
                        <th class="center"></th>
                        <th class="center">Kode Dokumen</th>
                        <th class="center hidden-phone">Judul</th>
                        <th class="center">Waktu Pembuatan</th>
                       
                    </tr>
                    </thead>
                    <tbody>';
             foreach($datas as $data)
             {
                 $strTemplate.='<tr class="gradeC">
                        <td >        
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li> <a href="#" onclick="window.location=\''. base_url().'drive/add/'.$data->id_dokumen.'\'"><i class="fa fa-bookmark"></i> My Favorite!</a></li>
                                    <li class="divider"></li>
                                    <li> <a href="#" onclick="window.location=\''. base_url().'library/view/'.$data->id_dokumen.'\'"><i class="fa fa-eye"></i> View </a></li>';
                 if ($data->getlastfile===""|| $data->getlastfile==null) 
                 {
                     $strTemplate.='<li> <a href="#" onclick="window.location=\'#\'';
                 }
                 else {
                     $strTemplate.='<li> <a href="#" onclick="window.location=\''.base_url().'file/downloadFile?id_doc='.$data->id_dokumen.'&id_file='.$data->getlastfile.'\'">';
                 }
                     $strTemplate.='    
                                        <i class="fa fa-cloud-download"></i> Download
                                    </a></li>
                                </ul>
                            </div>
                        </td>
                        <td>'.$data->no_serial.'</td>
                        <td>'.$data->nama_dokumen.'</td>
                        <td>'.$data->tanggal_dokumen.'</td>
                    </tr>';
             }
                   
               $strTemplate.='
                   </tbody>
                    </table>
                    </div>
                    
                
            ';
               
               return $strTemplate;
        }
     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */