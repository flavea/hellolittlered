<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class shop extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('store_model');
        $this->data['current']        = 'Shop';
        $this->data['explanation']    = 'Some designs that I am selling in various forms such as phone cases, laptop bags, notebook, etc.';
        $this->data['explanation_id'] = 'Desain yang dijual dalam berbagai bentuk seperti case HP, tas laptop, dll.';
    }
    
    public function index() {
        $this->data['title'] = 'Shop';
        $this->data['title'] = 'Shop | Hello Little Red';
        $this->data["file"]  = "graphics/shop";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function get_store_items() {
        $data = $this->store_model->get_designs();
        echo json_encode($data);
    }
    
}
