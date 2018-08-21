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
        $this->load->library('ion_auth');
        $this->load->helper("url");
        $this->data['current'] = '';
        $this->data['explanation'] = '';
        $this->data['explanation_id'] = '';
        $this->data['image'] = '';
        $this->data['keywords'] = '';
    	/* $this->data['music']     = $this->social_model->get_latest_lastfm();
        $this->data['read']     = $this->social_model->get_latest_read(); */
        $this->data['query']             = '';
        $this->data['updates']           = $this->site_model->get_statuses();
        $this->data['statuses']          = $this->site_model->get_data_statuses();
        $this->data['commissions_count'] = $this->site_model->get_commissions_count();
        $this->data['q_count']           = $this->site_model->get_questions_count();
        $this->data['emails_count']      = $this->site_model->get_emails_count();
        $this->data['friends_count']     = $this->site_model->get_friends_count();

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
