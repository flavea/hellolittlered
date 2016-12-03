<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class album extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('photo_model');
		$this->load->model('look_model');
		$this->load->model('site_model');
		$this->load->library('ion_auth');
	}

	function index()
	{
		$this->data['title'] = 'Albums - ' . $this->config->item('site_title', 'ion_auth');

		// set current menu highlight

		$this->data['current'] = 'HOME';
		$this->data['pagetitle'] = 'Photo Albums';
		$this->data['albums'] = $this->photo_model->get_albums();

		// render view

		$this->render('blog/album', 'public_master');
	}

	function photos($id)
	{
		$this->data['title'] = 'Photos - ' . $this->config->item('site_title', 'ion_auth');

		// set current menu highlight

		$this->data['albums'] = $this->photo_model->get_album($id);
		$this->data['pagetitle'] = '';
		$this->render('blog/photos', 'public_master');
	}
}
