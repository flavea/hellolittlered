<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');header('Access-Control-Allow-Origin: *');

class writing extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('writing_model');
		$this->load->model('blog_model');
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->output->set_header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		// set page title
		$this->data['title']       = 'Stories - '.$this->config->item('site_title', 'ion_auth');
		// set current menu highlight
		$this->data['current']     = 'Stories';

		$this->data['explanation'] = "Fictions and fanfictions that I made.";

		$config                    = array();
		$config["base_url"]        = base_url() . "blog/index";
		$config["total_rows"]      = $this->writing_model->total_count();
		$config["per_page"]        = 9;
		$config["uri_segment"]     = 3;
		$config['display_pages']   = FALSE;
		$config['next_link']       = 'Next Page';
		$config['next_tag_open']   = '<span class="button big next">';
		$config['next_tag_close']  = '</span>';
		$config['prev_link']       = 'Previous Page';
		$config['prev_tag_open']   = '<span class="button big previous">';
		$config['prev_tag_close']  = '</span>';
		$config['last_link']       = '';
		$config['first_link']      = '';
		$this->pagination->initialize($config);
		$this->data['paginglinks'] = $this->pagination->create_links();

		$page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["posts"]       = $this->writing_model->get_stories($config["per_page"], $page);
		$this->data["total"]       = $this->writing_model->total_count();
		$this->render('blog/writing','public_master');
	}
	
	public function ficrec()
	{
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$data["results"] = $this->writing_model->get_fic_rec();
        	echo json_encode($data["results"]);
	}
}