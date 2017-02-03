<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
        $this->load->model('blog_model');
		$this->load->library('ion_auth');

		$this->data['categories'] = $this->blog_model->get_categories();
        $this->data['current'] = '';
        $this->data['explanation'] = '';
        $this->data['image'] = '';
        $this->data['keywords'] = '';
	}

	public function index() {
		$cari=$this->input->get('query');
		$this->data['explanation'] 		= 'Search Results for"'.$cari.'"';
		$this->data['title'] = 'Search for "'.$cari.'" - '.$this->config->item('site_title', 'ion_auth');
        $this->data["posts"] = $this->search_model->search($cari);
		$this->render('blog/search','public_master');
	}


}