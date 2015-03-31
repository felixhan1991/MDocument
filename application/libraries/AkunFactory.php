<?php
/**
 * Singleton class
 *
 */
final class AkunFactory extends MX_Controller
{
    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new AkunFactory();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
    public function __construct()
    {
    }
    
    public function getNameAkun($id)
    {
        if ($id==null || $id==="") return '';
        $word= $this->logging_m->getAkunbyId($id)->nama;
        return $word;
    }
    
    public function getNameDepartemen($id)
    {
        $word="";
        if ($id==null || $id==="") return '';
        $ws=explode(",",$id);
        foreach ($ws as $w)
        {
            $word.= $this->logging_m->getDepartbyId($w)->nama_departemen;
            $word.=', ';
        }
        
        return $word;
    }
    public function getNameKategori($id)
    {
        $word="";
        if ($id==null || $id==="") return '';
        $ws=explode(",",$id);
        foreach ($ws as $w)
        {
            $word.= $this->kategori_m->getKategoribyId($w)->nama_kategori;
            $word.=', ';
        }
        
        return $word;
    }
    
   
    
}

?>