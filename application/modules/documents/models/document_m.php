<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Document_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='dokumen';
        
    }
    
    public function getAllDocument()
    {
        $query = "select * from dokumen order by tanggal_dokumen DESC";
        return $this->_select($query);
    }
    
    public function getAllDocumentwithStatus()
    {
        $query = "select * from dokumen d, status s where d.id_status = s.id_status order by d.tanggal_dokumen DESC";
        return $this->_select($query);
    }
    
    public function getAllDocumentbyStatus($id_status)
    {
        $query = "select * from dokumen d, status s where d.id_status = s.id_status and s.id_status=? order by d.tanggal_dokumen DESC";
        return $this->_select($query,array($id_status));
    }
    
    
    
    
    public function getShareDocumentbyDepart($id_departemen)
    {
        $query="select * from dokumen d, share s where d.id_dokumen=s.id_dokumen
             and s.id_departemen=?";
        return $this->_select($query,array($id_departemen));
    }
    public function getMyDocumentbyStatus($id_akun,$id_status){
        $query="select * from dokumen d, favorite f, status s where d.id_dokumen=f.id_dokumen
             and s.id_status = d.id_status and s.id_status =? and f.id_akun=?";
        return $this->_select($query,array($id_status,$id_akun));
    }
    
    public function getDocumentbyKategori($id_kategori)
    {
        //return $id_kategori;
        $query="select * from dokumen d, mapkategori mk where mk.id_dokumen=d.id_dokumen and mk.id_kategori =?";
        return $this->_select($query,array($id_kategori));
    }
    
    public function getMyDocumentbyKategori($id_akun, $id_kategori)
    {
        $query="select * from dokumen d, favorite f, mapkategori mk where d.id_dokumen=f.id_dokumen
             and mk.id_dokumen=d.id_dokumen and mk.id_kategori =? and f.id_akun=?";
        return $this->_select($query,array($id_kategori,$id_akun));
    }
    
    public function getJobDraftDocumentbyStatus($id_akun)
    {
        $query="select *,getLastFile(d.id_dokumen),getversiondok(d.id_dokumen) from dokumen d, enroll e where d.id_dokumen=e.id_dokumen 
            and e.id_role =? and d.id_status=? and e.id_akun=? ";
        return $this->_select($query,array(1,2,$id_akun));
    }
    
    public function getJobReviewDocumentbyStatus($id_akun)
    {
        $query="select *,getLastFile(d.id_dokumen),getversiondok(d.id_dokumen) from dokumen d, enroll e where d.id_dokumen=e.id_dokumen 
            and e.id_role =? and d.id_status=? and e.id_akun=? and ((e.finishreview<>1 and e.finishreview<>-1) or e.finishreview is null)";
        return $this->_select($query,array(2,3,$id_akun));
    }
    
    public function getJobApproveDocumentbyStatus($id_akun)
    {
        $query="select *,getLastFile(d.id_dokumen),getversiondok(d.id_dokumen) from dokumen d, enroll e where d.id_dokumen=e.id_dokumen 
            and e.id_role =? and d.id_status=? and e.id_akun=? and (e.finishapprove<>1 or e.finishapprove is null)";
        return $this->_select($query,array(3,4,$id_akun));
    }
    
    public function getAvailableDocument($offset=-1,$row=-1)
    {
        
        $query = "select *, getlastfile(d.id_dokumen) as getlastfile,getversiondok(d.id_dokumen) as getversiondok from dokumen d,status s 
            where s.id_status<>? and d.id_status=s.id_status order by tanggal_dokumen DESC ";
        if ($row >-1 && $offset >-1) $query.="LIMIT $row OFFSET $offset";
        $result=  $this->_select($query,array(1));

        return $result;
    }
    
    public function getManageDocument($id)
    {
        $query = "select *, getLastFile(d.id_dokumen),getversiondok(d.id_dokumen) from dokumen d,status s 
            where s.id_status<>? and d.id_status=s.id_status and d.admin_id=? order by tanggal_dokumen DESC";
        
        $result=  $this->_select($query,array(1,$id));

        return $result;
    }
    
    public function getShareDocument()
    {
        $query = "select *, getLastFile(d.id_dokumen),getversiondok(d.id_dokumen)from dokumen d,status s 
            where s.id_status=? and d.id_status=s.id_status  order by tanggal_dokumen DESC";
        
        $result=  $this->_select($query,array(6));

        return $result;
    }
    
    public function getShareDocumentbyKategori($id_kat)
    {
         $query = "select *, getLastFile(d.id_dokumen) as getlastfile,getversiondok(d.id_dokumen) as getversiondok from dokumen d,status s, mapkategori mk   
            where mk.id_dokumen=d.id_dokumen and mk.id_kategori =? and s.id_status=? and d.id_status=s.id_status  order by tanggal_dokumen DESC";
        
        $result=  $this->_select($query,array($id_kat,6));

        return $result;
    }
    
    public function getTrashDocument()
    {
        $query = "select *,getversiondok(d.id_dokumen) from dokumen d,status s 
            where s.id_status=? and d.id_status=s.id_status";
        return $this->_select($query,array(1)); // 1: Ditolak/Sampah
    }
    public function getDocumentbyId($id)
    {
        $query = "select * from dokumen where id_dokumen=?";
        $res= $this->_select($query,array($id));
        return $res[0];
    }
    
    public function getDocumentbyCode($code)
    {
        $query = "select * from dokumen where kode_dokumen=?";
        return $this->_select($query,array($code));
    }
    
    public function getOperatorDocument($id)
    {
        $res = $this->getAkunsDelegation($id);
        $arr=array();
        foreach ($res as $r)
        {
            if ($r->id_hak_akses ==3)
            {
                array_push($arr, $r);
            }
        }
        return $arr;
    }
    public function submitDocument($data,$upload=array())
    {
        
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        if ($this->_insert($data))
        {
            $temp = $this->getDocumentbyCode($data['kode_dokumen']);
            $tempData['id_dokumen']=$temp[0]->id_dokumen;
            $tempData['id_user_log']=$id_akun;
            $this->logging_m->make($tempData);
            
            return true;
        }
        return false;
    }
    
    public function updateDocument($data,$upload=array())
    {
        
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        $res = $this->_update($data,array('id_dokumen' => $data['id_dokumen']));
        if ($res ){
            
            $tempData['id_dokumen']=$data['id_dokumen'];
            $tempData['id_user_log']=$id_akun;
            if ($this->logging_m->update($tempData)){
            return true;
            }
            else return false;
        }
        return false;
    }
    
    public function checkDoubleName($data) {
        //hapus kode ini bila ingin incremen kode
        if (!isset($data['kode_dokumen']))
        {
            $data['kode_dokumen']='';
        }
        $this->db->select('*');
        $this->db->from($this->get('table'));
        $this->db->where('kode_dokumen', $data['kode_dokumen']);
        
        $this->db->limit(1);

        $query = $this->db->get();

        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
     public function checkDoubleCode($data) {
         //jika mau dibuat increment Code pakai fungsi ini
      if (!isset($data['kode_dokumen']))
        {
            $data['kode_dokumen']='';
        }

        $sql="select * from dokumen where kode_dokumen LIKE ? order by tanggal_dokumen DESC";
        $query=$this->db->query($sql, array($data['kode_dokumen'].'%'));
        
        if($query -> num_rows() > 0)
        {
            $res= $query->result();
            $data['kode_dokumen']=increment_string($res[0]->kode_dokumen);
        }
        
        return $data;
     }
        
    
    
    public function sendToTrash($id,$data=array())
    {
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        
        $data['id_status'] = 1;
        $res= $this->_update($data,array('id_dokumen' => $id));
        if ($res)
        {
            $tempData['id_dokumen']=$data['id_dokumen'];
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    
    public function sendToDraft($id,$datas=array())
    {
        $id_akun=$datas['modified_akun'];
        unset($datas['modified_akun']);
        
        $data['id_status'] = 2;
        $this->resetFinishApprove($id);
        $this->resetFinishReview($id);
        
        $res =  $this->_update($data,array('id_dokumen' => $id));
        if ($res){
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    public function sendToReview($id,$data=array())
    {
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        
        $data['id_status'] = 3;
        $this->resetFinishApprove($id);
        $this->resetFinishReview($id);
        
        $res =  $this->_update($data,array('id_dokumen' => $id));
        if ($res){
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    public function sendToApprove($id,$data=array())
    {
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        
        $data['id_status'] = 4;
        $res =  $this->_update($data,array('id_dokumen' => $id));
        if ($res){
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    public function sendToRelease($id,$data=array())
    {
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        
        $data['id_status'] = 5;
        $res =  $this->_update($data,array('id_dokumen' => $id));
        if ($res){
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    public function sendToShare($id,$data=array())
    {
        $id_akun=$data['modified_akun'];
        unset($data['modified_akun']);
        
        $data['id_status'] = 6;
        $res =  $this->_update($data,array('id_dokumen' => $id));
        if ($res){
            $tempData['id_dokumen']=$id;
            $tempData['id_user_log']=$id_akun;
            $tempData['destination_status']=$data['id_status'];
            $this->logging_m->sendTo($tempData);
            return true;
        }
        return false;
    }
    
    public function getDokumenPerKategori()
    {
        $kats=$this->kategori_m->getAllKategori();
        $dokumens = $this->mapk_m->getAllMapKategoris();
        $query=array();
        foreach($kats as $kat)
        {
            $temp=new stdClass();
            $temp->nama_kategori = $kat->nama_kategori;
            $i=0;
            foreach($dokumens as $dok)
            {
                if($kat->id_kategori === $dok->id_kategori)
                    $i++;
            }
            $temp->count=$i;
            array_push($query,$temp);
        }
        return $query;
    }
    
    public function getDokumenPerStatus()
    {
        $sql="
            select count(*) as jum, s.id_status, s.nama_status 
            from dokumen d, status s where d.id_status = s.id_status 
            group by s.id_status, s.nama_status
            ";
        $query=$this->_select($sql);
        return $query;
    }
    
    
    
//    public function getCommandLog() {
//        echo "Masuk ke GETCOMMANDLOG";
//        $data=$this->_command;
//        $this->_command=null;
//        return $data;
//    }
    
    
    
}