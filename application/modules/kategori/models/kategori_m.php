<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Kategori_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='kategori';
    }
    
    public function getAllKategori()
    {
        $query = "select * from kategori";
        return $this->_select($query);
    }
    
    public function getParentKategoriTree()
    {
        $query="select data.*,k.nama_kategori from 
(select k.id_kategori from kategori k where k.id_kategori NOT IN( select ck.child_kategori from childkategori ck )) data,kategori k where data.id_kategori=k.id_kategori order by k.nama_kategori";
        return $this->_select($query);
    }
    
    public function getKategoribyId($id)
    {
        $query="select * from kategori where id_kategori=".$id;
        $res= $this->_select($query);
        return $res[0];
    }
    
    
    public function addKategori($nama_kategori,$parent_id=null)
    {
        $data['nama_kategori']=$nama_kategori;
        if (!$this->_insert($data))
        {    
             return false;
        };
        $res=$this->_select("select * from kategori where nama_kategori='$nama_kategori'");
        $idNow = $res[0]->id_kategori;
        if ($parent_id!=null)
        {
            $this->db->insert('childkategori',array('parent_kategori'=>$parent_id,'child_kategori'=>$idNow));
        }
        return true;
    }
    
    public function removeKategori($id)
    {
        if (!$this->_delete(array('id_kategori' => $id)))
        {
            return 'failed';
        };
        return 'success';
    }
    
    public function getChild($id)
    {
        $query = "select child_kategori as id_kategori,k.nama_kategori from childkategori ck, kategori k where ck.parent_kategori=? and k.id_kategori = ck.child_kategori";
        $res = $this->_select($query, array($id));
        
        return $res;
    }
    
    public function getParent($id)
    {
        $query = "select parent_kategori as id_kategori,k.nama_kategori from childkategori ck, kategori k where ck.child_kategori=? and k.id_kategori = ck.child_kategori";
        $res = $this->_select($query, array($id));
        
        return $res;
    }
    
    public function editKategori($data, $id)
    {
        if (!$this->_update($data, array('id_kategori'=>$id)))
        {
            return 'failed';
        }
        return 'success';
    }

    public function checkDoubleName($data) {
        if (!isset($data['id_kategori']))
        {
            $data['id_kategori']=0;
        }
        $this->db->select('*');
        $this->db->from($this->get('table'));
        $this->db->where('nama_kategori', $data['nama_kategori']);
        $this->db->where('id_kategori !=', $data['id_kategori']);
        
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