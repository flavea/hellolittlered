<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'core/MY_Controller.php');

class Lab extends MY_Controller {
    protected $data = array();
    function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
    }
    
    function index() {
        $this->data['title']          = 'Experiments - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['current']        = 'Experiments';
        $this->data['explanation']    = 'My experiments in various programming language.';
        $this->data['explanation_id'] = 'Percobaan dalam berbagai bahasa pemrograman.';
        $this->data['posts']          = $this->projects_model->get_experiments();
        
        $this->data["file"] = "lab/index";
        $this->render($this->data["file"], 'public_master');
    }
    
    function get_exps() {
        $data = $this->projects_model->get_experiments();
        echo json_encode($data);
    }
    
    public function lab($id = false) {
        $this->data['current'] = 'Lab';
        $this->data['title']   = 'Lab | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "lab/lab";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function add_experiment() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name           = $this->input->post('name');
            $image          = $this->input->post('image');
            $code           = $this->input->post('code');
            $link           = $this->input->post('link');
            $description    = $this->input->post('exp');
            $description_id = $this->input->post('exp_id');
            $status         = $this->input->post('status');
            $tweet          = $this->input->post('tweet');
            $this->projects_model->add_new_experiment($name, $image, $link, $code, $description, $description_id, $status, $tweet);
            
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    public function update_experiment($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name           = $this->input->post('name');
            $image          = $this->input->post('image');
            $code           = $this->input->post('code');
            $link           = $this->input->post('link');
            $description    = $this->input->post('exp');
            $description_id = $this->input->post('exp_id');
            $status         = $this->input->post('status');
            $tweet          = $this->input->post('tweet');
            $this->projects_model->update_experiment($id, $name, $image, $link, $code, $description, $description_id, $status, $tweet);
            
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
    public function delete_experiment($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->projects_model->delete_experiment($id);
            $data['status']     = "success";
            $data['message']    = 'Experiment deleted!';
            $data['message_id'] = 'Eksperiment dihapus!';
            echo json_encode($data);
        }
    }
    
}