<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



class Report_m extends MY_Model {
    
    public function __construct() {
        parent::__construct();
        $this->table='dokumen';
        
    }
    
    public function getListPengaduan($time_start,$time_end,$id_status,$id_departemen,$id_kategori)
    {

        $stats=array();
        $depts=array();
        $kats=array();
        $tanggal='';
        $where='';
        
        if (trim($time_start) !=='')
            $tanggal='tanggal_dokumen >= \''.$time_start.'\' AND tanggal_dokumen <= \''.$time_end.'\' ';
        if ($id_status)
            foreach ($id_status as $st)
                array_push($stats,"s.id_status=".$st);
        if ($id_departemen)
            foreach ($id_departemen as $dep)
                array_push($depts,"dd.id_departemen=".$dep);
        if ($id_kategori)
            foreach ($id_kategori as $kat)
                array_push($kats,"mk.id_kategori=".$kat);
        
        
        
        if(empty($id_status))
        {
            if (empty($id_departemen))
            {
                if (empty($id_kategori))
                {
                    $where.=$tanggal;
                }
                else {
                    for($i=0; $i<count($kats); $i++)
                    {
                        $where.=' ( '. $tanggal. ' AND '.$kats[$i]. ' )';
                        if ($i < count($kats)-1) $where.=' OR ';
                    }
                }
            }
            else {
                if (empty($id_kategori))
                {
                    for($i=0; i<count($depts); $i++)
                    {
                        $where.=' ( '. $tanggal. ' AND '.$depts[$i]. ' )';
                        if ($i < count($depts)-1) $where.=' OR ';
                    }
                }
                else {
                    for($i=0; $i<count($kats); $i++)
                    {
                        for ($j=0; $j<count($depts); $j++)
                        {
                            $where.=' ( '. $tanggal. ' AND '.$kats[$i]. 'AND'. $depts[$j].')';
                            if (($i+1)*($j+1) < count($kats)*count($depts)) $where.=' OR ';
                        }
                    }
                }
            }
        }
        else {
            if (empty($id_departemen))
            {
                if (empty($id_kategori))
                {
                    for($i=0; $i<count($stats); $i++)
                    {
                        $where.=' ( '. $tanggal. ' AND '.$stats[$i]. ' )';
                        if ($i < count($stats)-1) $where.=' OR ';
                    }
                }
                else {
                    for($i=0; $i<count($kats); $i++)
                    {
                        for ($j=0; $j<count($stats); $j++)
                        {
                            $where.=' ( '. $tanggal. ' AND '.$kats[$i]. ' AND '. $stats[$j].')';
                            if (($i+1)*($j+1) < count($kats)*count($stats)) $where.=' OR ';
                        }
                        
                    }
                }
            }
            else {
                if (empty($id_kategori))
                {
                    for($i=0; $i<count($depts); $i++)
                    {
                        for ($j=0; $j<count($stats); $j++)
                        {
                            $where.=' ( '. $tanggal. ' AND '.$depts[$i]. ' AND '. $stats[$j].')';
                            if (($i+1)*($j+1) < count($depts)*count($stats)) $where.=' OR ';
                        }
                    }
                }
                else {
                    for($i=0; $i<count($depts); $i++)
                    {
                        for ($j=0; $j<count($stats); $j++)
                        {
                            for ($k=0; $k<count($kats); $k++)
                            {
                                $where.=' ( '. $tanggal. ' AND '.$depts[$i]. ' AND '. $stats[$j]. ' AND '. $kats[$k].')';
                                if (($i+1)*($j+1)*($k+1) < count($depts)*count($stats)*count($kats)) $where.=' OR ';
                            }
                        }
                    }
                    
                }
            }
        }
        
        

        $sql=('SELECT * , getDepartemen(d.id_dokumen)
                                 FROM dokumen d
                                 LEFT JOIN status s ON (d.id_status = s.id_status)
                                 LEFT JOIN mapKategori mk ON (mk.id_dokumen = d.id_dokumen)
                                 WHERE '.$where .'
                                 ORDER BY tanggal_dokumen ASC');
        $query=$this->db->query($sql);//,array($time_start,$time_end,$dept,$stat));

        return $query->result();
        
    }
    
    public function getDocumentYears()
    {
        $query = $this->_select('SELECT extract(year from tanggal_dokumen) as parameter_dokumen FROM dokumen GROUP BY parameter_dokumen');
        return $query;
    }
    
    public function getDocumentMonths()
    {
        $query = $this->_select('SELECT to_char(tanggal_dokumen,\'Monthyyyy\') as parameter_dokumen FROM dokumen GROUP BY extract(month from tanggal_dokumen),extract(year from tanggal_dokumen),parameter_dokumen ORDER BY extract(year from tanggal_dokumen),extract(month from tanggal_dokumen)');
        return $query;
    }
    
    public function getDocumentPerYear($start,$end)
    {
        $query=$this->_select('select extract(year from tanggal_dokumen) as parameter_dokumen, count(*) as jumlah from dokumen
            WHERE extract(year from tanggal_dokumen) >= ? AND extract(year from tanggal_dokumen) <= ?
            group by parameter_dokumen order by parameter_dokumen',array($start,$end));
        return $query;
    }
    
    public function getDocumentPerMonth($start,$end)
    {
        $s = '01-'.substr($start,0,-4).'-'.substr($start, -4);
        $query=$this->_select('select bulan.*,coalesce(jumlah.jum,0) as jumlah from   
            (SELECT to_char(tanggal_dokumen,\'Monthyyyy\') as parameter_dokumen, count(*) jum FROM dokumen 
            WHERE tanggal_dokumen >= to_timestamp(concat(\'01 \',left(?,3),\' \',right(?,4)),\'DD Mon YYYY\') 
            AND tanggal_dokumen <= to_timestamp(concat(\'31 \',left(?,3),\' \',right(?,4)),\'DD Mon YYYY\') 
            GROUP BY extract(month from tanggal_dokumen),extract(year from tanggal_dokumen),parameter_dokumen ORDER BY extract(year from tanggal_dokumen),extract(month from tanggal_dokumen) ) jumlah   
            right outer join  (select to_char(t.data,\'Monthyyyy\')as parameter_dokumen 
            FROM (	select date ? + (interval \'1\' month * generate_series(0,11)) as data)t  )bulan on jumlah.parameter_dokumen = bulan.parameter_dokumen',array($start,$end,$start,$end,$s));
        //print_r($query);
        return $query;
    }   
    
    public function getDocumentPerDay($start,$end)
    {
        $sql=('select coalesce(data1.jum,0) as jumlah,data2.* from (
	SELECT to_char(tanggal_dokumen,\'dd Mon yyyy\') as data, count(*) jum FROM dokumen d 
	WHERE tanggal_dokumen >= ? AND tanggal_dokumen <= ?  
	GROUP BY data ORDER BY data ASC ) data1
	right outer join
	(
	select to_char(t.data,\'dd-Month-yyyy\') as parameter_dokumen from (select date ? + (interval \'1\' day* generate_series(0,30) - interval \'1\' day) as data ) t
	) data2
	on data1.data = data2.parameter_dokumen');
        $query=$this->db->query($sql,array($start,$end,$start,$start));
        return $query->result();
    }
    
    public function getDocumentPerKategori()
    {
        $sql='select table1.nama_kategori as parameter_dokumen,coalesce(table2.jumlah,0) as jumlah from (select * from kategori) table1
left outer join 
( select k.*,count(*) as jumlah  from dokumen d, mapkategori mk, kategori k where d.id_dokumen = mk.id_dokumen and k.id_kategori = mk.id_kategori group by k.id_kategori ) table2
on table1.id_kategori =table2.id_kategori
order by table1.id_kategori';
        $query=$this->_select($sql);
        return $query;
    }
    
    public function getDocumentPerStatus() {
        $sql='select table1.nama_status as parameter_dokumen,coalesce(table2.jumlah,0) as jumlah from (select * from status) table1
left outer join 
( select s.* ,count(*) as jumlah from dokumen d, status s where s.id_status=d.id_status group by s.id_status ) table2
on table1.id_status =table2.id_status
order by table1.id_status';
        $query=$this->_select($sql);
        return $query;
    }
    
    public function getDocumentDepartemen()
    {
        $sql='select  md.id_departemen as parameter_dokumen, count(*) as jumlah from dokumen d, dokumenxdepart md where d.id_dokumen= md.id_dokumen group by md.id_departemen order by md.id_departemen';
        $query=$this->_select($sql);
        return $query;
    }
    
    
    
    
    
    
}