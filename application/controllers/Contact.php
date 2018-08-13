<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('contact_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('email');
		$this->data['current']     = '';
		$this->data['explanation'] = '';
		$this->data['image']       = '';
		
		$this->data['categories']  = $this->blog_model->get_categories();
		$this->data['keywords']    = '';
	}

	public function index() {
		$this->data['title'] = 'Contact Us - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		// set current menu highlight

		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
		$this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render('contact/index','public_master');
		}
		else
		{
			$name       = $this->input->post('name');
			$from_email = $this->input->post('email');
			$subject    = $this->input->post('subject');
			$message    = $this->input->post('message');
            $val        = $this->input->post('validate');
            if($val == "Infinity" || $val == "infinity") {
				
	            //set to_email id to which you want to receive mails
				$to_email = 'iarifiany@gmail.com';
				
				
	            //configure email settings
				$config['protocol']  = 'smtp';
				$config['smtp_host'] = 'ssl://smtp.gmail.com';
				$config['smtp_port'] = '465';
				$config['smtp_user'] = 'flaveavorfreude@gmail.com';
				$config['smtp_pass'] = '1j9u1l1i9a5n';
				$config['mailtype']  = 'html';
				$config['charset']   = 'iso-8859-1';
				$config['wordwrap']  = TRUE;
				$config['newline']   = "\r\n"; 
	            //$this->load->library('email', $config);
	            $config = Array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'flaveavorfreude@gmail.com', // change it to yours
					'smtp_pass' => '1j9u1l1i9a5n', // change it to yours
					'mailtype'  => 'html',
					'charset'   => 'iso-8859-1',
					'wordwrap'  => TRUE
				  );
	            $this->load->library('email', $config);
	            //$this->email->initialize($config);
	            
	            //send mail
	            if (strpos($from_email, 'yahoo') !== false) {
	            	$this->email->from($ifnoreply, $name);
	            } else {
	            	$this->email->from($from_email, $name);
	            }
	            $final_subject = '[HELLO LITTLE RED]'.$subject;
	            $this->email->to($to_email);
	            $this->email->subject($final_subject);
	            $this->email->message($message); 
	            $this->email->set_mailtype("html");
	            $this->contact_model->add_new_contact($name, $from_email, $message);
	            
	            if ($this->email->send())
	            {
	                // mail sent
	            	$this->session->set_flashdata('message','Your mail has been sent successfully!');
	            	redirect('contact');
	            }
	            else
	            {
	                //error
	            	$this->session->set_flashdata('message','There is error in sending mail! Please try again later');
	            	redirect('contact');
	            }
            } else {
	                //error
	            	$this->session->set_flashdata('message','Wrong validation');
	            	redirect('contact');
                
            }

	    }

	}

	public function q() {
		$this->data['title'] = 'Questions - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$config["base_url"]       = base_url() . "contact/q/index";
		$config["total_rows"]     = $this->contact_model->total_count_quesions();
		$config["per_page"]       = 15;
		$config["uri_segment"]    = 4;
		$config['display_pages']  = FALSE;
		$config['next_link']      = 'Next Page';
		$config['next_tag_open']  = '<li><span class="button big next">';
		$config['next_tag_close'] = '</span></li>';
		$config['prev_link']      = 'Previous Page';
		$config['prev_tag_open']  = '<li><span class="button big previous">';
		$config['prev_tag_close'] = '</span></li>';
		$config['last_link']      = '';
		$config['first_link']     = '';
		$this->pagination->initialize($config);
		$this->data['paginglinks'] = $this->pagination->create_links();

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$cari=$this->input->get('query');
		$this->data['cari'] = $cari;

		if($cari=="") {
			$this->data["posts"] = $this->contact_model->get_questions(true, $config["per_page"], $page);
		} else {
			$this->data["posts"] = $this->contact_model->search_question(false, $cari);
		}
		if ($this->form_validation->run() == FALSE)
		{
			$this->render('contact/question','public_master');
		}
		else
		{
			$name = $this->input->post('name');
			$from_email = 'admin@hellolittlered.org';
			$message = $this->input->post('message');
            $val        = $this->input->post('validate');
            if($val == "Red" || $val == "red") {

                //set to_email id to which you want to receive mails
    			$to_email = 'iarifiany@gmail.com';
    
                //configure email settings
    			$config['protocol']  = 'smtp';
    			$config['smtp_host'] = 'ssl://smtp.gmail.com';
    			$config['smtp_port'] = '465';
    			$config['smtp_user'] = 'flaveavorfreude@gmail.com';
    			$config['smtp_pass'] = '1j9u1l1i9a5n';
    			$config['mailtype']  = 'html';
    			$config['charset']   = 'iso-8859-1';
    			$config['wordwrap']  = TRUE;
    			$config['newline']   = "\r\n"; 
                //$this->load->library('email', $config);
                $config = Array(
    				'protocol'  => 'smtp',
    				'smtp_host' => 'ssl://smtp.googlemail.com',
    				'smtp_port' => 465,
    				'smtp_user' => 'flaveavorfreude@gmail.com', // change it to yours
    				'smtp_pass' => '1j9u1l1i9a5n', // change it to yours
    				'mailtype'  => 'html',
    				'charset'   => 'iso-8859-1',
    				'wordwrap'  => TRUE
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
                $this->email->subject('[HELLO LITTLE RED] A new question!');
                $this->email->set_mailtype("html");
                $this->email->message($message); 
                if ($this->email->send())
                {
                    // mail sent
                	$this->session->set_flashdata('message','Your question has been sent successfully!');
                	$this->contact_model->add_new_question($name, $message);
                	redirect('contact/q');
                }
                else
                {
                    //error
                	$this->session->set_flashdata('message','There is error in sending question! Please try again later');
                	redirect('contact/q');
                }
            } else {
	                //error
	            	$this->session->set_flashdata('message','Wrong validation');
	            	redirect('contact/q');
                
            }
        }
    }

    function alpha_space_only($str)
    {
    	if (!preg_match("/^[a-zA-Z ]+$/",$str))
    	{
    		$this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }public function contacts()
    {

        $this->load->model('contact_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Emails | Hello Little Red';

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $config                   = array();
            $config["base_url"]       = base_url() . "contact/contacts/";
            $config["total_rows"]     = $this->contact_model->total_count_emails();
            $config["per_page"]       = 5;
            $config["uri_segment"]    = 3;
            $config['display_pages']  = TRUE;
            $config['cur_tag_open']   ='<li class="active">';
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
            $page                = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data['posts'] = $this->contact_model->get_emails($config["per_page"], $page);;
            $this->render('contact/emails', 'admin_master');
        }
    }

    public function email_mark($id = NULL)
    {
        $this->load->model('contact_model');
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
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

        $this->load->model('contact_model');
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
            $config['cur_tag_open']   ='<li class="active">';
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
            $page                = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data['posts'] = $this->contact_model->get_questions(false, $config["per_page"], $page);;
            $this->render('contact/questions', 'admin_master');
        }
    }

    public function answer($id = '')
    {

        $this->load->model('contact_model');
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
                $this->render('contact/answer', 'admin_master');
            } else {

                $id       = $this->input->post('id');
                $name     = $this->input->post('name');
                $question = $this->input->post('question');
                $answer   = $this->input->post('answer');
                $tweet    = $this->input->post('tweet');

                $this->contact_model->answer_questions($id, $name, $question, $answer, $tweet);
                $this->session->set_flashdata('message', 'Question from '.$name.' answered.');
                redirect('contact/answer/' . $id);
            }
        }
    }


}