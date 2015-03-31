<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Akun
 *
 * @author Felix Handani
 */
class Akun_m extends MY_Model  {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function addAccount($username)
    {
        $data=array(  
            'user_name' => $username,
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('firstname'),
            'alamat' => $this->input->post('address'),
            'jenis_kelamin' => $this->input->post('gender'),
            'agama' => $this->input->post('religion'),
            'telepon' => $this->input->post('phone'),
            'hp' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        );
        $this->db->insert('akun',$data);
        $lastid = $this->db->insert_id();
        $data2=array(
            'id_jabatan'=>  $this->input->post('jabatan'),
            'id_departemen'=>  $this->input->post('dept'),
            'id_akun'=>  $lastid
        );
        $this->db->insert('penugasan',$data2);
        return true;
    }
    
    public function getPermission_taskman($idakun) {
        $sql = "select ha.nama_hak_akses from
        akun as a, hak_akses as ha, delegasi_akses as da, sim as s
        where a.id_akun = da.id_akun and ha.id_hak_akses = da.id_hak_akses
        and da.id_sim = s.id_sim and a.id_akun = ? and s.id_sim = 4";
        $query= $this->db->query($sql, array($idakun));
//        $query=$this->db->query("select ha.nama_hak_akses from
//        akun as a, hak_akses as ha, delegasi_akses as da, sim as s
//        where a.id_akun = da.id_akun and ha.id_hak_akses = da.id_hak_akses
//        and da.id_sim = s.id_sim and a.id_akun = $idakun and s.id_sim = 4");
        return $query->result();
    }
    
    public function getAllAkuns()
    {
        $query=$this->db->query('SELECT * FROM penugasan inner join akun on akun.id_akun = penugasan.id_akun inner join departemen on departemen.id_departemen = penugasan.id_departemen inner join jabatan on jabatan.id_jabatan = penugasan.id_jabatan where status = 1 order by penugasan.id_akun ASC ');
        return $query->result();
    }   
    
    public function getOnlyAkuns()
    {
        $query=$this->db->query('SELECT * FROM akun order by id_akun ASC');
        return $query->result();
    }
    function login($username,$password)
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('user_name', $username);
        $this->db->where('status', 1);
       // $this->db->where('isLogin',0);
        $this->db->where('password', MD5($password));
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
    
    public function getAkunbyNip($nip)
    {
        $sql = "SELECT * FROM akun WHERE nip=?";
        $query= $this->db->query($sql, array($nip));
//        $query=$this->db->query('SELECT * FROM akun WHERE nip=\''.$nip.'\'');
        return $query->row();
    }
    
    public function getAkunJabDep($id) {
        $sql = "select distinct a.id_akun, a.nama, a.nip, a.nama_jabatan, a.nama_departemen, a.id_jabatan, a.id_departemen from akun_pegdep as a where a.id_akun =?";
        $query= $this->db->query($sql, array($id));
//        $query=$this->db->query("select distinct a.id_akun, a.nama, a.nip, a.nama_jabatan, a.nama_departemen, a.id_jabatan, a.id_departemen from akun_pegdep as a where a.id_akun = $id");
        return $query->result();
    }
    
    public function getAkunbyId($id)
    {
        $sql = "SELECT * FROM akun WHERE id_akun=?";
        $query= $this->db->query($sql, array($id));
        
//        $query=$this->db->query('SELECT * FROM akun WHERE id_akun=\''.$id.'\'');
        return $query->row();
    }
    
    public function getAkunPermission($id_module)
    {
        if ($id_module==null) $id_module=-1;
        $sql = "select ak.* from modules m ,hak_akses a ,aksesxmodule am, akun ak
        where am.id_module = m.id_module and am.id_hak_akses = a.id_hak_akses and ak.id_hak_akses = a.id_hak_akses
	and m.id_module=?";
        $query= $this->db->query($sql, array($id_module));
//        $query = $this->db->query('select ak.* from modules m ,hak_akses a ,aksesxmodule am, akun ak
//where am.id_module = m.id_module and am.id_hak_akses = a.id_hak_akses and ak.id_hak_akses = a.id_hak_akses
//	and m.id_module='.$id_module);
//        
        return $query->result();
    }
    
    public function getAllAkunsNonActive()
    {
        $query=$this->db->query('SELECT * FROM akun where status = 0 order by id_akun ASC ');
        return $query->result();
    }
    
    public function getAkunByDelegation($id)
    {
        $sql = "select a.*
        from simxakses sa, sim s, hak_akses ha, akun a, delegasi_akses da
        where  s.id_sim = sa.id_sim and ha.id_hak_akses = sa.id_hak_akses and
       a.id_akun = da.id_akun and da.id_sim = sa.id_sim and da.id_hak_akses = sa.id_hak_akses 
       and s.id_sim=?";
        $query= $this->db->query($sql, array($id));
//        $query=$this->db->query("select a.*
//from simxakses sa, sim s, hak_akses ha, akun a, delegasi_akses da
//where  s.id_sim = sa.id_sim and ha.id_hak_akses = sa.id_hak_akses and
//       a.id_akun = da.id_akun and da.id_sim = sa.id_sim and da.id_hak_akses = sa.id_hak_akses 
//       and s.id_sim=".$id);
        return $query->result();
    }

    public function editPassword()
    {
        
        
        $data=array(
            'nama' => $this->input->post('firstname')
        );
        if ($this->input->post('password')!=null )
            $data['password'] = md5($this->input->post('password'));
        $this->db->where('id_akun', $this->input->post('id'));
        $this->db->update('akun', $data); 
        return 'success';
    }

    public function editAkun()
    {
         
        $data=array(
            'user_name'=> $this->input->post('user_name'),
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('firstname'),
            'alamat' => $this->input->post('address'),
            'jenis_kelamin' => $this->input->post('gender'),
            'agama' => $this->input->post('religion'),
            'telepon' => $this->input->post('phone'),
            'hp' => $this->input->post('mobile'),
            'email' => $this->input->post('email')
        );
        
        $this->db->where('id_akun', $this->input->post('id'));
        $this->db->update('akun', $data); 
        return 'success';
    }
    
    
    public function setStatus($val, $akun)
    {
        $data=array(
            'status'=>  $val,
        );
        $this->db->where('id_akun',$akun);
        $this->db->update('akun', $data); 
        return 'success';
    }

    public function get_jabatan_departemen_bynip($nip)
    {
        $sql = "select akun.id_akun, akun.nama, j.nama_jabatan, d.id_departemen ,d.nama_departemen
        from akun, penugasan p, jabatanxdep jp, jabatan j, departemen d 
        where akun.nip = ? and akun.id_akun = p.id_akun and p.id_jabatan = jp.id_jabatan and p.id_departemen = jp.id_departemen
        and jp.id_departemen = d.id_departemen and jp.id_jabatan = j.id_jabatan";
        $query= $this->db->query($sql, array($nip));
//        $query=$this->db->query("select akun.id_akun, akun.nama, j.nama_jabatan, d.id_departemen ,d.nama_departemen
//        from akun, penugasan p, jabatanxdep jp, jabatan j, departemen d 
//        where akun.nip = '$nip' and akun.id_akun = p.id_akun and p.id_jabatan = jp.id_jabatan and p.id_departemen = jp.id_departemen
//        and jp.id_departemen = d.id_departemen and jp.id_jabatan = j.id_jabatan");
        return $query->result();
    }
    
    public function get_bawahan($idakun) {
        $newsql = "select a.id_akun, a.nip, a.nama, a.telepon, a.hp, a.email, a.nama_jabatan, a.nama_departemen
        from akun_pegdep as a
        where a.id_parent_jabatan in (select a.id_jabatan from
        akun_pegdep as a
        where a.id_akun = ?)";
        return $this->query($newsql, array($idakun));
    }
    
    public function get_atasan($idakun) {
        $sql = "select a.id_akun, a.nama, a.id_parent_jabatan, jabatan.nama_jabatan as aa from
        akun_pegdep as a
        left join jabatan on (a.id_parent_jabatan=jabatan.id_jabatan)
        where a.id_akun =?";
        $query= $this->db->query($sql, array($idakun));
//        $query = $this->db->query("select a.id_akun, a.nama, a.id_parent_jabatan, jabatan.nama_jabatan as aa from
//        akun_pegdep as a
//        left join jabatan on (a.id_parent_jabatan=jabatan.id_jabatan)
//        where a.id_akun = $idakun");
        return $query->result();
    }
    
    public function checkUserName($str)
    {
        
         $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('user_name', $str);
        $this->db->where('status', 1);
        
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
    
    public function setTimeAccess($id,$value)
    {
//        if ($value==="OFF") $value=0;
//        else
//            if ($value==="ON") $value=1;
//            else return 'failed';
//         
        //echo $value;
        $data=array(
            'isLogin' => date('d-m-Y G:i:s')
        );
        $this->db->where('id_akun', $id);
        $this->db->update('akun', $data); 
        return 'success';
    }
    
    public function removeTimeAccess($id)
    {
        $data=array(
            'isLogin' => null
        );
        $this->db->where('id_akun', $id);
        $this->db->update('akun', $data); 
        return 'success';
    }
    
    public function checkAvailableSess($id,$total)
    {
        
        //UNTUK MYSQL (tanpa ceksession)
         return true;
         //UNTUK POSTGRE
//        $query = $this->db->query("select \"isLogin\" from akun where id_akun=$id");
//        $awal = $query->row()->isLogin;
//        if ($awal==="" || $awal==null ) return true;
//        
//        $query = $this->db->query("select * from akun where id_akun=$id and now() - \"isLogin\"  > interval '".$total." second'");
//        $res=$query->row();
//        if (count($res)<=0)
//        {
//            return false;
//        }
//        else return true;
       
        
    }


}

?>
