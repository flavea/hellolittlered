<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contact_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('email');
        $this->data['current']     = '';
        $this->data['explanation'] = '';
        $this->data['image']       = '';
        
        $this->data['keywords']   = '';
    }
    
    public function index()
    {
        $this->data['title']     = 'Contact Us - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['pagetitle'] = '';
        $this->render('contact/index', 'public_master');
        
    }
    
    public function submit()
    {
        $name       = $this->input->post('name');
        $from_email = $this->input->post('email');
        $subject    = $this->input->post('subject');
        $message    = $this->input->post('message');
        $val        = $this->input->post('validate');
        if ($val == "Infinity" || $val == "infinity") {
            
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
                'smtp_user' => 'flaveavorfreude@gmail.com',
                'smtp_pass' => '1j9u1l1i9a5n',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            if (strpos($from_email, 'yahoo') !== false) {
                $this->email->from($ifnoreply, $name);
            } else {
                $this->email->from($from_email, $name);
            }
            $final_subject = '[HELLO LITTLE RED]' . $subject;
            $this->email->to($to_email);
            $this->email->subject($final_subject);
            $this->email->message($message);
            $this->email->set_mailtype("html");
            $this->contact_model->add_new_contact($name, $from_email, $message);
            
			if ($this->email->send()) {
                $data['status'] = "success";
                $data['message'] = 'Email sent! Please wait for the answer!';
                $data['message_id'] = 'Email terkirim!';
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
    
    public function emails()
    {
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['current'] = 'Emails';
        $this->data['title'] = 'Emails | Hello Little Red';
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "contact/emails";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function get_emails($page) {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $config                   = array();
            $config["base_url"]       = base_url() . "contact/get_emails/";
            $config["total_rows"]     = $this->contact_model->total_count_emails();
            $config["per_page"]       = 5;
            $config["uri_segment"]    = 3;
            $config['display_pages']  = TRUE;
            $config['next_link']       = '<span class="fa fa-chevron-right"></span>';
            $config['next_tag_open']   = '<span class="button big next">';
            $config['next_tag_close']  = '</span>';
            $config['prev_link']       = '<span class="fa fa-chevron-left"></span>';
            $config['prev_tag_open']   = '<span class="button big previous">';
            $config['prev_tag_close']  = '</span>';
            $config['last_link']      = '';
            $config['first_link']     = '';
            $this->pagination->initialize($config);
            $data['paginglinks'] = $this->pagination->create_links();
            $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['posts']       = $this->contact_model->get_emails($config["per_page"], $page);
            echo json_encode($data);
        }
    }
    
    public function email_mark($id = NULL)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        }
        
        if ($id == NULL) {
            $this->data['posts'] = $this->contact_model->mark_read();
            $this->session->set_flashdata('message', 'All emails are marked as read!');
            redirect('contact/contacts');
        } else {
            $this->data['posts'] = $this->contact_model->mark_read($id);
            $this->session->set_flashdata('message', 'Email Marked as Read!');
            redirect('contact/contacts');
        }
    }
    
    public function questions()
    {
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Questions | Hello Little Red';
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $config                   = array();
            $config["base_url"]       = base_url() . "contact/questions/";
            $config["total_rows"]     = $this->contact_model->total_all_count_quesions();
            $config["per_page"]       = 5;
            $config["uri_segment"]    = 3;
            $config['display_pages']  = TRUE;
            $config['cur_tag_open']   = '<li class="active">';
            $config['cur_tag_close']  = '</li>';
            $config['num_tag_open']   = '<li class="waves-effect">';
            $config['num_tag_close']  = '</li>';
            $config['next_link']      = '<i class="material-icons">chevron_right</i>';
            $config['next_tag_open']  = '<li class="waves-effect">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link']      = '<i class="material-icons">chevron_left</i>';
            $config['prev_tag_open']  = '<li class="waves-effect">';
            $config['prev_tag_close'] = '</li>';
            $config['last_link']      = '';
            $config['first_link']     = '';
            $this->pagination->initialize($config);
            $this->data['paginglinks'] = $this->pagination->create_links();
            $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data['posts']       = $this->contact_model->get_questions(false, $config["per_page"], $page);
            
            $this->data["file"] = "contact/questions";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function answer($id = '')
    {
        
        $this->data['page_title'] = 'Answer | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['posts'] = $this->contact_model->get_question($id);
            
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
            ));
            
            
            $this->form_validation->set_rules('answer', 'answer', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $this->data["file"] = "contact/answer";
                $this->render($this->data["file"], 'admin_master');
            } else {
                
                $id       = $this->input->post('id');
                $name     = $this->input->post('name');
                $question = $this->input->post('question');
                $answer   = $this->input->post('answer');
                $tweet    = $this->input->post('tweet');
                
                $this->contact_model->answer_questions($id, $name, $question, $answer, $tweet);
                $this->session->set_flashdata('message', 'Question from ' . $name . ' answered.');
                redirect('contact/answer/' . $id);
            }
        }
    }
    
    
}