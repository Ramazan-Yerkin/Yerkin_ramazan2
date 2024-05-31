<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Promocode extends Admin_Controller
{
    
	public function __construct(){
		parent::__construct();
        
        $this->load->model('estate_m');
        $this->load->model('promocode_m');
        $this->data['content_language_id'] = $this->language_m->get_content_lang();
	}
    
    
    /*
     * page Index
     * 
     */
    public function index () {
        
        prepare_search_query_GET(array(), array('id', 'code_name'));
        
        /* data */
        $this->data['all_promocodes']=$this->promocode_m->get();
        /* end data */
        
        // Load view
        $this->data['subview'] = 'admin/promocode/index';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    /*
     * page Edit promocodee
     * 
     */
    public function edit ($id=null) {
        if(!empty($id)) {
        /* data */
        $this->data['promocode'] = $this->promocode_m->get(trim($id));
        $this->data['promocode']->packages = explode(',',$this->data['promocode']->packages);
        /* end data */
        } else {
            /* error */
            /* data */
            $this->data['promocode'] = $this->promocode_m->get_new();
            $id=null;
            /* end data */
        }
        
        // Set up the form
        // rules
        $rules = $this->promocode_m->rules;
        $this->form_validation->set_rules($rules);
        
        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            if($this->config->item('app_type') == 'demo')
            {
                $this->session->set_flashdata('error', 
                        lang('Data editing disabled in demo'));
                redirect('admin/enquire/edit/'.$id);
                exit();
            }
            
            $data = $this->promocode_m->array_from_rules($rules);
            
            if(!empty($data['packages'])) {
                $data['packages'] = implode(',',$data['packages']);
            }
            
            if(is_null($id)) {
                $data['date_created'] = date('Y-m-d H:i:s');
            }
            
            $insert_id='';
            $insert_id=$this->promocode_m->save($data, $id);
            
            if(empty($insert_id))
            {
                echo '$insert_id is empty, ERROR IN QUERY: <br />';
                echo $this->db->last_query().'<br />';
                echo $this->db->_error_message();
                exit();
            }
            
            if(!empty($insert_id)) {
                $this->session->set_flashdata('message', 
                        '<p class="label label-success validation">'.lang_check('Changes saved').'</p>');

                redirect('admin/promocode/edit/'.$insert_id);
            }
            
        } else {
            if(isset($_POST['packages']) && !empty($_POST['packages'])) {
                $this->data['promocode']->packages = $_POST['packages'];
            }
        }
        
        // Load view
        $this->data['subview'] = 'admin/promocode/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function delete($id=null)
	{
        if(empty($id)) {
            $this->session->set_flashdata('error', 
                    lang_check('Id is empty'));
            redirect('admin/promocode');
            exit();
        }
        
        if($this->config->item('app_type') == 'demo')
        {
            $this->session->set_flashdata('error', 
                    lang('Data editing disabled in demo'));
            redirect('admin/promocode');
            exit();
        }
       
        $this->data['enquire'] = $this->promocode_m->get($id);
        
        //Check if user have permissions
        if($this->session->userdata('type') != 'ADMIN')
        {
                redirect('admin/promocode');
        }
       
        $this->promocode_m->delete($id);
        redirect('admin/promocode');
	}
    
        
    public function _check_date($str)
    {   
        $date_from = $this->input->post('date_start');
        $date_to = $this->input->post('date_end');
  
        // check 'from' before 'to', 'from' after 'now'
        if(/*strtotime($date_from) < time() ||*/ strtotime($date_to) < strtotime($date_from))
        {
            $this->form_validation->set_message('_check_date', lang_check('Please correct dates start/end'));
            return FALSE;
        }

        return TRUE;
    }
        
    public function _check_unique_code($str)
    {   
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current page
        
        $id = $this->uri->segment(4);
        $this->db->where('promocode', $this->input->post('promocode'));
        !$id || $this->db->where('id !=', $id);
        $id = $this->promocode_m->get();
        
        if(sw_count($id))
        {
            $this->form_validation->set_message('_check_unique_code', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
}