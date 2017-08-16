<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->load->model('themes_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
		$this->load->library('ion_auth');
        $this->load->library("pagination");
        $this->load->helper("url");
        $this->data['pagetitle'] = "";
	}
	
	public function index()
	{
		$this->load->view('maintenance');
	}
}
