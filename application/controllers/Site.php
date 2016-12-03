<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
        $this->load->model('blog_model');
		$this->load->library('ion_auth');
	}

	public function index() {
		// set page title
		$this->data['title'] = 'Home - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = 'Latest Updates';
		// set current menu highlight
		$this->data['current'] = 'HOME';
		// get all post
		// get all categories for sidebar menu
		
        $this->data["posts"] = $this->site_model->get_updates();
		$this->render('blog/site','public_master');
	}

	public function page($slug) // get a post based on id
	{
		$this->data['title'] = 'Hello Little Red';
		$this->data['query'] 			= $this->page_model->get_page($slug);
		$this->data['page_slug'] 		= $slug;
		$this->data['pagetitle'] 		= '';
		
		if( $this->ion_auth->logged_in() )
		$this->data['user'] = $this->ion_auth->user()->row(); // get current user login details
		
		$this->render('blog/page','public_master');
	}
}