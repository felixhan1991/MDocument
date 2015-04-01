<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("PERMITTED", 1);
define("NPERMITTED", 0);
define("NLOGIN", -1);
define("BYPASS", 100);

require_once APPPATH.'/libraries/UrlFactory.php';
require_once APPPATH.'/libraries/AkunFactory.php';
//require_once APPPATH.'/libraries/iObserver.php';

abstract class MY_Controller extends MX_Controller //implements iObserver {
{
    protected $_activeUser;
    protected $_idUsersPermit;
    protected $_idUserActive;
    protected $_observers=array();

    /*What string should be used to separate title segments sent via $this->template->title('Foo', 'Bar'); */

    private $data = array(
        'theme_folder' => 'default',
        'theme_layout' => 'template',
        'theme_partial' => array(
             array('name'=>'header', 'value' => 'layouts/header'),
             array('name'=>'footer', 'value' => 'layouts/footer'),
             array('name'=>'left-sidebar', 'value' => 'layouts/left-sidebar'),
             array('name'=>'script-footer', 'value' => 'script-footer'),
             array('name'=>'script-header', 'value' => 'script-header')
        )
    );
    
    /*
     * Setter dan Getter
     */
    function set_idModule()
    {
        $this->data['idModule']=$this->module_m->getModulebyCode($this->router->fetch_class());
     //   print_r($this->data['idModule']);
    }
    
    public function __set($name, $value)
	{
        $this->data[$name] = $value;
    }
    
    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
           return $this->data[$name];
        }
        else
        {
            echo 'error unset data '.$name;
        }
    }
	
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    public function __unset($name) {
        unset($this->data[$name]);
    }
    
    /**
    * Construct dari My Controller
    * @package Controller
    * @todo finish Modules dan Permission
    */
	protected function _defaultData()
	{
		$this->data = array(
			'theme_folder' => 'default',
			'theme_layout' => 'template',
			'theme_partial' => array(
				array('name'=>'header', 'value' => 'layouts/header'),
				array('name'=>'footer', 'value' => 'layouts/footer'),
				array('name'=>'right-sidebar', 'value' => 'layouts/right-sidebar'),
				array('name'=>'left-sidebar', 'value' => 'layouts/left-sidebar'),
				array('name'=>'script-footer', 'value' => 'script-footer'),
				array('name'=>'script-header', 'value' => 'script-header')
			)
		);
	}
   
    public function __construct()
	{
		parent::__construct();  
		
		//bug untuk form_validation
		$this->form_validation->CI =& $this; 
		$this->set_idModule();
		
		$this->_setActiveUser();
		
		$this->_idUsersPermit = $this->module_m->getAkunsDelegation($this->idApp);
		$statusPermit = $this->_getPermit();
		if ($statusPermit==BYPASS && $this->data['idModule']==10) //controller manage
			redirect(base_url().'documents');
		if ($statusPermit==NPERMITTED && $this->data['idModule']==2) //controller document
			redirect(base_url().'documents/manage');
		if ($statusPermit== NLOGIN) 
		{
			//echo 'test';
			redirect('integra/login');
		}
		else if ($statusPermit==NPERMITTED)
		{
			$message_403 = "Maaf, Anda tidak memiliki akses ke bagian ini.";
			$heading="Akses ditolak!";
			show_error($message_403 , 403,$heading); 

		}
	}
    
	private function _setActiveUser()
	{
		$edoc_session = $this->session->userdata('edoc_in');
		if ($edoc_session)
		{
			$this->_activeUser = $edoc_session['nama'];
			$this->_idUserActive = $edoc_session['id_akun'];
		}
		else
		{
			$this->_activeUser = "Guest";
			$this->_idUserActive = 0;
		}
	}
	
	public function display($view_page,$content=array())
	{
		$content['nama']=$this->_activeUser;
		//nice to be able to set title right in the controller in one shot. 
		//Before using template, I had to keep passing the title value here and 
		//there till it reached the header where finally it could get echoed.
		$this->template->title($this->data['title'],"SIM Management Dokumen");

		//'default_theme' is a folder name.
		$this->template->set_theme($this->data['theme_folder']);

		//This layout file can use $template['variables'] to put your contents
		$this->template->set_layout($this->data['theme_layout']);

		//setting partials view. see the image above for header.php and footer.php locations.
		//these will be available in layout file as $template['partials']['header'] and 
		//$template['partials']['footer']
		
		foreach ($this->data['theme_partial']as $part)
		{
			$this->template->set_partial($part['name'],$part['value'],$content);
		}
		
		//the main content view that contains about page's content. 
		//this will be available in layout file as $template['body']
		
		$res= $this->template->build($view_page,$content);
		return $res;     
	}
        
	/*
	* @package		IntegraRSUD
	* @author		Felix - Artcak Media Digital
	* @copyright	Copyright (c) 2014
	* @link		http://artcak.com
	* @since		Version 1.0
	*/
	protected function _getSession()
	{
		return $this->session->userdata('edoc_in') === false ? false : true;
	}
	
	abstract  protected function _getPermit();
	
	private function _preUpload($data)
	{
		$this->load->helper(array('date','download','file'));
		// create an folder if not already exist in uploads dir
		// wouldn't make more sence if this part is done if there are no errors and right before the upload ??
		if (!is_dir('uploads'))
		{
			mkdir('./uploads', 0777, true);
		}
		$dir_exist = true; // flag for checking the directory exist or not
		$dir_name=$data['id_dokumen'];
		if (!is_dir('uploads/' . $dir_name))
		{
			mkdir('./uploads/' . $dir_name, 0777, true);
			mkdir('./uploads/' . $dir_name . '/lampiran/', 0777, true);
			$dir_exist = false; // dir not exist
		}
		
		//make index.html file for security
		$data_tulis = '<html>
				<head>
						<title>403 Forbidden</title>
				</head>
				<body>

				<p>Directory access is forbidden.</p>

				</body>
				</html>
				';
		$write1='uploads'.DIRECTORY_SEPARATOR.$dir_name.
				DIRECTORY_SEPARATOR.'index.html';
		$write2='uploads'.DIRECTORY_SEPARATOR.$dir_name.
				DIRECTORY_SEPARATOR.'lampiran'.DIRECTORY_SEPARATOR.'index.html';
		if ( !write_file($write1, $data_tulis) )
		{
			 $message= 'Unable to write the file index awal';
			 return array('result'=>false,'message'=> $message);
		}
		else if (!write_file($write2, $data_tulis) )
		{
			$message= 'Unable to write the file index lampiran';
			return array('result'=>false,'message'=> $message);
		}
		else 
		{
			 $message= 'File written!';
			 return array('result'=>true, 'message'=>$dir_name);
		}
	}
	
	protected function upload($name_file,$field_name,$data)
	{
		$res = $this->_preUpload($data);
		if (!$res['result'])
		{
		   return array('result'=>false,'message'=> $res['message']); 
		}
		$dir_name=$res['message'];
		//FALSE untuk lampiran; TRUE untuk file versioning
		$kategori=FALSE;
		
		//Configure
		//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
		if ($field_name==='doc'){
			$config['upload_path'] = './uploads/'.$dir_name;
			$config['allowed_types'] = 'doc|docx|pdf';
			$kategori=TRUE;
		}
		else if ($field_name==='ref')
		{
			$config['upload_path'] = './uploads/'.$dir_name.'/lampiran/';
			$config['allowed_types'] = '*';
		}
		else return array('result'=>true, 'message'=>'Unknown Field Name');
		
		// set the filter image types
		
		$config['file_name']= $name_file;
		$config['overwrite'] = false;
		//load the upload library
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
		
		//if not successful, set the error message
		if (!$this->upload->do_upload($field_name)) {
			return array('result'=>false,'message'=> $this->upload->display_errors());
		} else { 
			$datas = $this->upload->data();
			$datas['userActive']=$this->_idUserActive;
			$this->file_m->insertFile($datas,$data['id_dokumen'],$data['tanggal_dokumen'],$kategori);
			
			return array('result'=>true, 'message'=>$data);
		}
	}
	
	protected function _checkAvailableFile($id)
	{
		$files= $this->file_m->getPdfFromIdDocument($id);
		
		if (count($files)>=1) {
			return true;
		}
		else false;
	}
	
	protected function _getLastFilePDF($id)
	{
		$files= $this->file_m->getPdfFromIdDocument($id);
		
		if (count($files)>=1) {
			return $files[0];
		}
		else false;
	}
        
//        public function update(iSubject $subject_in) {
//            var_dump($subject_in);
//            $data = $subject_in->getCommandLog();
//            
//            if ($data)
//                $this->logging_m->addLog($data);
//            else 
//                show_error ("Ada Log yang kurang!");
//        }
        
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */