<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->data['keywords'] = 'blog';
	}

	public function index($offset = 0)
	{

		$this->data['title']       = 'Blog - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle']   = 'Latest Blog Posts';
		$this->data['current']     = 'Blog';
		$this->data['explanation'] = 'Thoughts and rants about anything and everything. (Yes, I know I rarely updated the blog.)';
		$this->data['categories']  = $this->blog_model->get_categories();
		$config                    = array();
		$config["base_url"]        = base_url() . "blog/index";
		$config["total_rows"]      = $this->blog_model->total_count();
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
		$this->data["posts"]       = $this->blog_model->
		get_posts($config["per_page"], $page);
		$this->render('blog/index','public_master');
	}

	
	
	
	public function post($id, $private = "") // get a post based on id
	{
		$this->data['query']      = $this->blog_model->get_post($id);
		$data                     = $this->data['query'];
		$this->data['post_id']    = $id;
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->data['pagetitle']  = '';
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row(); // get current user login details
		
		$this->load->helper('form');
		$this->load->library(array('form_validation'));
		
		//set validation rules
		$this->form_validation->set_rules('commentor', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comment', 'Comment', 'required');
		
		if($this->data['query'])
		{
			if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
				show_404();
			else if($this->data['query'][0]->status == 4) show_404();
				else if($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in()) show_404();
			else {
				foreach($this->data['query'] as $row)
				{
					$this->data['title']       = $row->entry_name.' - '.$this->config->item('site_title', 'ion_auth');
					$this->data['explanation'] = substr($row->entry_body, 0, 200);
					$this->data['image']       = $row->entry_image;
					$this->data['keywords']    = $row->entry_tags;
				}

				$this->render('blog/post','public_master');
			}
		}
		else
			show_404();
	}
	
	public function category($slug = FALSE)
	{
		$this->data['title']      = 'Category - '.$this->config->item('site_title', 'ion_auth');
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->data['pagetitle']  = '';
		
		if( $slug == FALSE )
			show_404();
		else
		{
			$this->data['category'] = $this->blog_model->get_category(NULL,$slug); // get category details
			$this->data['query']    = $this->blog_model->get_category_post($slug); // get post in the category
		}
		
		$this->render('blog/category','public_master');
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */