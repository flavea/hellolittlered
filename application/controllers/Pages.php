<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends MY_Controller {
    protected $data = array();
    
    function __construct() {
        parent::__construct();
        $this->load->model('page_model');
    }
    
    public function index() {
        $this->data['title']     = 'Pages - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['pagetitle'] = 'All Pages';
        $this->data['current']   = 'pages';
        $this->data["file"]      = "pages/index";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function page($slug, $private = false) {
        $this->data['query']     = $this->page_model->get_page($slug);
        $this->data['pagetitle'] = '';
        $this->data['title']     = $slug . " - Hello Little Red";
        $this->data['current']   = "";
        
        if ($this->ion_auth->logged_in())
            $this->data['user'] = $this->ion_auth->user()->row();
        
        if ($this->data['query']) {
            if (($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
                show_404();
            else if ($this->data['query'][0]->status == 4)
                show_404();
            else if ($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in())
                show_404();
            else {
                foreach ($this->data['query'] as $row) {
                    $this->data['title']       = $row->page_title;
                    $this->data['explanation'] = substr($row->page_body, 0, 200);
                    $this->data['image']       = '';
                }
                $this->data["file"] = "pages/page";
                $this->render($this->data["file"], 'public_master');
            }
        } else
            show_404();
    }
    
    public function get_page($slug, $private = false) {
        $get = $this->page_model->get_page($slug);
        if (($get[0]->status == 2 || $get[0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
            show_404();
        else if ($get[0]->status == 4)
            show_404();
        else if ($get[0]->status == 1 && !$this->ion_auth->logged_in())
            show_404();
        else {
            foreach ($get as $row) {
                $data['title']       = $row->page_title;
                $data['explanation'] = substr($row->page_body, 0, 200);
                $data['image']       = '';
            }
            
            echo json_encode($get);
        }
    }
    
    public function get_page_by_id($id, $private = false) {
        $get = $this->page_model->get_page_by_id($id);
        if (($get[0]->status == 2 || $get[0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
            show_404();
        else if ($get[0]->status == 4)
            show_404();
        else if ($get[0]->status == 1 && !$this->ion_auth->logged_in())
            show_404();
        else {
            foreach ($get as $row) {
                $data['title']       = $row->page_title;
                $data['explanation'] = substr($row->page_body, 0, 200);
                $data['image']       = '';
            }
            
            echo json_encode($get);
        }
    }
    
    public function form_page($id = "") {
        
        $this->data['current'] = 'Page Form';
        $this->data['title']   = 'Page | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "pages/form_page";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function add_page() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $user     = $this->ion_auth->user()->row();
            $title    = $this->input->post('page_title');
            $title_id = $this->input->post('page_title_id');
            $body     = $this->input->post('page_body');
            $body_id  = $this->input->post('page_body_id');
            $slug     = $this->input->post('page_slug');
            $status   = $this->input->post('status');
            $tweet    = $this->input->post('tweet');
            
            $this->page_model->add_new_page($user->id, $title, $title_id, $body, $body_id, $slug, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $title . ' added!';
            $data['message_id'] = $title . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function manage_pages() {
        $this->data['current'] = 'Manage Pages';
        $this->data['title']   = 'Manage Pages | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "pages/manage_pages";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function delete_page($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->page_model->delete_page($id);
            $data['status']     = "success";
            $data['message']    = 'Page deleted!';
            $data['message_id'] = 'Halaman dihapus!';
            echo json_encode($data);
        }
    }
    
    
    public function update_page($id = '') {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $title    = $this->input->post('page_title');
            $title_id = $this->input->post('page_title_id');
            $body     = $this->input->post('page_body');
            $body_id  = $this->input->post('page_body_id');
            $slug     = $this->input->post('page_slug');
            $status   = $this->input->post('status');
            $tweet    = $this->input->post('tweet');
            
            $this->page_model->update_page($id, $title, $title_id, $body, $body_id, $slug, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $title . ' updated!';
            $data['message_id'] = $title . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
}