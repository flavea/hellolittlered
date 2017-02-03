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
		$this->load->model('social_model');
		$this->load->library('ion_auth');
	}

	function index()
	{
		$this->data['title'] = 'Albums - ' . $this->config->item('site_title', 'ion_auth');

		$this->data['current'] = 'photos';
		$this->data['explanation'] = 'Personal photos that I took and saved on flickr and instagram.';
		$this->data['image'] = '';
		$this->data['keywords'] = 'photography';


		$this->data['flickr'] = $this->social_model->get_latest_flickr();
		$response = $this->social_model->get_latest_instagram();
		$this->data['instagram'] = $response['data'];


		$this->render('blog/album', 'public_master');
	}

}
