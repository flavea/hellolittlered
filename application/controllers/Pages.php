<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages extends MY_Controller {
    protected $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
        $this->load->model('look_model');
        $this->load->model('site_model');
		$this->load->library('ion_auth');
        $this->load->helper("url");
		$this->data['pagetitle'] = '';
	}

	public function index($offset = 0)
	{
		// set page title
		$this->data['title'] = 'Pages - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = 'All Pages';
		// set current menu highlight
		$this->data['current'] = 'About';
		// get all post
		// get all categories for sidebar menu
		$this->data['categories'] = $this->page_model->get_pages();
		
		$this->render('blog/pages','public_master');
	}

	
	
	
	public function page($slug) // get a post based on id
	{
		$this->data['query'] 			= $this->page_model->get_page($slug);
		$this->data['pagetitle'] = '';
		$this->data['title'] = $slug." - Hello Little Red";
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row(); // get current user login details
		
		
		if($this->page_model->get_page($slug))
		{
			$this->render('blog/page','public_master');
		}
		else
			show_404();
	}
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */