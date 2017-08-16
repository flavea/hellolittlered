<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Hello Little Red';
        $this->data['page_description'] = 'A Personal Website';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
        $this->load->model('look_model');
        $this->load->model('site_model');
        $this->load->library("pagination");
        $this->load->model("social_model");
        $this->load->library('ion_auth');
        $this->load->helper("url");
        $this->data['current'] = '';
        $this->data['explanation'] = '';
        $this->data['image'] = '';
        $this->data['keywords'] = '';
        $this->data["friends"] = $this->look_model->get_friends(5);
        $this->data["pagess"] = $this->look_model->get_pages();
        $this->data["themes_categories"] = $this->look_model->get_theme_categories();
	$this->data['music']     = $this->social_model->get_latest_lastfm();
	$this->data['read']     = $this->social_model->get_latest_read();
	$this->data['watch']     = 'Chief Kim';

    }

    protected function render($the_view = NULL, $template = 'master')
      {
        if($template == 'json' || $this->input->is_ajax_request())
        {
          header('Content-Type: application/json');
          echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
          $this->load->view($the_view,$this->data);
        }
        else
        {
          $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
          $this->load->view('templates/'.$template.'_view', $this->data);
        }
      }
}

class Auth_Controller extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        if($this->ion_auth->logged_in()===FALSE)
        {
            redirect('user/login');
        }
    }
    protected function render($the_view = NULL, $template = 'admin_master')
    {
        parent::render($the_view, $template);
    }
}