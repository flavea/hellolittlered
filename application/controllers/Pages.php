<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages extends MY_Controller {
    protected $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('page_model');
		$this->data['categories']  = $this->blog_model->get_categories();
	}

	public function index()
	{
		$this->data['title']      = 'Pages - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle']  = 'All Pages';
		$this->data['current']    = 'pages';
		$this->data['categories'] = $this->page_model->get_pages();
		$this->render('pages/index','public_master');
	}
	
	public function page($slug, $private = false)
	{
		$this->data['query']     = $this->page_model->get_page($slug);
		$this->data['pagetitle'] = '';
		$this->data['title']     = $slug." - Hello Little Red";
		$this->data['current']   = "";
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row(); 
		
		if($this->data['query'])
		{	
			if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
				show_404();
			else if($this->data['query'][0]->status == 4) show_404();
			else if($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in()) show_404();
			else {
				foreach ($this->data['query'] as $row) {
					$this->data['title']       = $row->page_title;
					$this->data['explanation'] = substr($row->page_body, 0, 200);
					$this->data['image']       = '';
				}
				$this->render('pages/page','public_master');
			}
		}
		else
			show_404();
	}

	public function add_new_page()
    {

        $this->load->model('page_model');
        $this->data['page_title'] = 'Add New Page | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['title'] = 'Add new entry - ' . $this->config->item('site_title', 'ion_auth');

            $this->data['statuses'] = $this->site_model->get_data_statuses();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));


            $this->form_validation->set_rules('page_name', 'Title', 'required');
            $this->form_validation->set_rules('page_body', 'Content', 'required');
            $this->form_validation->set_rules('page_slug', 'Slug', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('pages/add_new_page', 'admin_master');
            } else {

                $user   = $this->ion_auth->user()->row();
                $title  = $this->input->post('page_name');
                $body   = $this->input->post('page_body');
                $slug   = $this->input->post('page_slug');
                $status = $this->input->post('status');
                $tweet  = $this->input->post('tweet');

                $this->page_model->add_new_page($user->id, $title, $body, $slug, $status, $tweet);
                $this->session->set_flashdata('message', $title.' Added');
                redirect('pages/add_new_page');
            }
        }
    }

    public function manage_pages()
    {

        $this->load->model('page_model');
        $this->data['page_title'] = 'Manage Pages | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['posts'] = $this->page_model->get_all_pages();
            $this->render('pages/manage_pages', 'admin_master');
        }
    }

    public function delete_page($id)
    {

        $this->load->model('page_model');
        $this->page_model->delete_page($id);
        $this->session->set_flashdata('message', '1 Page Deleted!');
        redirect('pages/manage_pages');
    }


    public function update_page($id = '')
    {
        $this->load->model('page_model');
        $this->data['page_title'] = 'Edit Page | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));
            $this->data['query'] = $this->page_model->get_page_by_id($id);
            $this->data['statuses'] = $this->site_model->get_data_statuses();


            $this->form_validation->set_rules('page_name', 'Title', 'required');
            $this->form_validation->set_rules('page_body', 'Content', 'required');
            $this->form_validation->set_rules('page_slug', 'Slug', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('pages/add_new_page', 'admin_master');
            } else {

                $id     = $this->input->post('page_id');
                $title  = $this->input->post('page_name');
                $body   = $this->input->post('page_body');
                $slug   = $this->input->post('page_slug');
                $status = $this->input->post('status');
                $tweet  = $this->input->post('tweet');

                $this->page_model->update_page($id, $title, $body, $slug, $status, $tweet);
                $this->session->set_flashdata('message', $title.' Updated!');
                redirect('pages/update_page/'.$id);
            }
        }
    }
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */