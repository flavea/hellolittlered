<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class notfound extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('look_model');
		$this->load->model('site_model');
		$this->load->library('ion_auth');
	}

	function index()
	{
		$data['title'] = $this->config->item('site_title', 'ion_auth');

		$this->load->view('404', $data);
	}

	
}
