<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('contact_model');
        	$this->load->model('look_model');
        	$this->load->model('site_model');
		$this->load->library('ion_auth');

		$this->load->library('form_validation');
        	$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
		$this->data['current'] = '';
		$this->data['explanation'] = '';
		$this->data['image'] = '';

		$this->data['categories'] = $this->blog_model->get_categories();
        $this->data['keywords'] = '';
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
				$this->render('blog/contact','public_master');
	        }
	        else
	        {
	         if($this->input->post('spamer') != "") {
	                $this->session->set_flashdata('message','Your mail has been sent successfully!');
	                redirect('contact');
	         } else {
	            $name = $this->input->post('name');
	            $from_email = $this->input->post('email');
	            $subject= $this->input->post('subject');
	            $message = $this->input->post('message');
	
	            //set to_email id to which you want to receive mails
	            $to_email = 'iarifiany@gmail.com';
	
	            //configure email settings
	           $config['protocol'] = 'smtp';
	            $config['smtp_host'] = 'ssl://smtp.gmail.com';
	            $config['smtp_port'] = '465';
	            $config['smtp_user'] = 'flaveavorfreude@gmail.com';
	            $config['smtp_pass'] = '1j9u1l1i9a5n';
	            $config['mailtype'] = 'html';
	            $config['charset'] = 'iso-8859-1';
	            $config['wordwrap'] = TRUE;
	            $config['newline'] = "\r\n"; //use double quotes*/
	            //$this->load->library('email', $config);
	             $config = Array(
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
	            $final_subject = '[HELLO LITTLE RED]'.$subject;
	            $this->email->to($to_email);
	            $this->email->subject($final_subject);
	            $this->email->message($message); 
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
	            }

	        }

	}

	public function q() {
		$this->data['title'] = 'Questions - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $config["base_url"] = base_url() . "contact/q/index";
        $config["total_rows"] = $this->contact_model->total_count_quesions();
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;
        $config['display_pages'] = FALSE;
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="button big next">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_link'] = 'Previous Page';
        $config['prev_tag_open'] = '<li><span class="button big previous">';
        $config['prev_tag_close'] = '</span></li>';
        $config['last_link'] = '';
        $config['first_link'] = '';
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
			$this->render('blog/question','public_master');
        }
        else
        {
            $name = $this->input->post('name');
            $from_email = 'admin@hellolittlered.org';
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'iarifiany@gmail.com';

            //configure email settings
           $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'flaveavorfreude@gmail.com';
            $config['smtp_pass'] = '1j9u1l1i9a5n';
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; //use double quotes*/
            //$this->load->library('email', $config);
             $config = Array(
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
            $this->email->subject('[HELLO LITTLE RED] A new question!');
            $this->email->message($message); 
            $this->contact_model->add_new_question($name, $message);

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
    }


}