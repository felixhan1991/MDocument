<?php

/**
     *Initialize the pagination rules for cities page 
     * @return Pagination
     */
class paginationlib {
    //put your code here
    
    function __construct() {
         $this->ci =& get_instance();
    }
    private $config=array();
 
    public function initPagination($base_url,$total_rows){
        $this->config['per_page']          = 5;
        $this->config['uri_segment']       = 3;
        $this->config['base_url']          = base_url().$base_url;
        $this->config['total_rows']=$total_rows;
        $this->config['use_page_numbers']  = TRUE;
        
        $this->config['first_tag_open'] = $this->config['last_tag_open']= $this->config['next_tag_open']= $this->config['prev_tag_open'] = $this->config['num_tag_open'] = '';
        $this->config['first_tag_close'] = $this->config['last_tag_close']= $this->config['next_tag_close']= $this->config['prev_tag_close'] = $this->config['num_tag_close'] = '';        
        $this->config['cur_tag_open'] = "";
        
        $this->ci->pagination->initialize($this->config);
        return $this->config;    
    }
    
}
?>