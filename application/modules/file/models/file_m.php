<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class File_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='file';
    }
    
    public function insertFile($data,$id,$tanggal,$kategori)
    {
        $filing = array();
        $filing['id_dokumen']=$id;
        $filing['tanggal_file']=$tanggal;
        $filing['nama_file']=$data['file_name'];
        $filing['type_file']=$data['file_type'];
        $filing['size_file']=$data['file_size'];
        $filing['url_file']=$data['full_path'];
        $filing['kategori_file']=$kategori;
        $userActive=$data['userActive'];
        unset($data['userActive']);
        if ($this->_insert($filing))
        {
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$userActive;
            $this->logging_m->upload($tempData);
            return true;
        }
        return false;
    }
    
    public function getFilesFromIdDocument($id)
    {
        $query = "select * from file f,dokumen d 
            where f.id_dokumen=? and f.id_dokumen=d.id_dokumen
                 and f.kategori_file=?
            order by f.tanggal_file DESC";
        $result=  $this->_select($query,array($id,TRUE));
        return $result;
    }
    public function getPdfFromIdDocument($id)
    {
        $query = "select * from file f,dokumen d 
            where f.id_dokumen=? and f.id_dokumen=d.id_dokumen
                 and f.kategori_file=? and f.type_file='application/pdf'
            order by f.tanggal_file DESC";
        $result=  $this->_select($query,array($id,TRUE));
        return $result;
    }
    
    public function getNumberVersion($id)
    {
        $res = $this->getFilesFromIdDocument($id);
        return count($res);
    }
    
    public function getLastFile($id)
    {
        $res=$this->getFilesFromIdDocument($id);
        if (count($res)>0)
            return $res[0]->nama_file;
        else return '#';
    }
    
    public function getReferensiFromIdDocument($id)
    {
        $query = "select * from file f,dokumen d 
            where f.id_dokumen=? and f.id_dokumen=d.id_dokumen
                 and f.kategori_file=?
            order by f.tanggal_file DESC";
        $result=  $this->_select($query,array($id,FALSE));
        return $result;
    }
    
    public function deleteFileFromDatabase($id_file)
    {

        $this->_delete(array('id_file'=>$id_file));
        return;
    }
    public function checkDoubleName($data) {
        
    }
    
    
    
    
}