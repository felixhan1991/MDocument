<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Status_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='status';
    }
    
    public function getAllStatus()
    {
        $query = "select * from status";
        return $this->_select($query);
    }
    
    
    public function addStatus($nama_status)
    {
        $data['nama_status']=$nama_status;
        if (!$this->_insert($data))
        {    
             return false;
        };
        return true;
    }
    
    public function removeStatus($id)
    {
        if (!$this->_delete(array('id_status' => $id)))
        {
            return 'failed';
        };
        return 'success';
    }
    
    public function editKategori($data, $id)
    {
        if (!$this->_update($data, array('id_status'=>$id)))
        {
            return 'failed';
        }
        return 'success';
    }

    public function checkDoubleName($data) {
        if (!isset($data['id_status']))
        {
            $data['id_status']=0;
        }
        $this->db->select('*');
        $this->db->from($this->get('table'));
        $this->db->where('nama_status', $data['nama_status']);
        $this->db->where('id_status !=', $data['id_status']);
        
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