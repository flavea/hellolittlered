<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resource extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('resources_model');
		$this->data['explanation'] = 'Graphic resources that I made. Feel free to use.';
        $this->data['explanation_id'] = 'Bahan GFX.';
	}

	public function index()
	{
		$this->data['title']       = 'Resources - '.$this->config->item('site_title', 'ion_auth');
		$this->data['current']     = 'Resources';
		$this->data['posts']       = $this->resources_model->get_resources();
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
        $this->data["file"] = "resource/index";
        $this->render($this->data["file"], 'public_master');
    }
	
	public function type($slug = FALSE)
	{
		$this->data['title']      = $slug.' - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle']  = $slug;
		$this->data['categories'] = $this->resources_model->get_type(NULL,$slug);

		$this->data['current'] = 'Resources/'.$slug;
		
		if( $slug == FALSE )
			redirect(resource);
		else { 
            $this->data["file"] = "resource/index";
            $this->render($this->data["file"], 'public_master');
        }
    }
    
    public function get_resources_by_slug($slug = FALSE)
	{
		if( $slug == FALSE )
			$data = array();
		else
            $data   = $this->resources_model->get_category_resource($slug);
        echo json_encode($data);
	}
    
    public function get_resource($id = FALSE)
	{
		if( $id == FALSE )
			$data = array();
		else
            $data   = $this->resources_model->get_resource($id);
        echo json_encode($data);
	}

	public function form_resource()
    {
        $this->data['title'] = 'form resource';
        $this->data['current'] = $this->data['title'];
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "resource/form_resource";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    /*
    ==================================================
    |             Resources Management               |
    ==================================================
    */

    public function add_resource() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $user       = $this->ion_auth->user()->row();
            $name       = $this->input->post('resource_name');
            $categories = $this->input->post('resource_category');
            $preview    = $this->input->post('resource_preview');
            $download   = $this->input->post('resource_download');
            $status     = $this->input->post('status');
            $tweet      = $this->input->post('tweet');

            $this->resources_model->add_new_resource($user->id, $name, $preview, $download, $categories, $status, $tweet);
            $data['status'] = "success";
            $data['message'] = $name.' added!';
            $data['message_id'] = $name.' ditambahkan!';
            echo json_encode($data);
        }
    }

    public function update_resource($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $user       = $this->ion_auth->user()->row();
            $name       = $this->input->post('resource_name');
            $categories = $this->input->post('resource_category');
            $preview    = $this->input->post('resource_preview');
            $download   = $this->input->post('resource_download');
            $status     = $this->input->post('status');
            $tweet      = $this->input->post('tweet');

            $this->resources_model->update_resource($id, $name, $preview, $download, $categories, $status, $tweet);
            $data['status'] = "success";
            $data['message'] = $name.' updated!';
            $data['message_id'] = $name.' diperbaharui!';
            echo json_encode($data);
        }
    }

    public function delete_resource($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->resources_model->delete_resource($id);
            $data['status'] = "success";
            $data['message'] = 'Resource deleted!';
            $data['message_id'] = 'Resource dihapus';
            echo json_encode($data);
        }
    }

    public function manage_resources()
    {
        $this->data['current'] = 'Manage Resources';
        $this->data['title'] = 'Manage Resources | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "resource/manage_resources";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function get_resources()
    {
        $data = $this->resources_model->get_all_resources();
        echo json_encode($data);
    }

    /*
    ==================================================
    |             Resources Categories               |
    ==================================================
    */

    public function manage_category($id = "")
    {
        $this->data['current'] = 'Manage Category';
        $this->data['title'] = 'Manage Categories | Hello Little Red';

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->data["file"] = "resource/manage_category";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function add_category() {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $name = $this->input->post('category_name');

            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

            $this->resources_model->add_new_type($name, $slug);
            $data['status'] = "success";
            $data['message'] = $name.' added!';
            $data['message_id'] = $name.' ditambahkan!';
            echo json_encode($data);
        }
    }
    public function update_category($id) {
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $name = $this->input->post('category_name');

            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

            $this->resources_model->update_type($id, $name, $slug);
            $data['status'] = "success";
            $data['message'] = $name.' updated!';
            $data['message_id'] = $name.' diperbaharui!';
            echo json_encode($data);
        }
    }

    public function delete_resource_category($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->resources_model->delete_type($id);
            $data['status'] = "success";
            $data['message'] = 'Type deleted!';
            $data['message_id'] = 'Type dihapus!';
            echo json_encode($data);
        }
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */