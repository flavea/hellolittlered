<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
        $this->load->model('blog_model');
        $this->load->model('projects_model');
        $this->load->model('themes_model');
		$this->load->library('ion_auth');
	}

	public function index() {
		// set page title
		$this->data['title'] = 'Home - '.$this->config->item('site_title', 'ion_auth');
        $this->data["posts"] = $this->blog_model->get_posts(3, 0);
        $this->data["themes"] = $this->themes_model->get_themes(4, 0);
        $this->data["projects"] = $this->projects_model->get_latest_project();
        $this->data["experiments"] = $this->projects_model->get_latest_experiment();
        $this->data["current"] = "home";
        $this->data["explanation"] = "The front page";
		$this->render('blog/site','public_master');
	}

	public function page($slug)
	{
		$this->data['title'] = 'Hello Little Red';
		$this->data['query'] 			= $this->page_model->get_page($slug);
		$this->data['page_slug'] 		= $slug;
		$this->data['pagetitle'] 		= '';
		
		if( $this->ion_auth->logged_in() )
		$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->render('blog/page','public_master');
	}
}