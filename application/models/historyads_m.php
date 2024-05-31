<?php

class Historyads_m extends MY_Model {
    
    protected $_table_name = 'historyads';
    protected $_order_by = 'id DESC ';
    
    public $rules = array(
        'listing_id' => array('field'=>'listing_id', 'label'=>'lang:Listing id', 'rules'=>'trim'),
        'user_id' => array('field'=>'user_id', 'label'=>'lang:User id', 'rules'=>'trim'),
        'date' => array('field'=>'date', 'label'=>'lang:Date', 'rules'=>'trim'),
        'ip_address' => array('field'=>'ip_address', 'label'=>'lang:Ip address', 'rules'=>'trim'),
    );
    
    public function __construct(){
            parent::__construct();
    }
    
    public function get_new()
	{
        $obj = new stdClass();
        $obj->listing_id = '';
        $obj->date = date('Y-m-d H:i:s');
        $obj->ip_address = $this->input->ip_address();
        return $obj;
    }
    
    public function get($id = NULL, $single = FALSE, $where= array()) {
        return parent::get($id, $single);
    }
    
    public function get_by_check($where, $single = FALSE, $limit = NULL, $order_by = NULL, $offset = "")
    {
        $this->db->select($this->_table_name.'.*, user.id as h_user_id, user.username as h_user_name, ');
        $this->db->from($this->_table_name);
        $this->db->join('user', $this->_table_name.'.user_id = user.id', 'left');
        //$this->db->join('property_lang', $this->_table_name.'.listing_id = property_lang.listing_id', 'left');
              
        if($this->session->userdata('type') != 'ADMIN' && $this->session->userdata('type') != 'AGENT_ADMIN')
        {
            $this->db->where('user.id', $this->session->userdata('id'));
        }
        
        
        $this->db->order_by($this->_order_by);
        
        if($where !== NULL) $this->db->where($where);
        if($order_by !== NULL) $this->db->order_by($order_by);
        if($limit !== NULL) $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        
        //echo $this->db->last_query();

        return $query->result();
    }
    
    public function add_history($listing_id = NULL) {
        $data = $this->get_new();
        $data->listing_id = $listing_id;
        $data->user_id = $this->session->userdata('id');
        $data = (array) $data;
        $this->save($data);
    }
}



