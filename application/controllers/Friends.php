<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Friends extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('look_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('email');
    }
    
    public function apply() {
        $this->data['title']     = 'Apply as Affiliate - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['pagetitle'] = '';
        $this->data["file"]      = "friends/affiliates-form";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function submit() {
        $name        = $this->input->post('name');
        $website     = $this->input->post('website');
        $description = $this->input->post('description');
        $from_email  = 'no-reply@hellolittlered.org';
        $subject     = ' New Affiliate Application';
        $message     = '<b>Name:</b> ' . $name . '<br><b>Website:</b> ' . $website . '<br><b>Description:</b> ' . $description;
        
        $to_email = 'iarifiany@gmail.com';
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'flaveavorfreude@gmail.com',
            'smtp_pass' => '1j9u1l1i9a5n',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        
        $final_subject = '[HELLO LITTLE RED]' . $subject;
        $this->email->from($from_email, $name);
        $this->email->to($to_email);
        $this->email->subject($final_subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->look_model->add_new_friend($name, $website, $description, '1');
        
        if ($this->email->send()) {
            $data['status']     = "success";
            $data['message']    = 'You have successfully applied, your application will be reviewed and then accepted soon.';
            $data['message_id'] = 'Sukses!';
            echo json_encode($data);
        } else {
            $data['status']     = "failed";
            $data['message']    = 'There is error in sending mail! Please try again later';
            $data['message_id'] = 'Terjadi kesalahan saat pengiriman terjadi, harap mencoba lagi.';
            echo json_encode($data);
        }
        
    }
    
    public function index() {
        $this->data['title']   = 'Affiliates - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['current'] = 'friends';
        $this->data["file"]    = "friends/affiliates";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function get_friends() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            $data = $this->look_model->get_friends();
        } else {
            $data = $this->look_model->get_all_friends();
        }
        echo json_encode($data);
    }
    
    function alpha_space_only($str) {
        if (!preg_match("/^[a-zA-Z ]+$/", $str)) {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function friends($id = false) {
        $this->data['current'] = 'Friends';
        $this->data['title']   = 'Friends | Hello Little Red';
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "friends/friends";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function add_friend() {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name        = $this->input->post('name');
            $website     = $this->input->post('website');
            $description = $this->input->post('description');
            $status      = $this->input->post('status');
            $tweet       = $this->input->post('tweet');
            
            $this->look_model->add_new_friend($name, $website, $description, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function update_friend($id) {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name        = $this->input->post('name');
            $website     = $this->input->post('website');
            $description = $this->input->post('description');
            $status      = $this->input->post('status');
            $tweet       = $this->input->post('tweet');
            $this->look_model->update_friend($id, $name, $website, $description, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
    public function delete_friend($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->look_model->delete_website($id);
            $data['status']     = "success";
            $data['message']    = 'Friend deleted!';
            $data['message_id'] = 'Teman dihapus!';
            echo json_encode($data);
        }
    }
    
}