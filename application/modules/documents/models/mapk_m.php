<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Mapk_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='mapkategori';
    }
    
    public function getAllMapKategoris()
    {
        $query = "select * from mapkategori";
        $results = $this->_select($query);
        return $results;
    }
    
    public function getIdKategoris($id_dokumen)
    {
        $query = "select id_kategori from dokumen d, mapkategori mk where d.id_dokumen = mk.id_dokumen and d.id_dokumen=?";
        $results = $this->_select($query,array($id_dokumen));
        $kategori=array();
        foreach ($results as $r)
        {
            array_push($kategori,($r->id_kategori));
        }
        return $kategori;
    }
    public function getNameKategoris($id_dokumen)
    {
        $res = $this->getIdKategoris($id_dokumen);
        
    }
    
    public function unroll($id_dokumen)
    {
        $this->_delete(array('id_dokumen'=>$id_dokumen));
        return;
    }
    
    public function isMap($id_dokumen)
    {
        return $this->_select('select * from mapkategori where id_dokumen=?',array('id_dokumen'=>$id_dokumen));
    }
    
  
    public function setKategori($kategoris,$id_dokumen)
    {
        if (!$kategoris) return;
        foreach ($kategoris as $kategori) {
            $this->_insert(
                array(
                    'id_dokumen' => $id_dokumen,
                    'id_kategori' =>$kategori
                )
            );
        }
    }
    
    public function checkDoubleName($data) {
        
    }
    
    
    
    
    
    
}