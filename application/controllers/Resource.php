<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resource extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('resources_model');
		$this->data['explanation'] = 'Graphic resources that I made. Feel free to use.';
	}

	public function index()
	{
		// set page title
		$this->data['title']       = 'Resources - '.$this->config->item('site_title', 'ion_auth');
			// set current menu highlight
		$this->data['current']     = 'Resources';
			// get all post
		$this->data['posts']       = $this->resources_model->get_resources();
			// get all categories for sidebar menu
		$this->data['categories']  = $this->resources_model->get_types();
		foreach ($this->data['categories'] as $category ) {
			$link                      = '<a href="'.base_url().'resource/type/'.$category->type_slug.'">'.$category->type_slug."</a> - ";
			$this->data['pagetitle']   = $this->data['pagetitle'].$link; 
		}
		$config["base_url"]        = base_url() . "themes/index";
		$config["total_rows"]      = $this->themes_model->total_count();
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
		$this->data["posts"]       = $this->resources_model->get_resources($config["per_page"], $page);
		// render view
		$this->render('blog/resources','public_master');
	}
	
	
	
	public function type($slug = FALSE)
	{
		$this->data['title']      = $slug.' - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle']  = $slug;
		$this->data['categories'] = $this->resources_model->get_type(NULL,$slug);

		$this->data['current'] = 'Resources/'.$slug;
		
		if( $slug == FALSE )
			redirect(themes);
		else
		{
			$this->data['category'] = $this->resources_model->get_type(NULL,$slug); // get category details
			$this->data['posts']    = $this->resources_model->get_category_resource($slug); // get post in the category
		}
		
		$this->render('blog/resources','public_master');
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */