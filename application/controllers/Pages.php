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
		$this->data['current'] = '';
		$this->data['explanation'] = '';
		$this->data['image'] = '';
        $this->data['keywords'] = '';
	}

	public function index($offset = 0)
	{
		$this->data['title'] = 'Pages - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = 'All Pages';
		$this->data['current'] = 'pages';
		$this->data['categories'] = $this->page_model->get_pages();
		
		$this->render('blog/pages','public_master');
	}

	
	
	
	public function page($slug)
	{
		$this->data['query'] = $this->page_model->get_page($slug);
		$this->data['pagetitle'] = '';
		$this->data['title'] = $slug." - Hello Little Red";
		$this->data['current'] = "";
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row(); 
		
		if($this->data['query'])
		{
			foreach ($this->data['query'] as $row) {
				$this->data['title'] = $row->page_title;
				$this->data['explanation'] = substr($row->page_body, 1, 200);
				$this->data['image'] = '';
			}
			$this->render('blog/page','public_master');
		}
		else
			show_404();
	}
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */