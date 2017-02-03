<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class writing extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('writing_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
		$this->load->library('ion_auth');
        $this->load->library("pagination");
        $this->load->helper("url");
        $this->data['image'] = '';
        $this->data['keywords'] = '';
	}

	public function index()
	{
		// set page title
		$this->data['title'] = 'Stories - '.$this->config->item('site_title', 'ion_auth');
		// set current menu highlight
		$this->data['current'] = 'Stories';

		$this->data['explanation'] = "Fictions and fanfictions that I made.";
 
		
        $this->data["posts"] = $this->writing_model->get_stories();
        $this->data["total"] = $this->writing_model->total_count();
		$this->render('blog/writing','public_master');
	}
}