<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Favorite_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='favorite';
    }
    
    public function checkDoubleFav($id_akun, $id_dok)
    {
        $query="select * from dokumen d, favorite f where d.id_dokumen=f.id_dokumen
             and f.id_akun=? and d.id_dokumen=?";
        $res = $this->_select($query,array($id_akun,$id_dok));
        if (count($res ) <=0) return false;
        return true;
    }
    public function getMyDocument($id_akun)
    {
        $query="select * from dokumen d, favorite f where d.id_dokumen=f.id_dokumen
             and f.id_akun=?";
        return $this->_select($query,array($id_akun));
    }
    
    public function addFav($id_dok, $id_akun){
        $data['id_dokumen']=$id_dok;
        $data['id_akun']=$id_akun;
        return $this->_insert($data);
    }
    
    public function checkDoubleName($data) {
        
    }
    
    
    
    
    
    
}