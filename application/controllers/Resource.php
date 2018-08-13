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
		$this->render('resource/index','public_master');
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
		
		$this->render('resource/index','public_master');
	}

	public function add_new_resource()
    {

        $this->load->model('resources_model');
        $this->data['page_title'] = 'Add Resource | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['categories'] = $this->resources_model->get_types();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));


            $this->form_validation->set_rules('resource_name', 'Title', 'required');
            $this->form_validation->set_rules('resource_download', 'Download Link', 'required');
            $this->form_validation->set_rules('resource_preview', 'Preview', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('resource/add_new_resource', 'admin_master');
            } else {

                $user       = $this->ion_auth->user()->row();
                $name       = $this->input->post('resource_name');
                $body       = $this->input->post('resource_body');
                $categories = $this->input->post('resource_category');
                $preview    = $this->input->post('resource_preview');
                $download   = $this->input->post('resource_download');
                $status     = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                $this->resources_model->add_new_resource($user->id, $name, $preview, $download, $categories, $status, $tweet);
                $this->session->set_flashdata('message', $name.' Added');
                redirect('resource/add_new_resource');
            }
        }
    }

    public function update_resource($id = '')
    {

        $this->load->model('resources_model');
        $this->data['page_title'] = 'Add Resource | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['categories'] = $this->resources_model->get_types();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));


            $this->form_validation->set_rules('resource_name', 'Title', 'required');
            $this->form_validation->set_rules('resource_download', 'Download Link', 'required');
            $this->form_validation->set_rules('resource_preview', 'Preview', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->data['query']      = $this->resources_model->get_resource($id);
                $this->render('resource/add_new_resource', 'admin_master');
            } else {

                $user       = $this->ion_auth->user()->row();
                $id         = $this->input->post('resource_id');
                $name       = $this->input->post('resource_name');
                $body       = $this->input->post('resource_body');
                $categories = $this->input->post('resource_category');
                $preview    = $this->input->post('resource_preview');
                $download   = $this->input->post('resource_download');
                $status     = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                $this->resources_model->update_resource($id, $name, $preview, $download, $categories, $status, $tweet);
                $this->session->set_flashdata('message', $name.' Updated!');
                redirect('resource/update_resource/'.$id);
            }
        }
    }

    public function delete_resource($id)
    {

        $this->load->model('resources_model');
        $this->resources_model->delete_resource($id);
        $this->session->set_flashdata('message', '1 Resource Deleted!');
        redirect('resource/manage_resources');
    }

    public function manage_resources()
    {
        $this->load->model('resources_model');
        $this->data['page_title'] = 'Manage Resources | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['posts'] = $this->resources_model->get_all_resources();
            $this->render('resource/manage_resources', 'admin_master');
        }
    }

    /*
    ==================================================
    |             Resources Categories               |
    ==================================================
    */

    public function add_new_resource_type($id = "")
    {

        $this->load->model('resources_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add New Category | Hello Little Red';
        $this->data['categories'] = $this->resources_model->get_types();

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

                if($id != "") $this->data['query'] = $this->resources_model->get_type($id, NULL);
                $this->render('resource/add_new_resource_category', 'admin_master');
            } else {

                $name = $this->input->post('category_name');

                if ($this->input->post('category_slug') != '')
                    $slug = $this->input->post('category_slug');
                else
                    $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

                if($id != "") {
                    $this->resources_model->update_type($id, $name, $slug);
                    $this->session->set_flashdata('message', $name.' updated!');
                } else {
                    $this->resources_model->add_new_type($name, $slug);
                    $this->session->set_flashdata('message', $name.' Added');
                }
                redirect('resource/add-new-resource-type');
            }
        }
    }

    public function delete_resource_category($id)
    {

        $this->load->model('resources_model');
        $this->resources_model->delete_type($id);
        $this->session->set_flashdata('message', 'a category is deleted.');
        redirect('resource/add_new_resource_type');
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */