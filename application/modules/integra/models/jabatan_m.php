<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jabatan
 *
 * @author George Michael S.H
 */
class Jabatan_m extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function getAllJabatan()
    {
        $query=$this->db->query('SELECT * FROM jabatan order by id_jabatan ASC');
        return $query->result();
    }
    public function getJabatanName($id_jabatan)
    {
        $sql = "SELECT nama_jabatan FROM jabatan WHERE id_jabatan=?";
//        $query=$this->db->query('SELECT nama_jabatan FROM jabatan WHERE id_jabatan='.$id_jabatan);
        $query= $this->db->query($sql, array($id_jabatan));
        return $query->row();
    }
    
    public function get_all_modul_taskman(){
        $query = $this->db->get('modul_taskman');
        return $query->result();
    }
    
    public function get_mapped_modul_taskman($idjab)
    {
        $sql = "select distinct a.id_modul_taskman, a.nama_modul_taskman from modul_taskman as a
        left join jabatanxtaskman as b on (a.id_modul_taskman = b.id_modul_taskman)
        where b.id_jabatan=?";
        $query= $this->db->query($sql, array($idjab));
//        $query = $this->db->query("select distinct a.id_modul_taskman, a.nama_modul_taskman from modul_taskman as a
//        left join jabatanxtaskman as b on (a.id_modul_taskman = b.id_modul_taskman)
//        where b.id_jabatan = $idjab");
        return $query->result();
    }
    
    public function get_modul_akses_taskman($idjabatan)
    {
        $sql = "SELECT id_modul_taskman FROM jabatanxtaskman 
        where id_jabatan=?";
        $query= $this->db->query($sql, array($idjabatan));
//        $query = $this->db->query("SELECT id_modul_taskman FROM jabatanxtaskman 
//        where id_jabatan = $idjabatan");
        return $query->result();
    }
    
    public function getJabatanbyId($id_jabatan)
    {
        $sql="SELECT * FROM jabatan WHERE id_jabatan=?";
        $query= $this->db->query($sql, array($id_jabatan));
//        $query=$this->db->query('SELECT * FROM jabatan WHERE id_jabatan='.$id_jabatan);
        return $query->row();
    }
    
    public function checkName($str,$id=0)
    {
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where('nama_jabatan', $str);
        $this->db->where('id_jabatan !=', $id);
        
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
    
    public function getatasan_byidakun($idakun)
    {
        $sql="select c.id_akun, c.nip, c.nama, c.alamat, c.jenis_kelamin,c.agama, c.telepon, c.hp, c.email, c.id_jabatan, c.nama_jabatan, c.id_departemen, c.nama_departemen from akun_pegdep as c where c.id_jabatan = (select a.id_parent_jabatan from akun_pegdep as a where a.id_akun =?)";
        $query= $this->db->query($sql, array($idakun));
//        $query=$this->db->query("select c.id_akun, c.nip, c.nama, c.alamat, c.jenis_kelamin,c.agama, c.telepon, c.hp, c.email, c.id_jabatan, c.nama_jabatan, c.id_departemen, c.nama_departemen from akun_pegdep as c where c.id_jabatan = (select a.id_parent_jabatan from akun_pegdep as a where a.id_akun = $idakun)");
        return $query->row();
    }
    
    public function getatasan_byidjab($idjab)
    {
        $sql="select * from jabatan as j where j.id_jabatan in (select a.id_parent_jabatan from jabatanxdep as a where a.id_jabatan = ?)";
        $query= $this->db->query($sql, array($idjab));
//        $query=$this->db->query("select distinct c.id_jabatan, c.nama_jabatan from akun_pegdep as c where c.id_jabatan in (select a.id_parent_jabatan from akun_pegdep as a where a.id_jabatan = $idjab)");
//        $query=$this->db->query("select * from jabatan as j where j.id_jabatan in (select a.id_parent_jabatan from jabatanxdep as a where a.id_jabatan = $idjab)");
        return $query->result();
    }
    
    public function get_all_akun() {
        $query = $this->db->get('akun');
        return $query->result();
    }
    
    public function cari_atasan($idakun)
    {
        $sql="select distinct c.id_akun, c.nip, c.nama, c.alamat, c.jenis_kelamin,c.agama, c.telepon, c.hp, c.email, c.id_jabatan, c.nama_jabatan, c.id_departemen, c.nama_departemen from akun_pegdep as c where c.id_akun in (select distinct c.id_akun from akun_pegdep as c where c.id_jabatan in (select a.id_parent_jabatan from akun_pegdep as a where a.id_akun =?))";
        $query= $this->db->query($sql, array($idakun));
//        $query=$this->db->query("select distinct c.id_akun, c.nip, c.nama, c.alamat, c.jenis_kelamin,c.agama, c.telepon, c.hp, c.email, c.id_jabatan, c.nama_jabatan, c.id_departemen, c.nama_departemen from akun_pegdep as c where c.id_akun in (select distinct c.id_akun from akun_pegdep as c where c.id_jabatan in (select a.id_parent_jabatan from akun_pegdep as a where a.id_akun = $idakun))");
        return $query->result();
    }
    
    public function addJabatan()
    {
        $data=array(
            'nama_jabatan'=>  $this->input->post('nama_jabatan')
        );
        
        try
        {
            $this->db->insert('jabatan',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function del_mapping_jabatan($idjabatan,$departemen) {
        $this->db->where('id_jabatan', $idjabatan);
        $this->db->where('id_departemen', $departemen);
        $this->db->delete('jabatanxdep'); 
        return true;
    }
    
    public function del_mapping_akun($idjabatan,$departemen) {
        $this->db->where('id_jabatan', $idjabatan);
        $this->db->where('id_departemen', $departemen);
        $this->db->delete('penugasan'); 
        return true;
    }
    
    public function add_mapping_jabatan($idjabatan,$departemen, $idparenjab) {
        $data=array(
            'id_jabatan'=>  $idjabatan,
            'id_departemen'=>  $departemen,
            'id_parent_jabatan'=>  $idparenjab
        );
        
        try
        {
            $this->db->insert('jabatanxdep',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function add_mapping_akun($idjabatan,$departemen, $idakun) {
        $data=array(
            'id_jabatan'=>  $idjabatan,
            'id_departemen'=>  $departemen,
            'id_akun'=>  $idakun
        );
        
        try
        {
            $this->db->insert('penugasan',$data);
            return true;
        }
        catch (Exception $exc)
        {
            return $exc->getMessage();
        }
    }
    
    public function editJabatan()
    {
        $data=array(
            'nama_jabatan'=>  $this->input->post('val')
        );
        $this->db->where('id_jabatan', $this->input->post('id'));
        $this->db->update('jabatan', $data); 
        return 'success';
    }
    
    public function editDetJabatan()
    {
        $data = array (
            'nama_jabatan' => $this->input->post('nama')
        );
        $this->db->where('id_jabatan', $this->input->post('id'));
        $this->db->update('jabatan', $data); 
        $id_jabatan = $this->input->post('id');
        $departemens = $this->input->post('departemens');
        
        //hapus semua modulexakses
        try {
            $this->db->delete('jabatanxdep', array('id_jabatan'=> $id_jabatan)); 
        }
        catch (Exception $ex)
        {
            echo 'Data tidak data dihapus, karena memiliki relasi';
        }
        
        //input semua modulexakses
        foreach ($departemens as $m)
        {
            if ($this->_isExist($id_jabatan, $m)) continue;
            $data=array(
              'id_jabatan' => $id_jabatan,
              'id_departemen' => $m
            );
            $this->db->insert('jabatanxdep',$data);
        }
        return true;
    }
    
    public function removeJabatan()
    {
        $this->db->delete('jabatan', array('id_jabatan'=> $this->input->post('id'))); 
        return 'success';
    }
    
    public function getDepartemen($id)
    {
        $sql="SELECT id_departemen FROM jabatanxdep where id_jabatan =?  order by id_jabatan ASC";
        $query= $this->db->query($sql, array($id));
//        $query=$this->db->query('SELECT id_departemen FROM jabatanxdep where id_jabatan = '.$id.'  order by id_jabatan ASC');
        return $query->result();
    }
    
    public function getJabDep()
    {
        $query = $this->db->get('jabatanxdep');
//        $query=$this->db->query('Select * from jabatanxdep');
        return $query->result();
    }
    
    function get_jabdep_fromview() {
        $query = $this->db->query('select distinct nama, nama_jabatan, id_akun, id_jabatan from akun_pegdep');
        return $query->result();
    }
    
    public function getjabdep_byidjab($idjab) {
        $sql="select distinct * from akun_pegdep as a where a.id_jabatan =?";
        $query= $this->db->query($sql, array($idjab));
//        $query = $this->db->query("select distinct * from akun_pegdep as a where a.id_jabatan = $idjab");
        return $query->result();
    }
    
    private function _isExist($id_jabatan, $id_departemen)
    {
        $query = $this->db->query("select * from jabatanxdep sa");
        $data = $query->result();
        return (count($data)>0) ? true: false ;
    }
}

?>
