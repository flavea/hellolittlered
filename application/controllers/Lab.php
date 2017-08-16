<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class lab extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}

	function index()
	{
		$this->data['title']       = 'Experiments - ' . $this->config->item('site_title', 'ion_auth');
		$this->data['current']     = 'Experiments';
		$this->data['explanation'] = 'My experiments in various programming language.';
		$this->data['posts']    = $this->projects_model->get_experiments();

		$this->render('blog/lab', 'public_master');
	}

}
