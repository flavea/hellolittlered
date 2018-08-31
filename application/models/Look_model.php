<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class look_model extends CI_Model {
    
    function get_sidebars() {
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get('sidebars');
        return $query->result();
    }
    
    function get_alphabets($id) {
        if ($id == 1)
            return 'A';
        if ($id == 2)
            return 'B';
        if ($id == 3)
            return 'C';
        if ($id == 4)
            return 'D';
        if ($id == 5)
            return 'E';
        if ($id == 6)
            return 'F';
        if ($id == 7)
            return 'G';
        if ($id == 8)
            return 'H';
        if ($id == 9)
            return 'I';
        if ($id == 10)
            return 'J';
        if ($id == 11)
            return 'K';
        if ($id == 12)
            return 'L';
        if ($id == 13)
            return 'M';
        if ($id == 14)
            return 'N';
        if ($id == 15)
            return '0';
        if ($id == 16)
            return 'P';
        if ($id == 17)
            return 'Q';
        if ($id == 18)
            return 'R';
        if ($id == 19)
            return 'S';
        if ($id == 20)
            return 'T';
        if ($id == 21)
            return 'U';
        if ($id == 22)
            return 'V';
        if ($id == 23)
            return 'W';
        if ($id == 24)
            return 'X';
        if ($id == 25)
            return 'Y';
        if ($id == 26)
            return 'Z';
    }
    
    function get_theme_categories() {
        $this->db->distinct();
        $this->db->group_by('theme_category.category_id');
        $this->db->select('*');
        $this->db->from('theme_category');
        $this->db->join('theme_relationships', 'theme_relationships on theme_category.category_id = theme_relationships.category_id');
        $this->db->order_by('theme_category.category_name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function get_all_sidebars() {
        $this->db->where('status', '3')->or_where('status', '2')->or_where('status', '1');
        $query = $this->db->get('sidebars');
        return $query->result();
    }
    
    function get_sidebar($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sidebars');
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    function get_website($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('websites');
        
        if ($query->num_rows() !== 0) {
            return $query->result();
        } else
            return FALSE;
    }
    
    
    function get_socmeds() {
        $this->db->where('id', '1');
        $query = $this->db->get('socmeds');
        return $query->result();
    }
    
    function get_websites() {
        
        if (!$this->ion_auth->logged_in()) {
            $this->db->where('status', '3');
        } else {
            $this->db->where('status', '3')->or_where('status', '2');
        }
        $query = $this->db->get('websites');
        return $query->result();
    }
    
    function get_all_websites() {
        $this->db->where('status', '3')->or_where('status', '2')->or_where('status', '1');
        $query = $this->db->get('websites');
        return $query->result();
    }
    
    function get_friends($limit = "") {
        if ($limit != "")
            $this->db->limit(5);
        $this->db->where('status', '3');
        $this->db->order_by('name');
        $query = $this->db->get('friends');
        return $query->result();
    }
    
    function get_pages() {
        $this->db->where('status', '3');
        $query = $this->db->get('page');
        return $query->result();
    }
    
    function get_friend($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('friends');
        return $query->result();
    }
    
    function get_all_friends() {
        $this->db->select('friends.*, status.alias');
        $this->db->from('friends');
        $this->db->join('status', 'friends.status = status.id and friends.status != "4"');
        $this->db->order_by('date_up', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function get_headers() {
        $this->db->where('id', '1');
        $query = $this->db->get('headers');
        return $query->result();
    }
    
    function add_new_sidebar($name, $content, $status) {
        $data = array(
            'name' => $name,
            'content' => $content,
            'status' => $status
        );
        $this->db->insert('sidebars', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Posted a new sidebar: "' . $name
        );
        $this->db->insert('statuses', $status_data);
        
    }
    
    function add_new_friend($name, $website, $description, $status) {
        $data = array(
            'name' => $name,
            'website' => $website,
            'description' => $description,
            'status' => $status
        );
        
        $this->db->insert('friends', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Added a new affiliates: <a href="' . $website . '">' . $name . '</a>'
        );
        $this->db->insert('statuses', $status_data);
        
        if ($status == 3 && $tweet == 1) {
            $this->load->model('social_model');
            $this->social_model->post_tweet('Hello Little Red a new affiliate: ' . $name . '. Check Them out here' . $website);
        }
        
    }
    
    function add_new_website($name, $link, $icon, $description) {
        $data = array(
            'name' => $name,
            'link' => $link,
            'icon' => $icon,
            'description' => $description
        );
        $this->db->insert('websites', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Add a new website: "' . $name
        );
        $this->db->insert('statuses', $status_data);
        
    }
    
    function delete_sidebar($id) {
        $data = array(
            'status' => '4'
        );
        $this->db->where('id', $id);
        $this->db->update('sidebars', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Deleted a sidebar'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function delete_friend($id) {
        $data = array(
            'status' => '4'
        );
        $this->db->where('id', $id);
        $this->db->update('friends', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Deleted a friend :('
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function delete_website($id) {
        $this->db->delete('websites', array(
            'id' => $id
        ));
        $status_data = array(
            'author_id' => 1,
            'status' => 'Deleted a website'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function update_sidebar($id, $name, $content, $status) {
        $data = array(
            'name' => $name,
            'content' => $content,
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('sidebars', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a sidebar: "' . $name
        );
        $this->db->insert('statuses', $status_data);
        
    }
    
    function update_website($id, $name, $link, $icon, $description) {
        $data = array(
            'name' => $name,
            'link' => $link,
            'icon' => $icon,
            'description' => $description
        );
        $this->db->where('id', $id);
        $this->db->update('websites', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a website: "' . $name
        );
        $this->db->insert('statuses', $status_data);
        
    }
    
    function update_friend($id, $name, $website, $description, $status) {
        $data = array(
            'name' => $name,
            'website' => $website,
            'description' => $description,
            'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('friends', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated a friend: <a href="' . $website . '">' . $name . '</a>'
        );
        $this->db->insert('statuses', $status_data);
        
    }
    
    function update_header($link) {
        $data = array(
            'link' => $link
        );
        $this->db->where('id', '1');
        $this->db->update('headers', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated the header'
        );
        $this->db->insert('statuses', $status_data);
    }
    
    function update_socmeds($codepen, $deviantart, $facebook, $flickr, $instagram, $linkedin, $soundcloud, $tumblr, $twitter, $youtube, $behance, $github) {
        $data = array(
            'codepen' => $codepen,
            'deviantart' => $deviantart,
            'facebook' => $facebook,
            'flickr' => $flickr,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
            'soundcloud' => $soundcloud,
            'tumblr' => $tumblr,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'behance' => $behance,
            'github' => $github
        );
        
        $this->db->where('id', '1');
        $this->db->update('socmeds', $data);
        $status_data = array(
            'author_id' => 1,
            'status' => 'Updated Social Medias'
        );
        $this->db->insert('statuses', $status_data);
    }
}