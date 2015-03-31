<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Mapdep_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='dokumenxdepart';
    }
    
    public function getAllMapDepartemens()
    {
        $query = "select * from dokumenxdepart";
        $results = $this->_select($query);
        return $results;
    }
    
    public function getIdDepartemens($id_dokumen)
    {
        $query = "select id_departemen from dokumen d, dokumenxdepart mk where d.id_dokumen = mk.id_dokumen and d.id_dokumen=?";
        $results = $this->_select($query,array($id_dokumen));
        $kategori=array();
        foreach ($results as $r)
        {
            array_push($kategori,($r->id_departemen));
        }
        return $kategori;
    }
    public function getNameDepartemens($id_dokumen)
    {
        $res = $this->getIdDepartemens($id_dokumen);
        
    }
    
    public function unroll($id_dokumen)
    {
        $this->_delete(array('id_dokumen'=>$id_dokumen));
        return;
    }
    
    public function isMap($id_dokumen)
    {
        return $this->_select('select * from dokumenxdepart where id_dokumen=?',array('id_dokumen'=>$id_dokumen));
    }
    
  
    public function setDepartemen($departemens,$id_dokumen)
    {
        if (!$departemens) return;
        foreach ($departemens as $dep) {
            $this->_insert(
                array(
                    'id_dokumen' => $id_dokumen,
                    'id_departemen' =>$dep
                )
            );
        }
    }
    
    public function checkDoubleName($data) {
        
    }
    
    
    
    
    
    
}