<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of departemen
 *
 * @author Felix Handani
 */
class Module_m extends MY_Model {
    public function __construct() {
        parent::__construct();

    }
    public function getAllModule()
    {
        $query=$this->db->query('SELECT * FROM modules order by id_module ASC');
        return $query->result();
    }
    
    public function getModulebyCode($code)
    {
        $sql=('SELECT * FROM modules where kode_nama=? order by id_module ASC');
        $query=$this->db->query($sql,array($code));
        $res = $query->row();
        if (count($res)<=0) return;
        else
            return $query->row()->id_module;
    }
    
    public function getModuleName($id_module)
    {
        if ($id_module == null)
            return array();
        $sql=('SELECT nama_module FROM modules WHERE id_module=?');
        $query=$this->db->query($sql,array($id_module));
        return $query->row();
    }
    
//    public function getModulePermission($id_akun)
//    {
//        if ($id_akun==null) $id_akun=-1;
//        $query = $this->db->query('select m.* from modules m ,hak_akses a ,aksesxmodule am, akun ak
//where am.id_module = m.id_module and am.id_hak_akses = a.id_hak_akses and ak.id_hak_akses = a.id_hak_akses
//	and ak.id_akun='.$id_akun);
//        
//        return $query->result();
//    }
//    
    public function getPermission($arr_user,$id_akun,$id_module)
    {
        $sql=('select * from aksesxmodule am, modules m
            where am.id_module = m.id_module and m.id_module=?');
        $query=$this->db->query($sql,array($id_module));
        $result = $query->result();
        $data= array();
        
        if (count($result) <=0 ) return $data;
        
        foreach ($arr_user as $user)
        {
            
            foreach($result as $r)
            {                
                if ($user->id_hak_akses == $r->id_hak_akses && $user->id_akun == $id_akun) {                    
                    array_push($data, array('id_akun'=> $user->id_akun,'nama_akun'=>$user->nama,
                        'id_hak_akses'=>$user->id_hak_akses,'nama_hak_akses'=>$user->nama_hak_akses,
                        'id_module'=> $r->id_module));
                }
            }
        }               
        
        return $data;
    }
    
    
    public function addModule()
    {
        $data=array(
            'nama_module'=>  $this->input->post('nama_module')
        );
        
        try
        {
            $this->db->insert('modules',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function editModule()
    {
        $data=array(
            'nama_module'=>  $this->input->post('val')
        );
        $this->db->where('id_module', $this->input->post('id'));
        $this->db->update('modules', $data); 
        return 'success';
    }
    
    public function removeModule()
    {
        $this->db->delete('modules', array('id_module'=> $this->input->post('id'))); 
        return 'success';
    }
}

?>
