<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Enroll_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='enroll';
    }
    
     public function getDrafter($id_dokumen)
    {
        $query = "select id_akun from dokumen d, enroll e where d.id_dokumen = e.id_dokumen and d.id_dokumen=? and e.id_role=?";
        $results = $this->_select($query,array($id_dokumen,1));
        $drafter=array();
        foreach ($results as $r)
        {
            array_push($drafter,$this->getAkunbyId($r->id_akun));
        }
        return $drafter;
    }
    
    public function getIdDrafter($id_dokumen)
    {
        $res = $this->getDrafter($id_dokumen);
        $data = array();
        foreach ($res as $r)
        {
            array_push($data, $r->id_akun);
        }
        return $data;
        
    }
    
    public function getReviewer($id_dokumen)
    {
        $query = "select id_akun from dokumen d, enroll e where d.id_dokumen = e.id_dokumen and d.id_dokumen=? and e.id_role=?";
        $results = $this->_select($query,array($id_dokumen,2));
        $reviewer=array();
        foreach ($results as $r)
        {
            array_push($reviewer,$this->getAkunbyId($r->id_akun));
        }
        return $reviewer;
    }
    
    public function getIdReviewer($id_dokumen)
    {
        $res = $this->getReviewer($id_dokumen);
        $data = array();
        foreach ($res as $r)
        {
            array_push($data, $r->id_akun);
        }
        return $data;
        
    }
    public function getApproval($id_dokumen)
    {
        $query = "select id_akun from dokumen d, enroll e where d.id_dokumen = e.id_dokumen and d.id_dokumen=? and e.id_role=?";
        $results = $this->_select($query,array($id_dokumen,3));
        $approval=array();
        foreach ($results as $r)
        {
            array_push($approval,$this->getAkunbyId($r->id_akun));
        }
        return $approval;
    }
    
    public function getIdApproval($id_dokumen)
    {
        $res = $this->getApproval($id_dokumen);
        $data = array();
        foreach ($res as $r)
        {
            array_push($data, $r->id_akun);
        }
        return $data;
        
    }
    public function getNameDrafter($id_dokumen)
    {
        $authors= $this->getDrafter($id_dokumen);
        $nmAuthors = array();
        foreach ($authors as $value) {
            array_push($nmAuthors,$value->nama);
        }
        return $nmAuthors;
    }
    
    public function unroll($id_dokumen)
    {

        $this->_delete(array('id_dokumen'=>$id_dokumen));
        return;
    }
    
    public function isMap($id_dokumen)
    {
        return $this->_select('select * from enroll where id_dokumen=?',array('id_dokumen'=>$id_dokumen));
    }
    
    public function setReviewer($reviewers,$id_dokumen)
    {
        if (!$reviewers ){  return ;}

        foreach ($reviewers as $reviewer) {

            $this->_insert(
                array(
                    'id_dokumen' => $id_dokumen,
                    'id_akun' =>$reviewer,
                    'id_role' =>2
                )
            );
        }
    }
    
    public function setDrafter($draters, $id_dokumen)
    {
        if (!$draters ) return;
        foreach ($draters as $drafter) {
            $this->_insert(
                array(
                    'id_dokumen' => $id_dokumen,
                    'id_akun' =>$drafter,
                    'id_role' =>1
                )
            );
        }
    }
    
    public function setApproval($approvals,$id_dokumen)
    {
        if (!$approvals) return;
        foreach ($approvals as $approval) {
            $this->_insert(
                array(
                    'id_dokumen' => $id_dokumen,
                    'id_akun' =>$approval,
                    'id_role' =>3
                )
            );
        }
    }
    
    public function finishReview($id_dokumen,$id_user)
    {
        $data['finishreview']=1;
        $this->_update($data, array('id_dokumen'=> $id_dokumen, 'id_akun'=>$id_user, 'id_role'=>2));
    }
    
    public function revisionReview($id_dokumen,$id_user)
    {
        $data['finishreview']=-1;
        $this->_update($data, array('id_dokumen'=> $id_dokumen, 'id_akun'=>$id_user, 'id_role'=>2));
    }
    
    
    
    public function checkRevisionReview($id_dokumen,$id_user)
    {
        $query='select * from enroll where id_dokumen=? and id_role= 2 and id_akun=? and finishreview=-1';
        $res=$this->_select($query, array($id_dokumen,$id_user));
        
        if (count($res)<=0) return false;
        return true;
    }
    public function checkNotYetReview($id_dokumen,$id_user)
    {
        $query='select * from enroll where id_dokumen=? and id_role=2 and id_akun=? and ((finishreview <>-1 and finishreview<>1) or finishreview is null)';
        $res=$this->_select($query, array($id_dokumen,$id_user));        
        
        if (count($res)<=0) return false;
        return true;
    }
    
    public function checkFinishedReview($id_dokumen,$id_user)
    {
        $query='select * from enroll where id_dokumen=? and id_role= 2 and id_akun=? and finishreview=1';
        $res=$this->_select($query, array($id_dokumen,$id_user));
        if (count($res)<=0) return false;
        return true;
    }
    
    
    public function finishApprove($id_dokumen,$id_user)
    {
        $data['finishapprove']=1;
        $this->_update($data, array('id_dokumen'=> $id_dokumen, 'id_akun'=>$id_user,'id_role'=>3));
    }
    
    
    
    public function checkFinishedApprove($id_dokumen,$id_user)
    {
        $query='select * from enroll where id_dokumen=? and id_akun=? and finishapprove=1 and id_role=3';
        $res=$this->_select($query, array($id_dokumen,$id_user));
        if (count($res)<=0) return false;
        return true;
    }
    public function checkNotYetApprove($id_dokumen,$id_user)
    {
        $query='select * from enroll where id_dokumen=? and id_role=3 and id_akun=? and (finishapprove<>1 or finishapprove is null)';
        $res=$this->_select($query, array($id_dokumen,$id_user));        
        
        if (count($res)<=0) return false;
        return true;
    }
    
    public function checkDoubleName($data) {
        
    }
    
    
    
    
    
    
}