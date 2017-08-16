<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
        $this->load->model('blog_model');
		$this->data['categories']  = $this->blog_model->get_categories();
	}

	public function index() {
		$cari=$this->input->get('query');
		$this->data['explanation']  = 'Search Results for"'.$cari.'"';
		$this->data['title']        = 'Search for "'.$cari.'" - '.$this->config->item('site_title', 'ion_auth');
		$this->data["blogs_res"]    = $this->search_model->search_blog($cari);
		$this->data["themes_res"]   = $this->search_model->search_theme($cari);
		$this->data["page_res"]     = $this->search_model->search_page($cari);
		$this->data["projects_res"] = $this->search_model->search_projects($cari);
		$this->data["writings_res"] = $this->search_model->search_writing($cari);
		$this->render('blog/search','public_master');
	}


}