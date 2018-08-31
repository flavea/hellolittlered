<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'core/MY_Controller.php');

class Graphics extends MY_Controller {
    protected $data = array();
    function __construct() {
        parent::__construct();
        $this->load->model('social_model');
        $this->load->model('store_model');
    }
    
    function index() {
        $this->data['title'] = 'Graphics - ' . $this->config->item('site_title', 'ion_auth');
        
        $this->data['current']     = 'Graphics';
        $this->data['explanation'] = 'Graphics I made for various things. Just for memories, because I suck at this.';
        
        $this->data['explanation_id'] = 'Poster, edit, dll.';
        $this->data['results']        = $this->social_model->get_tumblr_posts(9, "gyuseu", "gfx");
        $this->data['seconds']        = $this->social_model->get_tumblr_posts(6, "slayein", false);
        
        $this->data["file"] = "graphics/index";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function design() {
        $this->data['title'] = 'Store';
        $this->data['title'] = 'Store | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_graphics()) {
            show_404();
        } else {
            $this->data["file"] = "graphics/design";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function get_designs() {
        $data = $this->store_model->get_all_designs();
        echo json_encode($data);
    }
    
    public function add_design() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_graphics()) {
            show_404();
        } else {
            $name      = $this->input->post('name');
            $image     = $this->input->post('image');
            $redbubble = $this->input->post('redbubble');
            $tees      = $this->input->post('tees');
            $status    = $this->input->post('status');
            $tweet     = $this->input->post('tweet');
            $this->store_model->add_new_design($name, $image, $redbubble, $tees, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function update_design($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_graphics()) {
            show_404();
        } else {
            $name      = $this->input->post('name');
            $image     = $this->input->post('image');
            $redbubble = $this->input->post('redbubble');
            $tees      = $this->input->post('tees');
            $status    = $this->input->post('status');
            $tweet     = $this->input->post('tweet');
            $this->store_model->update_design($id, $name, $image, $redbubble, $tees, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
    public function delete_design($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->store_model->delete_design($id);
            $data['status']     = "success";
            $data['message']    = 'Item deleted!';
            $data['message_id'] = 'Item dihapus!';
            echo json_encode($data);
        }
    }
    
}