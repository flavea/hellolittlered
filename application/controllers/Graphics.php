<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class graphics extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('photo_model');
		$this->load->model('look_model');
		$this->load->model('site_model');
		$this->load->model('social_model');
		$this->load->library('ion_auth');
		$this->data['current'] = '';
		$this->data['explanation'] = '';
		$this->data['image'] = '';
        $this->data['keywords'] = '';
	}

	function index()
	{
		$this->data['title'] = 'Graphics - ' . $this->config->item('site_title', 'ion_auth');

		// set current menu highlight

		$this->data['current'] = 'Graphics';
		$this->data['explanation'] = 'Graphics I made for various things. Just for memories, because I suck at this.';

		$this->data['results'] = $this->social_model->get_tumblr_posts(9, "gyuseu", "gfx");
		$this->data['seconds'] = $this->social_model->get_tumblr_posts(6, "slayein", false);

		$this->render('blog/gfx', 'public_master');
	}

}
