<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class commission extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('commission_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('email');
        $this->data['explanation']    = 'Commission page for tumblr, wordpress, zetaboards themes, and etc.';
        $this->data['explanation_id'] = 'Halaman untuk memesan desain web, tema tumblr, tema wordpress, tema zetaboards, dll.';
        $this->data['keywords']       = 'tumblr themes price, buy tumblr themes';
    }
    
    public function index()
    {
        $this->data['title'] = 'Commission - ' . $this->config->item('site_title', 'ion_auth');
        $this->data["file"] = "commission/index";
        $this->render($this->data["file"], 'public_master');
        
    }
    
    public function get_categories()
    {
        $data = $this->commission_model->get_categories();
        echo json_encode($data);
	}
	
	public function submit() {
		$name       = $this->input->post('name');
		$from_email = $this->input->post('email');
		$message    = $this->input->post('message');
		$site       = $this->input->post('site');
		$sketch     = $this->input->post('sketch');
		$category   = $this->input->post('type');
        $val        = $this->input->post('validate');
		if ($val == "Bond" || $val == "bond") {
			$ifnoreply    = 'admin@hellolittlered.org';
			$full_message = '<b>Name:</b> ' . $name . '<br><b>Email:</b> ' . $from_email . '<br><b>Site:</b> ' . $site . '<br><b>Sketch: </b>' . $sketch . '<br><b>message:</b> ' . $message;
			
			$to_email = 'iarifiany@gmail.com';
			
			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.gmail.com';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'flaveavorfreude@gmail.com';
			$config['smtp_pass'] = '1j9u1l1i9a5n';
			$config['mailtype']  = 'html';
			$config['charset']   = 'iso-8859-1';
			$config['wordwrap']  = TRUE;
			$config['newline']   = "\r\n";
			$config              = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'flaveavorfreude@gmail.com', // change it to yours
				'smtp_pass' => '1j9u1l1i9a5n', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			$this->load->library('email', $config);
			//$this->email->initialize($config);
			
			//send mail
			if (strpos($from_email, 'yahoo') !== false) {
				$this->email->from($ifnoreply, $name);
			} else {
				$this->email->from($from_email, $name);
			}
			$this->email->to($to_email);
			$this->email->subject('[HELLO LITTLE RED] A new commission!');
			$this->email->set_mailtype("html");
			$this->email->message($message);
			
			if ($this->email->send()) {
                $data['status'] = "success";
                $data['message'] = 'Email sent! Please wait for the answer!';
                $data['message_id'] = 'Email terkirim!';
                $this->commission_model->add_new_commission($name, $from_email, $site, $sketch, $message, $category);
                echo json_encode($data);
			} else {
                $data['status'] = "failed";
                $data['message'] = 'There is error in sending mail! Please try again later';
                $data['message_id'] = 'Terjadi kesalahan saat pengiriman terjadi, harap mencoba lagi.';
                echo json_encode($data);
			}
		} else {
            $data['status'] = "failed";
            $data['message'] = "Wrong validation text!";
            $data['message_id'] = "Teks validasi salah!";
			echo json_encode($data);
		} 
	}
    
    function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/", $str)) {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function commissions($id = NULL)
    {
        $this->data['current'] = 'Commissions';
        $this->data['title'] = 'Commissions | Hello Little Red';
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        }
        
        if ($id == NULL) {
            $this->data["file"] = "commission/commission";
        } else {
            $this->data["file"] = "commission/detail";
        }
        $this->render($this->data["file"], 'admin_master');
    }

    public function get_commissions() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $data = $this->commission_model->get_commissions();
            json_encode($data);
        }
    }

    public function get_commission_by_id() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $data = $this->commission_model->get_commission($id);
            json_encode($data);
        }
    }
    
    public function commission_mark($id = NULL)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        }
        
        if ($id == NULL) {
            $this->data['posts'] = $this->commission_model->mark_read();
            $this->session->set_flashdata('message', 'All commissions are marked as read!');
            redirect('commission/commissions');
        } else {
            $this->data['posts'] = $this->commission_model->mark_read($id);
            $this->session->set_flashdata('message', 'Marked as read!');
            redirect('commission/commissions');
        }
    }
    
}