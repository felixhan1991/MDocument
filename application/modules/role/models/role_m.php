<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Role_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='role';
    }
    
    public function getAllRole()
    {
        $query = "select * from role";
        return $this->_select($query);
    }
    
    
    public function addRole($nama_role)
    {
        $data['nama_role']=$nama_role;
        if (!$this->_insert($data))
        {    
             return false;
        };
        return true;
    }
    
    public function removeRole($id)
    {
        if (!$this->_delete(array('id_role' => $id)))
        {
            return 'failed';
        };
        return 'success';
    }
    
    public function editRole($data, $id)
    {
        if (!$this->_update($data, array('id_role'=>$id)))
        {
            return 'failed';
        }
        return 'success';
    }

    public function checkDoubleName($data) {
        if (!isset($data['id_role']))
        {
            $data['id_role']=0;
        }
        $this->db->select('*');
        $this->db->from($this->get('table'));
        $this->db->where('nama_role', $data['nama_role']);
        $this->db->where('id_role !=', $data['id_role']);
        
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