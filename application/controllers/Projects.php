<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'core/MY_Controller.php');

class projects extends MY_Controller {
    protected $data = array();
    function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
    }
    
    function index() {
        $this->data['title']          = 'Projects - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['explanation']    = 'Personal or commissioned web projects.';
        $this->data['explanation_id'] = 'Proyek web personal dan klien.';
        $this->data["file"]           = "projects/index";
        $this->render($this->data["file"], 'public_master');
    }
    
    function get_projects() {
        $data = $this->projects_model->get_projects();
        echo json_encode($data);
    }
    
    public function projects($id = false) {
        $this->data['current'] = 'Projects';
        $this->data['title']   = 'Projects | Hello Little Red';
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "projects/projects";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function add_project() {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name    = $this->input->post('name');
            $image   = $this->input->post('img');
            $exp     = $this->input->post('exp');
            $exp_id  = $this->input->post('exp_id');
            $link    = $this->input->post('link');
            $behance = $this->input->post('behance');
            $status  = $this->input->post('status');
            $tweet   = $this->input->post('tweet');
            $this->projects_model->add_new_project($name, $image, $exp, $exp_id, $link, $behance, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function update_project($id) {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name    = $this->input->post('name');
            $image   = $this->input->post('img');
            $exp     = $this->input->post('exp');
            $exp_id  = $this->input->post('exp_id');
            $link    = $this->input->post('link');
            $behance = $this->input->post('behance');
            $status  = $this->input->post('status');
            $tweet   = $this->input->post('tweet');
            $this->projects_model->update_project($id, $name, $image, $exp, $exp_id, $link, $behance, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
    public function delete_project($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->projects_model->delete_project($id);
            $data['status']     = "success";
            $data['message']    = 'Project deleted!';
            $data['message_id'] = 'Proyek dihapus!';
            echo json_encode($data);
        }
    }
    
    
}