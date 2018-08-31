<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class site_model extends CI_Model {
    
    function get_statuses($limit = false, $start = false) {
        if ($start == false) {
            $this->db->limit(10);
        } else {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('statuses');
        return $query->result();
    }
    
    function get_data_statuses() {
        $query = $this->db->get('status');
        return $query->result();
    }
    
    function count_statuses() {
        $this->db->from('statuses');
        return $this->db->count_all_results();
    }
    
    function empty_history() {
        $this->db->empty_table('statuses');
    }
    
    function get_commissions_count() {
        $this->db->where('status !=', '2');
        $this->db->from('commissions');
        return $this->db->count_all_results();
    }
    
    function get_questions_count() {
        $this->db->where('answer', '');
        $this->db->from('questions');
        return $this->db->count_all_results();
    }
    
    function get_emails_count() {
        $this->db->where('status !=', '2');
        $this->db->from('contacts');
        return $this->db->count_all_results();
    }
    
    function get_friends_count() {
        $this->db->where('status !=', '3');
        $this->db->from('friends');
        return $this->db->count_all_results();
    }
    
    function get_data() {
        $query = $this->db->get('site_data');
        return $query->result();
    }
    
    function update_data($title, $description, $description_id, $comm, $comm_id, $tou, $tou_id, $aff, $aff_id, $keywords) {
        $data = array(
            'title' => $title,
            'description' => $description,
            'description_id' => $description_id,
            'comm' => $comm,
            'comm_id' => $comm_id,
            'tou' => $tou,
            'tou_id' => $tou_id,
            'aff' => $aff,
            'aff_id' => $aff_id,
            'keywords' => $keywords
        );
        $this->db->where('id', '1');
        $this->db->update('site_data', $data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated website data'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function get_updates() {
        $this->db->limit(15);
        $this->db->order_by('master_id', 'desc');
        $query = $this->db->get('master');
        return $query->result();
    }
    
    function get_theme($id) {
        $this->db->where('theme_id', $id);
        $query = $this->db->get('theme');
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_post($id) {
        $this->db->where('entry_id', $id);
        $query = $this->db->get('entry');
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_resource($id) {
        $this->db->where('resource_id', $id);
        $query = $this->db->get('resources');
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_album($id) {
        $this->db->where('album_id', $id);
        $query = $this->db->get('photo_album');
        
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    
    function get_design($id) {
        $this->db->where('id', $id);
        
        $query = $this->db->get('design');
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_story($id) {
        $this->db->where('id', $id);
        
        $query = $this->db->get('writing');
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_related_categories($id) {
        $category = array();
        
        $this->db->where('object_id', $id);
        $query = $this->db->get('theme_relationships');
        
        foreach ($query->result() as $row) {
            $this->db->where('category_id', $row->category_id);
            $query    = $this->db->get('theme_category');
            $category = array_merge($category, $query->result());
        }
        
        return $category;
    }
    
    function get_themes_categories() {
        $query = $this->db->get('theme_category');
        return $query->result();
    }
    
    function get_resources_types() {
        $query = $this->db->get('resources_types');
        return $query->result();
    }
}