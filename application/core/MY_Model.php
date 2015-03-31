<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
ob_start();
require_once APPPATH.'/libraries/UrlFactory.php';
require_once APPPATH.'/libraries/iController.php';
require_once APPPATH.'/libraries/iSubject.php';

class MY_Model extends CI_Model implements iController {//, iSubject {
    
    public function __construct() {
        parent::__construct();
        
    }
    //private $observers=array();
    
    private $data = array(
        
    );

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function get($name) {
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
    
    protected function _insert($data,$where='')
    {
//        $data['created'] = date('Y-m-d H:i:s',now());
//        $data['modified'] = date('Y-m-d H:i:s',now());
//        $controller=$data['controller'];
//        if ($controller!=null){
//            $this->attach($controller);
//        }
//        //echo $data['modified_akun'];
//        unset($data['controller']);
        
        if (!$this->checkDoubleName($data)){
            
            $result = $this->db->insert($this->data['table'],$data);
            if( !$result )
            {
               $errNo   = $this->db->_error_number();
               $errMess = $this->db->_error_message();
               echo $errMess;
               return false;
               // Do something with the error message or just show_404();
            }
        }
        else {
            return false;
        }
        
        
        return true;
    }
    
    protected function _update($data,$where=array())
    {
        $this->db->update($this->data['table'],$data,$where);
        //$this->notify();
        return true;
    }
    
    protected function _delete($where)
    {
        $this->db->delete($this->data['table'], $where); 
        //$this->notify();
        return true;
    }
    
    protected function _select($query,$data=array())
    {
        
        $result = $this->db->query($query,$data);
        
        
        if( !$result )
        {
           $errNo   = $this->db->_error_number();
           $errMess = $this->db->_error_message();
           return array();
           // Do something with the error message or just show_404();
        }
        return $result->result();
    }
    
    public function getAllDepartemens()
    {
        $query="select * from departemen";
        $res = $this->_select($query);
        //echo $string;
        return $res;
    }
    
    public function getDepartbyId($id)
    {
        $query="select * from departemen where id_departemen=?";
        $res = $this->_select($query,$id);
        return $res;
    }


    /*
     * Section User
     */
    public function getAllAkuns()
    {
        $query="select * from akun";
        $res=$this->_select($query);
        return $res;
    }
    
    public function getAkunbyId($id)
    {
        $query="select * from akun where id_akun=?";
        $res = $this->_select($query,$id);
        return $res;
    }
    
    public function getAkunsDelegation($id)
    {
        return $this->getAllAkuns()  ;
    }
    
    public function resetFinishReview($id_dokumen)
    {
        $this->db->set('finishreview',NULL); 
        $this->db->where('id_dokumen',$id_dokumen);
        $this->db->update('enroll');  
        
    }
    
    public function resetFinishApprove($id_dokumen)
    {
        $this->db->set('finishapprove',NULL); 
        $this->db->where('id_dokumen',$id_dokumen);
        $this->db->update('enroll');  
    }
    
    /*
     * end Section user
     */
    
    
   

    public function checkDoubleName($data) {
        show_error("Please Implementaion this Function!");
        return;
    }
    
//    public function getCommandLog()
//    {
//        show_error("Please Implementaion this Function!");
//        return;
//    }
//
//    public function attach(iObserver $observer_in) {
//         //could also use array_push($this->observers, $observer_in);
//        $this->observers[] = $observer_in;
//    }
//
//    public function detach(iObserver $observer_in) {
//         //$key = array_search($this->observers, $observer_in);
//        foreach($this->observers as $okey => $oval) {
//          if ($oval == $observer_in) { 
//            unset($this->observers[$okey]);
//          }
//        }
//    }
//
//    public function notify() {
//        
//        foreach($this->observers as $obs) {
//            print_r($this->getCommandLog());
//            $obs->update($this);
//        }
//    }
    

    
    
}