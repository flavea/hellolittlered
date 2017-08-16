<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shop extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('store_model');
		$this->data['current']     = 'Shop';
		$this->data['explanation'] = 'Some designs that I am selling in various forms such as phone cases, laptop bags, notebook, etc.';
	}

	public function index()
	{
		// set page title
		$this->data['title']       = 'Shop - '.$this->config->item('site_title', 'ion_auth');
		// set current menu highlight
		// get all post
		$config["base_url"]        = base_url() . "shop/index";
		$config["total_rows"]      = $this->store_model->total_count();
		$config["per_page"]        = 9;
		$config["uri_segment"]     = 3;
		$config['display_pages']   = FALSE;
		$config['next_link']       = 'Next Page';
		$config['next_tag_open']   = '<li><span class="button big next">';
		$config['next_tag_close']  = '</span></li>';
		$config['prev_link']       = 'Previous Page';
		$config['prev_tag_open']   = '<li><span class="button big previous">';
		$config['prev_tag_close']  = '</span></li>';
		$config['last_link']       = '';
		$config['first_link']      = '';
		$this->pagination->initialize($config);
		$this->data['paginglinks'] = $this->pagination->create_links();
		
		$page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["posts"]       =$this->store_model->get_designs($config["per_page"], $page);
		
		// render view
		$this->render('blog/shop','public_master');
	}
	
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */