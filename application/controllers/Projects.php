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
		$this->load->model('look_model');
		$this->load->model('site_model');
		$this->load->library('ion_auth');

        $this->data['current'] = '';
        $this->data['image'] = '';
        $this->data['keywords'] = '';
	}

	function index()
	{
		$this->data['title'] = 'Projects - ' . $this->config->item('site_title', 'ion_auth');

		// set current menu highlight

		$this->data['current'] = 'Projects';
		$this->data['explanation'] = 'Websites that I have a part in developing.';


		$this->data['projects'] = $this->projects_model->get_projects();

		$this->render('blog/projects', 'public_master');
	}

}
