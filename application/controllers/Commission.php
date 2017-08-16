<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class commission extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('commission_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('email');
        $this->data['explanation'] = 'Commission page for tumblr, wordpress, zetaboards themes, and etc.';
        $this->data['keywords'] = 'tumblr themes price, buy tumblr themes';
    }

    public function index() {
      $this->data['title'] = 'Commission - '.$this->config->item('site_title', 'ion_auth');
      $this->data['categories'] = $this->commission_model->get_categories();

      $this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_space_only');
      $this->form_validation->set_rules('email', 'Emaid ID', 'trim|required|valid_email');
      $this->form_validation->set_rules('message', 'Message', 'trim|required');
      if ($this->form_validation->run() == FALSE)
      {
         $this->render('blog/commission','public_master');
     }
     else
     {
        $name         = $this->input->post('name');
        $from_email   = $this->input->post('email');
        $message      = $this->input->post('message');
        $site         = $this->input->post('site');
        $sketch       = $this->input->post('sketch');
        $category     = $this->input->post('category[]');
        $val            = $this->input->post('validate');
        if($val == "Bond" || $val == "bond") {
            $ifnoreply    = 'admin@hellolittlered.org';
            $full_message ='<b>Name:</b> '.$name.'<br><b>Email:</b> '.$from_email.'<br><b>Site:</b> '.$site.'<br><b>Sketch: </b>'.$sketch.'<br><b>category:</b> '.$category.'<br><b>message:</b> '.$message;
    
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
            $config['newline']   = "\r\n"; //use double quotes*/
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
              $this->email->subject('[HELLO LITTLE RED] A new commission!');
              $this->email->set_mailtype("html");
              $this->email->message($message); 
    
              if ($this->email->send())
              {
                    // mail sent
                $this->session->set_flashdata('message','Your mail has been sent successfully!');
                redirect('commission');
            }
            else
            {
                    //error
                $this->session->set_flashdata('message','There is error in sending mail! Please try again later');
                redirect('commission');
            }
        } else {
            $this->session->set_flashdata('message','Wrong validation.');
            redirect('commission');
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
}


}