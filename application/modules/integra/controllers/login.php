<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Login extends Public_Controller 
{
    
            function __construct() {
            parent::__construct();
            $this->load->model(array('departemen_m','jabatan_m','akun_m'));
            
            
        }
        
        public function index()
	{
            $this->title="Login";
            $data['state'] = 'login';
            $data['logs'] = array();
            $this->theme_layout='template_login';
            $this->theme_partial=array();
            $this->display('login',$data);
           
            
	}
        
     
        
        function verifylogin()
        {
            
            //This method will have the credentials validation
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->title='Login';
                $data['state'] = 'Login';
                $this->theme_layout='template_login';
                //Field validation failed.  User redirected to login page
                $this->display('login',$data);
            }
            else
            {
                
                //Go to private area
                redirect('dashboard', 'refresh');
            }
        }
        function check_database($password)
        {
            
            //Field validation succeeded.  Validate against database
            $username = $this->input->post('username');
            //print_r($username);
            //query the database
            $result = $this->akun_m->login($username, $password);
            
            
            if($result)
            {
            
                if (!$this->akun_m->checkAvailableSess($result[0]->id_akun,$this->config->item('sess_expiration')))
                {

                    $this->form_validation->set_message('check_database', 'Maaf Akun Anda masih diakses di perangkat lain, mohon sign out terlebih dahulu');
                    return false;
                }
           
                
                
                $sess_array = array();
                    $sess_array = array(
                            'id_akun' => $result[0]->id_akun,
                            'nip' => $result[0]->nip,
                            'user_id' => $result[0]->id_akun,
                            'user_nip' => $result[0]->nip,
                            'nama' => $result[0]->nama,
                            'user_nama' => $result[0]->nama,
                            'user_email' => $result[0]->email,
                            'is_login' => TRUE,
                            'hp' => $result[0]->hp
                    );
                    
                    $this->session->set_userdata('edoc_in', $sess_array);
                  
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('check_database', 'Username dan Password salah');
                return false;
            }
        }
        
        
        
        
        
        
        
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
