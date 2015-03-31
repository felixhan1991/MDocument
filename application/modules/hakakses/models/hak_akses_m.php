<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Hak_akses_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    
     /**
     * Section Hak Akses
     */
        public function getAllAkses($id_sim)
    {
        $akses = json_decode(
            file_get_contents(UrlFactory::Instance()->getProtocol().'hello:world@'.
                    UrlFactory::Instance()->getHostName().'/integrarsud/index.php/api/integration/hakakses/id/'.$id_sim.'/format/json')
        );

        return $akses;
    }
    public function getAksesName($id_sim, $id_hak_akses)
    {
        $akses = json_decode(
            file_get_contents(UrlFactory::Instance()->getProtocol().'hello:world@'.
                    UrlFactory::Instance()->getHostName().'/integrarsud/index.php/api/integration/hakakses/id/'.$id_sim.'/format/json')
        );

        return $akses[$id_hak_akses]->nama_hak_akses;
    }
    
    public function getAksesbyId($id_sim,$id_hak_akses)
    {
        $akses = json_decode(
            file_get_contents(UrlFactory::Instance()->getProtocol().'hello:world@'.
                    UrlFactory::Instance()->getHostName().'/integrarsud/index.php/api/integration/hakakses/id/'.$id_sim.'/format/json')
        );
        foreach ($akses as $ak)
        {
            if ($ak->id_hak_akses==$id_hak_akses) 
            {
                return $ak;
            }
        }
        return null;
        
    }
    
  
    
    public function editDetAkses($id_akses,$modules)
    {
        $this->db->delete('aksesxmodule', array('id_hak_akses'=> $id_akses)); 
          //input semua modulexakses
            foreach ($modules as $m)
            {
                $data=array(
                  'id_hak_akses' => $id_akses,
                  'id_module' => $m
                );
                $this->db->insert('aksesxmodule',$data);
            }
            
        return true;
            
    }
    public function getModules($id)
    {
        $sql=('SELECT id_module FROM aksesxmodule where id_hak_akses = ? order by id_hak_akses ASC');
        $query=$this->db->query($sql, array($id));
        return $query->result();
    }
    
    public function checkDoubleName($data) {
    
    }
    
    
    
}