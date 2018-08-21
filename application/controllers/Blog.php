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

		$this->data['title']       = 'Blog';
		$this->data['pagetitle']   = 'Latest Blog Posts';
		$this->data['current']     = 'Blog';
		$this->data['explanation'] = 'Thoughts and rants about anything and everything.';
		$this->data['explanation_id'] = 'Catatan mengenai apa pun.';
		$this->render('blog/index','public_master');
    }
    
    public function get_posts($offset = 0) {
        
		$config                    = array();
		$config["base_url"]        = base_url() . "blog/get_posts";
		$config["total_rows"]      = $this->blog_model->total_count();
		$config["per_page"]        = 9;
		$config["uri_segment"]     = 3;
		$config['display_pages']   = FALSE;
		$config['next_link']       = '<span class="fa fa-chevron-right"></span>';
		$config['next_tag_open']   = '<span class="button big next">';
		$config['next_tag_close']  = '</span>';
		$config['prev_link']       = '<span class="fa fa-chevron-left"></span>';
		$config['prev_tag_open']   = '<span class="button big previous">';
		$config['prev_tag_close']  = '</span>';
		$config['last_link']       = '';
		$config['first_link']      = '';
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $data['posts'] = $this->blog_model->get_posts(9, $offset);
        echo json_encode($data);
    }

	public function add_new_entry()
    {
        $this->load->model('blog_model');
        $site_data  = $this->site_model->get_data();
        $site_title = '';
        foreach ($site_data as $site) {
            $site_title = $site->title;
        }
        $user               = $this->ion_auth->user()->row();
        $this->data['user'] = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['title']      = 'Add new entry - ' . $this->config->item('site_title', 'ion_auth');
            $this->data['categories'] = $this->blog_model->get_categories();
            $this->data['statuses']   = $this->site_model->get_data_statuses();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('entry_name', 'Title', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('blog/add_new_entry', 'admin_master');
            } else {

                $user       = $this->ion_auth->user()->row();
                $title      = $this->input->post('entry_name');
                $body       = $this->input->post('entry_body');
                $body_id    = $this->input->post('entry_body_id');
                $categories = $this->input->post('entry_category[]');
                $image      = $this->input->post('entry_image');
                $video      = $this->input->post('entry_video');
                $tags       = $this->input->post('entry_tags');
                $status     = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                $this->blog_model->add_new_entry($user->id, $title, $body, $body_id, $categories, $image, $video, $tags, $status, $tweet);
                $this->session->set_flashdata('message', $title.' Added');
                redirect('blog/add_new_entry');
            }
        }
    }

    public function delete_post($id)
    {

        $this->load->model('blog_model');
        $this->blog_model->delete_post($id);
        $this->session->set_flashdata('message', '1 post deleted');
        redirect('blog/manage_posts');
    }

    public function update_entry($id = '')
    {

        $this->load->model('blog_model');
        $this->data['page_title'] = 'Add Blog Entry | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['page_title'] = 'Edit entry - ' . $this->config->item('site_title', 'ion_auth');
            $this->data['query']      = $this->blog_model->get_post($id);
            $this->data['statuses'] = $this->site_model->get_data_statuses();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('entry_name', 'Title', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->render('blog/add_new_entry', 'admin_master');
            } else {

                $id     = $this->input->post('entry_id');
                $title  = $this->input->post('entry_name');
                $body   = $this->input->post('entry_body');
                $body_id    = $this->input->post('entry_body_id');
                $image  = $this->input->post('entry_image');
                $video  = $this->input->post('entry_video');
                $tags   = $this->input->post('entry_tags');
                $status = $this->input->post('status');
                $tweet  = $this->input->post('tweet');

                $this->blog_model->update_entry($id, $title, $body, $update_id, $image, $video, $tags, $status, $tweet);
                $this->session->set_flashdata('message', $title.' updated');
                redirect('blog/update_entry/'.$id);
            }
        }
    }

    public function manage_posts($offset = 0)
    {

        $this->load->model('blog_model');
        $this->data['page_title'] = 'Manage Blog Entries | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $config                   = array();
            $config["base_url"]       = base_url() . "blog/manage_posts";
            $config["total_rows"]     = $this->blog_model->total_all_count();
            $config["per_page"]       = 10;
            $config["uri_segment"]    = 3;
            $config['display_pages']  = TRUE;
            $config['cur_tag_open']   ='<li class="active">';
            $config['cur_tag_close']  = '</li>';
            $config['num_tag_open']   = '<li class="waves-effect">';
            $config['num_tag_close']  = '</li>';
            $config['next_link']      = '<i class="material-icons">chevron_right</i>';
            $config['next_tag_open']  = '<li class="waves-effect">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link']      = '<i class="material-icons">chevron_left</i>';
            $config['prev_tag_open']  = '<li class="waves-effect">';
            $config['prev_tag_close'] = '</li>';
            $config['last_link']      = '';
            $config['first_link']     = '';
            $this->pagination->initialize($config);
            $this->data['paginglinks'] = $this->pagination->create_links();

            $page                = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $this->data["posts"] = $this->blog_model->get_all_posts($config["per_page"], $page);
            $this->render('blog/manage_posts', 'admin_master');
        }
    }
	
	public function post($id, $private = "")
	{
		$this->data['post_id']    = $id;
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->data['pagetitle']  = '';
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->load->helper('form');
		$this->load->library(array('form_validation'));
		
        $this->data['query'] = $this->blog_model->get_post_short($id);

		if($this->data['query'])
		{
			if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
				show_404();
			else if($this->data['query'][0]->status == 4) show_404();
			else if($this->data['query'][0]->status != 3) show_404();
			else {
				foreach($this->data['query'] as $row)
				{
					$this->data['title']       = ($row->entry_name != "" ? $row->entry_name : $row->entry_name_id).' - '.$this->config->item('site_title', 'ion_auth');
					$this->data['explanation'] = ($row->entry_body != "" ? $row->entry_body : $row->entry_body_id);
					$this->data['image']       = $row->entry_image;
					$this->data['keywords']    = $row->entry_tags;
				}

				$this->render('blog/post','public_master');
			}
		}
		else
			show_404();
    }
    
    public function get_post($id) {
        $data['cat'] = $this->blog_model->get_related_categories($id);
        $data['post'] = $this->blog_model->get_post($id);
        echo json_encode($data);
    }
	
	public function category($slug = FALSE)
	{
		$this->data['title']      = 'Blog Categories';
		$this->data['pagetitle']  = '';
		
		if( $slug == FALSE )
			show_404();
		else
		    $this->render('blog/category','public_master');
    }
    
    public function get_category_posts($slug) {
        $data['category'] = $this->blog_model->get_category(NULL,$slug);
        $data['query']    = $this->blog_model->get_category_post($slug);
        echo json_encode($data);
    }

	public function add_new_category($id = "")
    {

        $this->load->model('blog_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add New Category | Hello Little Red';
        $this->data['categories'] = $this->blog_model->get_categories();

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('category_name', 'Name', 'required|max_length[200]');
            $this->form_validation->set_rules('category_slug', 'Slug', 'max_length[200]');

            if ($this->form_validation->run() == FALSE) {
                if($id != "") {
                    $this->data['query'] = $this->blog_model->get_category($id, NULL);
                }
                $this->render('blog/add_new_category', 'admin_master');
            } else {

                $name = $this->input->post('category_name');

                if ($this->input->post('category_slug') != '')
                    $slug = $this->input->post('category_slug');
                else
                    $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

                if($id != "") {
                    $this->blog_model->update_category($id, $name, $slug);
                    $this->session->set_flashdata('message', $name.' Updated!');
                } else {
                    $this->blog_model->add_new_category($name, $slug);
                    $this->session->set_flashdata('message', $name.' Added');
                }
                redirect('blog/add-new-category');
            }
        }
    }

    public function delete_category($id)
    {
        $this->load->model('blog_model');
        $this->blog_model->delete_category($id);
        $this->session->set_flashdata('message', '1 category deleted');
        redirect('blog/add_new_category');
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */