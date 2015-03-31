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
class Departemen_m extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getAllDepartemen()
    {
        $query=$this->db->query('SELECT * FROM departemen order by id_departemen ASC');
        return $query->result();
    }
    public function getDepartemenName($id_departemen)
    {
        $sql = "SELECT nama_departemen FROM departemen WHERE id_departemen=?";
        $query= $this->db->query($sql, array($id_departemen));
//        $query=$this->db->query('SELECT nama_departemen FROM departemen WHERE id_departemen='.$id_departemen);
        return $query->row();
    }
    public function getDepartemenbyId($id_departemen)
    {
        $sql = "SELECT * FROM departemen WHERE id_departemen=?";
        $query= $this->db->query($sql, array($id_departemen));
//        $query=$this->db->query('SELECT * FROM departemen WHERE id_departemen='.$id_departemen);
        return $query->row();
    }
    
    
    
    public function addDepartemen()
    {
        $data=array(
            'nama_departemen'=>  $this->input->post('nama_departemen')
        );
        
        try
        {
            $this->db->insert('departemen',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function editDepartemen()
    {
        $data=array(
            'nama_departemen'=>  $this->input->post('val')
        );
        $this->db->where('id_departemen', $this->input->post('id'));
        $this->db->update('departemen', $data); 
        return 'success';
    }
    
    public function removeDepartemen()
    {
        $this->db->delete('departemen', array('id_departemen'=> $this->input->post('id'))); 
        return 'success';
    }
    public function checkName($str,$id=0)
    {
        $this->db->select('*');
        $this->db->from('departemen');
        $this->db->where('nama_departemen', $str);
        
        $this->db->where('id_departemen !=', $id);
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
}

?>
