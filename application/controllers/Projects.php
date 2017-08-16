<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class projects extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}

	function index()
	{
		$this->data['title']       = 'Projects - ' . $this->config->item('site_title', 'ion_auth');
		$this->data['projects']    = $this->projects_model->get_projects();
		$this->render('blog/projects', 'public_master');
	}

}
