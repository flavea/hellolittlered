<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class friends extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('contact_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('email');
		$this->data['categories']  = $this->blog_model->get_categories();
	}

	public function apply() {
		$this->data['title'] = 'Apply as Affiliate - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';

		$this->form_validation->set_rules('name', 'Name', 'required|callback_alpha_space_only');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render('friends/affiliates-form','public_master');
		}
		else
		{
			if($this->input->post('spamer') != "") {
				$this->session->set_flashdata('message','Your mail has been sent successfully!');
				redirect('friends/apply');
			} else {
				$name        = $this->input->post('name');
				$website     = $this->input->post('website');
				$description = $this->input->post('description');
				$from_email  = 'no-reply@hellolittlered.org';
				$subject     = ' New Affiliate Application';
				$message     = '<b>Name:</b> '.$name.'<br><b>Website:</b> '.$website.'<br><b>Description:</b> '.$description;
				
	            //set to_email id to which you want to receive mails
				$to_email = 'iarifiany@gmail.com';
				
				//$to_email = 'wolf@hellolittlered.com';
				
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
	            
	            
	            $final_subject = '[HELLO LITTLE RED]'.$subject;
	            $this->email->from($from_email, $name);
	            $this->email->to($to_email);
	            $this->email->subject($final_subject);
	            $this->email->message($message); 
	            $this->email->set_mailtype("html");
	            $this->look_model->add_new_friend($name, $website, $description, '1');
	            
	            if ($this->email->send())
	            {
	                // mail sent
	            	$this->session->set_flashdata('message','You have successfully applied, your application will be reviewed and then accepted soon.');
	            	redirect('friends/apply');
	            }
	            else
	            {
	                //error
	            	$this->session->set_flashdata('message','There is error! Please try again later');
	            	redirect('friends/apply');
	            }
	        }

	    }

	}

	public function index() {
		$this->data['title']     = 'Affiliates - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = '';
		$this->data['current']   = 'friends';
		$this->data['posts']     = $this->look_model->get_friends();
		$this->render('friends/affiliates','public_master');
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

    public function friends($id = false)
    {

        $this->load->model('look_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add Website | Hello Little Red';
        $this->data['categories'] = $this->look_model->get_all_friends();

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('name', 'name', 'required');

            if ($this->form_validation->run() == FALSE) {
                if($id != false) $this->data['query']      = $this->look_model->get_friend($id);
                $this->render('friends/friends', 'admin_master');
            } else {


                $name        = $this->input->post('name');
                $website     = $this->input->post('website');
                $description = $this->input->post('description');
                $status      = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                if ($id == false) {
                    //print_r($name);print_r($website);die();
                    $this->look_model->add_new_friend($name, $website, $description, $status, $tweet);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('friends/friends');
                } else {
                    $this->look_model->update_friend($id, $name, $website, $description, $status, $tweet);
                    $this->session->set_flashdata('message', $name.' Updated');
                    redirect('friends/friends');

                }
            }
        }
    }

    public function delete_friend($id)
    {
        $this->load->model('look_model');
        $this->look_model->delete_website($id);
        $this->session->set_flashdata('message', 'a website is deleted.');
        redirect('friends/website');
    }

}