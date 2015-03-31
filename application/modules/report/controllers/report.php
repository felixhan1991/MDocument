<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Admin_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file','pdf'));
            $this->load->model(array('documents/document_m','documents/logging_m',
                'documents/enroll_m','file/file_m','documents/mapk_m',
                'status/status_m','kategori/kategori_m', 'job/review_m','report_m'));
        }
        
        
        
	public function index()
	{
            $this->title="Report";
            $data['state']='report';
            $data['sub_state'] = 'List';
            $start=$this->input->post('start');
            $end=$this->input->post('end');
            
            $id_statuses=$this->input->post('statuses');
            $id_departemen=$this->input->post('departemens');
            $id_kategoris = $this->input->post('cats');
            $data['errormess']='';
            $data['results']=array();
            $data['ket']='';
            
            //field
            $data['stats'] = $this->status_m->getAllStatus();
            $data['depts'] = $this->document_m->getAllDepartemens();
            $data['kategoris'] = $this->kategori_m->getAllKategori();
            
            $data['time_start'] = '';
            $data['time_end'] = '';
            $data['url'] = '';
            if(strtotime($start)>strtotime($end))
            {
                
                $data['errormess'] = 'Waktu awal tidak boleh lebih besar dari waktu akhir';
            }
            else{
                
                if(trim($start) !==''){
                    
                    $res = $this->report_m->getListPengaduan($start,$end,$id_statuses,$id_departemen,$id_kategoris);
                    if ($res) 
                    {
                        foreach($res as $name_dept)
                        {
                            if ($name_dept->getdepartemen){
                                $arr=  explode(',', $name_dept->getdepartemen);
                                foreach ($arr as $dep)
                                {
                                    $name_dept->nama_departemen[]=AkunFactory::Instance()->getNameDepartemen($dep);
                                }
                            }
                            else $name_dept->nama_departemen=array();
                        }
                        $data['results'] = $res;
                    }
                }
                
                $data['ket'] = 'Tanggal '.$start.' - '.$end;
            
            $data['id_time'] = 3;
            $data['time_start'] = $start;
            $data['time_end'] = $end;
            $data['url'] = '6&val1='.$start.'&val2='.$end;
            
            $this->session->set_flashdata('statuses',$id_statuses);
            $this->session->set_flashdata('dept',$id_departemen);
            $this->session->set_flashdata('kategoris',$id_kategoris);
            }
            
            $this->display('main',$data);
	}
        
        function time()
        {
            $this->title="Report";
            $data['state']='report';
            $data['sub_state'] = 'Waktu';
            $data['ops']=$this->input->post('time');
            $data['start']=$this->input->post('start');
            $data['end']=$this->input->post('end');
            
            
            $data['errormess']='';
            $data['results']=array();
            $data['ket']='';
            $data['years']=$this->report_m->getDocumentYears();
            $data['months'] = $this->report_m->getDocumentMonths();
            $data['id_time'] = 0;
            $data['time_start'] = '';
            $data['time_end'] = '';
            $data['url'] = '';
            if(strtotime($data['start'])>strtotime($data['end']))
                $data['errormess'] = 'Waktu awal tidak boleh lebih besar dari waktu akhir';
            else{
                $data = $this->_generateReport($data);
            }
            $data['id_time'] = $data['ops'];
            $data['time_start'] = $data['start'];
            $data['time_end'] = $data['end'];
            $data['url'] = $data['ops'].'&val1='.$data['start'].'&val2='.$data['end'];
            $this->display('main',$data);
       }
       
       public function status()
        {
            $this->title="Report";
            $data['state']='report';
            $data['sub_state'] = 'Status';
            $data['results']=array();
            $data['stats']=$this->status_m->getAllStatus();
            
            $data['results'] = $this->report_m->getDocumentPerStatus();
            $data['id_time']='1';
            $data['url'] = '4';
            $this->display('main',$data);
        }
        
        public function departemen()
        {
            $this->title="Report";
            $data['state']='report';
            
            $data['sub_state'] = 'Departemen';
            $data['results']=array();
            $data['stats']=$this->report_m->getAllDepartemens();
            $res = $this->report_m->getDocumentDepartemen();
            
            $data['results'] = $res;
            $data['id_time']='1';
            $data['url'] = '5';
            $this->display('main',$data);
        }
            
        public function kategori()
        {
            $this->load->model(array('kategori_m'));
            $this->title="Report";
            $data['state']='report';
            
            $data['sub_state'] = 'kategori';
            $data['results']=array();
            $data['stats']=$this->kategori_m->getAllKategori();
            
            $data['results'] = $this->report_m->getDocumentPerKategori();
            $data['id_time']='1';
            $data['url'] = '7';
            $this->display('main',$data);
        }
        
        private function _generateReport($data)
        {
            $ops=$data['ops'];
            $start = $data['start'];
            $end=$data['end'];
            $data['state']='report';
            if($ops == 1){
                $data['results'] = $this->report_m->getDocumentPerYear($start,$end);
                $data['ket'] = 'Tahun '.$start.' - '.$end;
                $data['filename']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end).'.pdf';
                $data['filename_xls']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end);
            }
            else if($ops == 2){
                $data['results'] = $this->report_m->getDocumentPerMonth($start,$end);
                $data['ket'] = 'Bulan '.$start.' - '.$end;
                $data['filename']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end).'.pdf';
                $data['filename_xls']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end);
            }
            else if($ops == 3){
                $data['results'] = $this->report_m->getDocumentPerDay($start,$end);
                $data['ket'] = 'Tanggal '.$start.' - '.$end;
                $data['filename']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end).'.pdf';
                $data['filename_xls']='report'.str_replace(' ','', $start).'-'.str_replace(' ', '', $end);
            }
            else if($ops == 4){
                $data['results'] = $this->report_m->getDocumentPerStatus();
                $data['ket'] = 'Per Status';
                $data['filename']='report_status.pdf';
                $data['filename_xls']='report_status';
            }
            else if($ops == 5){
                $res = $this->report_m->getDocumentDepartemen();
                $data['state'] = 'departemen';
                $data['results'] = $res;
               
                $data['ket'] = 'Per Departemen';
                $data['filename']='report_departemen.pdf';
                $data['filename_xls']='report_departemen';
            }
            else if($ops == 6){
                
                $data['state'] = 'List';
                
                $id_statuses=$this->session->flashdata('statuses');
                $id_departemen= $this->session->flashdata('dept');
		$id_kategoris=$this->session->flashdata('kategoris');
                $this->session->set_flashdata('statuses',$id_statuses);
                $this->session->set_flashdata('dept',$id_departemen);
		$this->session->set_flashdata('kategoris',$id_kategoris);
                $res= $this->report_m->getListPengaduan($start,$end,$id_statuses,$id_departemen,$id_kategoris);
                $data['ket']='tanggal '.$start.' - '.$end;
               
                if ($res) 
                {
                    foreach($res as $name_dept)
                    {
                        if ($name_dept->getdepartemen){
                            $arr=  explode(',', $name_dept->getdepartemen);
                            foreach ($arr as $dep)
                            {
                                $name_dept->nama_departemen[]=AkunFactory::Instance()->getNameDepartemen($dep);
                            }
                        }
                        else $name_dept->nama_departemen=array();
                    }
                    $data['results'] = $res;
                }
                    
                $data['ket'] = '';
                $data['filename']='Report_Dokumen.pdf';
                $data['filename_xls']='report_pengaduan';
            }
            else if($ops == 7){
                $data['results'] = $this->report_m->getDocumentPerKategori();
                $data['ket'] = 'Per Kategori';
                $data['filename']='report_kategori.pdf';
                $data['filename_xls']='report_kategori';
            }
            return $data;
        }
        
        function viewReport()
        {
            $data['ops']=$this->input->get('id');
            $data['start']=$this->input->get('val1');
            $data['end']=$this->input->get('val2');
            $this->title="Report";
            
            $data = $this->_generateReport($data);
            
            $data['logo'] = '';//$this->setting_m->getSetting('logo');
            $data['id_time'] = $data['ops'];
            $data['time_start'] = $data['start'];
            $data['time_end'] = $data['end'];
            unset($this->theme_partial);
            unset($this->theme_layout);
            $this->theme_layout='template_view_report';
            $this->theme_partial = array(
                 array('name'=>'script-footer', 'value' => 'script-footer-report'),
                 array('name'=>'script-header', 'value' => 'script-header-report')
            );
            $this->display('report_view',$data);
        }
        
        function exportToPDF()
        {
            $data['ops']=$this->input->get('id');
            $data['start']=$this->input->get('val1');
            $data['end']=$this->input->get('val2');
            $this->title="Report";
            $data['state']='report';
            
            $data = $this->_generateReport($data);
            $data['logo'] = '';
            unset($this->theme_partial);
            unset($this->theme_layout);
            $this->theme_layout='template_report';
            $this->theme_partial=array();
            $html=$this->display('report_print',$data);
            //echo generate_pdf($html,'test');
            header("Content-type:application/pdf");
            // It will be called downloaded.pdf
            header("Content-Disposition:attachment;filename=".$data['filename']);
            echo generate_pdf($html,$data['filename'],false);
        }
        
         function exportToExcel()
         {
            $this->title="Report";
            $data['state']='report';
            
            $data['ops']=$this->input->get('id');
            $data['start']=$this->input->get('val1');
            $data['end']=$this->input->get('val2');
            
            $data = $this->_generateReport($data);
            
            $stringData='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <!--[if gte mso 9]>
                    <xml>
                        <x:ExcelWorkbook>
                            <x:ExcelWorksheets>
                                <x:ExcelWorksheet>
                                    <x:Name>Data Dokumen</x:Name>
                                    <x:WorksheetOptions>
                                        <x:Print>
                                            <x:ValidPrinterInfo/>
                                        </x:Print>
                                    </x:WorksheetOptions>
                                </x:ExcelWorksheet>
                            </x:ExcelWorksheets>
                        </x:ExcelWorkbook>
                    </xml>
                    <![endif]-->
                </head>

                <body>
                <table style="table-layout: fixed; width: 100%;">
                <tr colspan="2">
                    <td colspan="5" style="text-align:center; font-size:large; word-wrap:break-word;">
                Data Dokumen '.$data['ket'].'
                    <td>
                    </tr>
                    <tr><td colspan="3">Tanggal Cetak: '. date('d/m/Y H:i:s').'</td></tr>
                    <tr></tr>
                    </table>';
            if($data['ops']==6){
                $stringData.='<table border="1">
                    
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>    
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Departemen</th>
                                </tr>';
                                foreach($data['results'] as $res){
                                $stringData.='<tr>
                                    <td>'.utf8_decode($res->no_serial).'</td>
                                    <td>'.utf8_decode($res->nama_dokumen).'</td>
                                    <td>'.utf8_decode($res->tanggal_dokumen).'</td>
                                    <td>'.utf8_decode($res->nama_status).'</td>';
                                $stringData.='<td>';
                                foreach ($res->nama_departemen as $dep)
                                {
                                    $stringData.=$dep.', ';
                                }
                                $stringData.='</td>';
                                $stringData.='</tr>';
                                }
            }
            else{
                $stringData.='<table border="1">
                
                                <tr>
                                    <th></th>
                                    <th>Jumlah Dokumen</th>
                                </tr>';
                                foreach($data['results'] as $res){
                                $stringData.='<tr>
                                    <td>'.utf8_decode($res->parameter_dokumen).'</td>
                                    <td>'.utf8_decode($res->jumlah).'</td>
                                </tr>';
                                }
            }
            $stringData.='</table></body></html>';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$data['filename_xls'].'.xls');
 
        echo $stringData;
        }
        
     
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */