<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of departemen
 *
 * @author George Michael S.H
 */
class Hak_akses_m extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getAllAkses()
    {
        $query=$this->db->query('SELECT * FROM hak_akses order by id_hak_akses ASC');
        return $query->result();
    }
    public function getAksesName($id_hak_akses)
    {
        $sql = "SELECT nama_hak_akses FROM hak_akses WHERE id_hak_akses=?";
        $query= $this->db->query($sql, array($id_hak_akses));
//        $query=$this->db->query('SELECT nama_hak_akses FROM hak_akses WHERE id_hak_akses='.$id_hak_akses);
        return $query->row();
    }
    
    public function getAksesbyId($id_hak_akses)
    {
        $sql = "SELECT * FROM hak_akses WHERE id_hak_akses=?";
        $query= $this->db->query($sql, array($id_hak_akses));
//        $query=$this->db->query('SELECT * FROM hak_akses WHERE id_hak_akses='.$id_hak_akses);
        return $query->row();
    }
    
    public function addAkses()
    {
        $data=array(
            'nama_hak_akses'=>  $this->input->post('nama_hak_akses')
        );
        
        try
        {
            $this->db->insert('hak_akses',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function editAkses()
    {
        $data=array(
            'nama_hak_akses'=>  $this->input->post('val')
        );
        $this->db->where('id_hak_akses', $this->input->post('id'));
        $this->db->update('hak_akses', $data); 
        return 'success';
    }
    
    public function editDetAkses()
    {
        $data = array (
            'nama_hak_akses' => $this->input->post('nama')
        );
        $this->db->where('id_hak_akses', $this->input->post('id'));
        $this->db->update('hak_akses', $data); 
        
        //hapus semua modulexakses
        $this->db->delete('aksesxmodule', array('id_hak_akses'=> $this->input->post('id'))); 
        
        
        //input semua modulexakses
        foreach ($this->input->post('modules')as $m)
        {
            $data=array(
              'id_hak_akses' => $this->input->post('id'),
              'id_module' => $m
            );
            $this->db->insert('aksesxmodule',$data);
        }
        return true;
    }
    
    public function removeAkses()
    {
        $id = $this->input->post('id');
        if ($id ===0) return "failed"; 
        $this->db->delete('hak_akses', array('id_hak_akses'=>$id )); 
        return 'success';
    }
    
    public function mapping()
    {
        $id_akun = $this->input->post('id_akun');
        $id_akses = $this->input->post('hak_akses');
        $data  = array (
            'id_hak_akses'   => $id_akses
        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data); 
        return 'success';
    }
    
    public function getModules($id)
    {
        $sql = "SELECT id_module FROM aksesxmodule where id_hak_akses = ? order by id_hak_akses ASC";
        $query= $this->db->query($sql, array($id));
//        $query=$this->db->query('SELECT id_module FROM aksesxmodule where id_hak_akses = '.$id.'  order by id_hak_akses ASC');
        return $query->result();
    }
    
    public function getModifyHakAksesbySim($id_sim)
    {
        $sql = "select * from sim s, hak_akses ha, simxakses sa
                where s.id_sim = sa.id_sim and ha.id_hak_akses = sa.id_hak_akses
                and s.id_sim=?";
        $query= $this->db->query($sql, array($id_sim));
//        $query=$this->db->query("select * from sim s, hak_akses ha, simxakses sa
//                where s.id_sim = sa.id_sim and ha.id_hak_akses = sa.id_hak_akses
//                and s.id_sim=".$id_sim);
        return $query->result();
    }
    
    
}

?>
