<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Review_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='review';
    }
    
    public function submitReview($data){
        
        
        if ($this->_insert($data))
        {
            $tempData['id_dokumen']=$data['id_dokumen'];
            $tempData['id_user_log']=$data['id_akun'];
            $this->logging_m->makeReview($tempData);
            return true;
        }
        else return false;
        
    }
    
    public function getReviews($id)
    {
        $res= $this->_select('select * from review where id_dokumen=?',array($id));
        foreach ($res as $r)
        {
            $akun=$this->getAkunbyId($r->id_akun);
            if (isset($akun) || $akun!=null)
            {
                $r->nama_akun=$akun->nama;
            }
        }
        return $res;
    }
    
    
    
    public function checkDoubleName($data) {
        
    }
    
    
    
    
    
    
}