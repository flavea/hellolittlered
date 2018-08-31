<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class store_model extends CI_Model {
    
    function get_designs() {
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get('design');
        return $query->result();
    }
    
    function get_all_designs($limit, $start) {
        $this->db->limit($limit, $start);
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get('design');
        return $query->result();
    }
    
    
    function get_design($id) {
        $this->db->where('id', $id);
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        
        $query = $this->db->get('design');
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function total_count() {
        
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $this->db->from('design');
        return $this->db->count_all_results();
    }
    
    function total_all_count() {
        $this->db->from('entry');
        $this->db->where('status !=', '4');
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        return $this->db->count_all_results();
    }
    
    function add_new_design($name, $image, $redbubble, $tees, $status, $tweet) {
        $data = array(
            'name' => $name,
            'image' => $image,
            'redbubble' => $redbubble,
            'tees' => $tees,
            'status' => $status
        );
        $this->db->insert('design', $data);
        
        $query     = $this->db->query('select id from design order by id DESC limit 1');
        $object_id = max($query->result());
        $id        = $object_id->id;
        
        $master_data = array(
            'object_id' => $id,
            'object_type' => 'store'
        );
        $this->db->insert('master', $master_data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Added a new store item: "' . $name . '" check it out here ' . base_url() . 'shop/'
        );
        $this->db->insert('statuses', $status_data);
        
        if ($status == 3 && $tweet == 1) {
            $this->load->model('social_model');
            $this->social_model->post_tweet($status_data['status']);
        }
    }
    
    function delete_design($id) {
        
        $data = array(
            'status' => '4'
        );
        $this->db->where('id', $id);
        $this->db->update('design', $data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Deleted a design'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function update_design($id, $name, $image, $redbubble, $tees, $status, $tweet) {
        $data = array(
            'name' => $name,
            'image' => $image,
            'redbubble' => $redbubble,
            'tees' => $tees,
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('design', $data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a store item: "' . $name . '" check it out here ' . base_url() . 'shop/'
        );
        $this->db->insert('statuses', $status_data);
        
        if ($status == 3 && $tweet == 1) {
            $this->load->model('social_model');
            $this->social_model->post_tweet($status_data['status']);
        }
    }
    
}