<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maps extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
		$this->load->library('ion_auth');

		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('email');
	}

	public function index() {
		$this->data['title'] = 'Contact Us - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		// set current menu highlight
		$this->data['current'] = 'HOME';

		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
         if ($this->form_validation->run() == FALSE)
        {
			$this->render('blog/contact','public_master');
        }
        else
        {
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'iarifiany@gmail.com';

            //configure email settings
           /* $config['protocol'] = 'smtp';
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
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject('[HELLO LITTLE RED] A new message!');
            $this->email->message($message); 

          	if($this->contact_model->add_new_contact($name, $from_email, $message)) {
                $this->session->set_flashdata('message','Your mail has been sent successfully!');
                redirect('contact');
          	}

           /* if ($this->email->send())
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
            }*/

        }

	}

	public function q() {
		$this->data['title'] = 'Questions - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		// set current menu highlight
		$this->data['current'] = 'HOME';
		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
         if ($this->form_validation->run() == FALSE)
        {
            $this->data['posts'] = $this->contact_model->get_questions(true);
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
           /* $config['protocol'] = 'smtp';
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
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject('[HELLO LITTLE RED] A new question!');
            $this->email->message($message); 

          	if($this->contact_model->add_new_question($name, $message)) {
                $this->session->set_flashdata('message','Your question has been sent successfully!');
                redirect('contact/q');
          	}

           /* if ($this->email->send())
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
            }*/

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


    public function report() {
        $this->data['title'] = 'Report - '.$this->config->item('site_title', 'ion_auth');
        $this->data['pagetitle'] = '';
        // set current menu highlight
        $this->data['current'] = 'HOME';
        $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
         if ($this->form_validation->run() == FALSE)
        {
            $this->data['posts'] = $this->contact_model->get_questions(true);
            $this->render('blog/contact','public_master');
        }
        else
        {
            $name = $this->input->post('name');
            $from_email = 'admin@hellolittlered.org';
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'iarifiany@gmail.com';

            //configure email settings
           /* $config['protocol'] = 'smtp';
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
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject('[HELLO LITTLE RED] A new question!');
            $this->email->message($message); 

            if($this->contact_model->add_new_question($name, $message)) {
                $this->session->set_flashdata('message','Your question has been sent successfully!');
                redirect('contact/report');
            }

           /* if ($this->email->send())
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
            }*/

        }
    }


}