<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class maintenance extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['title'] = $this->config->item('site_title', 'ion_auth');
		$this->load->view('maintenance', $data);
	}
}
