<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Logging_m extends MY_Model  {
    
    public function __construct() {
        parent::__construct();
        $this->table='logging';
    }
    
    public function make($data){
        $data['keterangan_log']="Buat Dokumen berhasil!";
        $data['tanggal_log']=date('d-m-Y G:i:s',now());
        $data['destination_status']=1;
        return $this->_insert($data);
    }
    
    public function makeReview($data){
        $data['keterangan_log']="Buat Review berhasil!";
        $data['tanggal_log']=date('d-m-Y G:i:s',now());
        
        
        $data['destination_status']=-1;
        return $this->_insert($data);
    }
    public function update($data){
        
        $data['keterangan_log']="Update finish!";
        $data['tanggal_log']=date('d-m-Y G:i:s',now());
        
        return $this->_insert($data);
    }
    
    public function sendTo($data){
        $query = "select * from status where id_status=?";
        $res = $this->_select($query,array($data['destination_status']));
        $destinasi="";
        if ($res)
        {
            $destinasi=$res[0]->nama_status;
        }
        $data['keterangan_log']="Ubah Status '".$destinasi."' berhasil!";
        $data['tanggal_log']=date('d-m-Y G:i:s',now());
        return $this->_insert($data);
    }
    
    public function upload($data){
        $data['keterangan_log']="Upload berhasil!";
        $data['tanggal_log']=date('d-m-Y G:i:s',now());
        return $this->_insert($data);
    }
    
    public function getLog($id_dok)
    {
        $sql = "select * from logging where id_dokumen=? order by id_log DESC";
        $res = $this->_select($sql,array($id_dok));
        if ($res)
        {
            return $res;
        };
        return false;
    }
    
    
    public function checkDoubleName($data) {
        
    }   
    
    
    
    
}