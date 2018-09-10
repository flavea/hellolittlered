<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class themes_model extends CI_Model {
    
    function get_themes() {
        $this->db->limit($limit, $start);
        
        if (!$this->ion_auth->logged_in())
            $this->db->where('status', '3');
        else
            $this->db->where('status', '3')->or_where('status', '2');
        
        $this->db->order_by('theme_id', 'desc');
        $query = $this->db->get('theme');
        return $query->result();
    }
    
    function get_themes_simplified($limit, $start) {
        $this->db->limit($limit, $start);
        
        $this->db->select('theme_id, theme_name, theme_image, theme_code, theme_preview');
        $this->db->from('theme');
        
        if (!$this->ion_auth->logged_in())
            $this->db->where('status', '3');
        else
            $this->db->where('status', '3')->or_where('status', '2');
        
        $this->db->order_by('theme_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function total_count() {
        if (!$this->ion_auth->logged_in())
            $this->db->where('status', '3');
        else
            $this->db->where('status', '3')->or_where('status', '2');
        
        $this->db->from('theme');
        return $this->db->count_all_results();
    }
    
    function add_new_theme($author, $name, $image, $preview, $code, $body, $body_id, $categories, $status, $tweet) {
        
        $this->load->helper('file');
        $data = array(
            'author_id' => $author,
            'theme_name' => $name,
            'theme_image' => $image,
            'theme_preview' => "",
            'theme_code' => $code,
            'theme_body' => $body,
            'theme_body_id' => $body_id,
            'status' => $status
        );
        $this->db->insert('theme', $data);
        
        $query     = $this->db->query('select theme_id from theme order by theme_date DESC limit 1');
        $object_id = max($query->result());
        $id        = $object_id->theme_id;
        
        $master_data = array(
            'object_id' => $id,
            'object_type' => 'theme'
        );
        $this->db->insert('master', $master_data);
        
        $my_file = $id . '.html';
        $data    = 'Some file data';
        write_file(FCPATH . 'preview/' . $my_file, $preview);
        
        $data = array(
            'theme_preview' => $my_file
        );
        $this->db->where('theme_id', $id);
        $this->db->update('theme', $data);
        
        $status_data = array(
            'author_id' => $author,
            'status' => 'Added a new theme: "' . $name . '" check it out here ' . base_url() . 'theme/' . $id
        );
        $this->db->insert('statuses', $status_data);
        
        
        foreach ($categories as $category) {
            $relationship = array(
                'object_id' => $id,
                'category_id' => $category
            );
            $this->db->insert('theme_relationships', $relationship);
        }
        
        if ($status == 3 && $tweet == 1) {
            $this->load->model('social_model');
            $this->social_model->post_tweet($status_data['status']);
        }
    }
    
    function get_theme($id) {
        $this->db->select('*');
        $this->db->from('theme');
        $this->db->join('status', 'theme.status = status.id and theme.status != "4"');
        $this->db->where('theme_id', $id);
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get();
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_theme_short($id) {
        $this->db->select('status, theme_name, theme_image, substring(theme_body, 0, 200) as theme_body, substring(theme_body_id, 0, 200) as theme_body_id');
        $this->db->from('theme');
        $this->db->join('status', 'theme.status = status.id and theme.status != "4"');
        $this->db->where('theme_id', $id);
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get();
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_preview_code($id) {
        $this->db->select('theme_preview');
        $this->db->from('theme');
        $this->db->where('theme_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() !== 0) {
            foreach ($query->result() as $row) {
                $a = read_file(FCPATH . 'preview/' . $row->theme_preview);
                return $a;
            }
        } else
            return FALSE;
    }
    
    function add_new_category($name, $slug) {
        $i          = 0;
        $slug_taken = FALSE;
        
        while ($slug_taken == FALSE) {
            $category = $this->get_category(NULL, $slug);
            if ($category == FALSE) {
                $slug_taken = TRUE;
                $data       = array(
                    'category_name' => $name,
                    'slug' => $slug
                );
                $this->db->insert('theme_category', $data);
                $status_data = array(
                    'author_id' => 1,
                    'status' => 'Added a new theme category: "' . $name
                );
                $this->db->insert('statuses', $status_data);
            }
            $i    = $i + 1;
            $slug = $slug . '-' . $i;
        }
    }
    
    function update_category($id, $name, $slug) {
        $data = array(
            'category_name' => $name,
            'slug' => $slug
        );
        $this->db->where('category_id', $id);
        $this->db->update('theme_category', $data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a theme category: "' . $name
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function get_category($id = FALSE, $slug) {
        if ($id != FALSE)
            $this->db->where('category_id', $id);
        elseif ($slug)
            $this->db->where('slug', $slug);
        
        $query = $this->db->get('theme_category');
        
        if ($query->num_rows() !== 0)
            return $query->result();
        else
            return FALSE;
    }
    
    function get_categories() {
        $query = $this->db->get('theme_category');
        return $query->result();
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
    
    function get_category_theme($slug) {
        $list_post = array();
        $this->db->where('slug', $slug);
        $query = $this->db->get('theme_category');
        if ($query->num_rows() == 0)
            show_404();
        
        foreach ($query->result() as $category) {
            $this->db->where('theme_relationships.category_id', $category->category_id);
            if (!$this->ion_auth->logged_in()) {
                $this->db->where('status', '3');
            } else {
                $this->db->where('status', '3')->or_where('status', '2');
            }
            $this->db->select('theme.*');
            $this->db->join('theme_relationships', 'theme.theme_id = theme_relationships.object_id');
            $this->db->order_by("theme_id", "desc");
            $query = $this->db->get('theme');
            $posts = $query->result();
        }
        
        return $posts;
    }
    
    function delete_theme($id) {
        $data = array(
            'status' => '4'
        );
        $this->db->where('theme_id', $id);
        $this->db->update('theme', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Deleted a theme'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function delete_category($id) {
        $this->db->delete('theme_category', array(
            'category_id' => $id
        ));
        $this->db->delete('theme_relationships', array(
            'category_id' => $id
        ));
    }
    
    function update_theme($id, $name, $image, $preview, $code, $body, $body_id, $status, $tweet) {
        $this->load->helper('file');
        $data = array(
            'theme_name' => $name,
            'theme_image' => $image,
            'theme_preview' => "",
            'theme_code' => $code,
            'theme_body' => $body,
            'theme_body_id' => $body_id,
            'status' => $status
        );
        $this->db->where('theme_id', $id);
        $this->db->update('theme', $data);
        
        $my_file = $id . '.html';
        write_file(FCPATH . 'preview/' . $my_file, $preview);
        
        $data = array(
            'theme_preview' => $my_file
        );
        $this->db->where('theme_id', $id);
        $this->db->update('theme', $data);
        
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a theme: "' . $name . '" check it out here ' . base_url() . 'theme/' . $id
        );
        $this->db->insert('statuses', $status_data);
        
        if ($status == 3 && $tweet == 1) {
            $this->load->model('social_model');
            $this->social_model->post_tweet($status_data['status']);
        }
    }
}