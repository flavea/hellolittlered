<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class themes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('themes_model');
		$this->data['explanation'] = 'Free themes.';
        $this->data['paginglinks'] = '';
	}

	public function index()
	{
		$this->data['title'] = 'Themes - '.$this->config->item('site_title', 'ion_auth');
		$this->data['current'] = 'themes';
		$this->data['explanation'] = 'Free themes and templates that I made for various platforms.<br>';

		$this->data['categories'] = $this->themes_model->get_categories();
		$config["base_url"] = base_url() . "themes/index";
		$config["total_rows"] = $this->themes_model->total_count();
		$config["per_page"] = 9;
		$config["uri_segment"] = 3;
		$config['display_pages'] = FALSE;
		$config['next_link']       = '<span class="fa fa-chevron-right"></span>';
		$config['next_tag_open']   = '<span class="button big next">';
		$config['next_tag_close']  = '</span>';
		$config['prev_link']       = '<span class="fa fa-chevron-left"></span>';
		$config['prev_tag_open']   = '<span class="button big previous">';
		$config['prev_tag_close']  = '</span>';
		$config['last_link'] = '';
		$config['first_link'] = '';
		$this->pagination->initialize($config);
		$this->data['paginglinks'] = $this->pagination->create_links();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["posts"] = $this->themes_model->
		get_themes($config["per_page"], $page);
		$this->render('themes/index','public_master');
	}

	public function shorten_string($string, $wordsreturned)
	{
		$retval = $string;
		$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
		$string = str_replace("\n", " ", $string);
		$array = explode(" ", $string);
		if (count($array)<=$wordsreturned)
		{
			$retval = $string;
		}
		else
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}
	
	
	public function theme($id, $preview='', $private = false) // get a post based on id
	{
		$this->data['pagetitle']  = '';
		$this->data['query']      = $this->themes_model->get_theme($id);
		$this->data['theme_id']   = $id;
		$this->data['categories'] = $this->themes_model->get_categories();
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row(); // get current user login details
		
		$this->load->helper('form');
		$this->load->library(array('form_validation'));
		

		
		if($preview=='') {
			if($this->themes_model->get_theme($id))
			{
				if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
					show_404();
				else if($this->data['query'][0]->status == 4) show_404();
				else if($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in()) show_404();
				else {
					foreach($this->data['query'] as $row)
					{
						$this->data['title']       = $row->theme_name.' - '.$this->config->item('site_title', 'ion_auth');
						$this->data['explanation'] = substr($row->theme_body, 0, 200);
						$this->data['image']       = $row->theme_image;


					}

					$this->render('themes/theme','public_master');
				}
			}
		} else if($preview=="preview") {
			$this->render('themes/theme_preview', 'preview_master');
		} else {
			show_404();
		}
	}
	
	public function type($slug = FALSE)
	{
		$this->data['title'] = $slug.' - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = $slug;
		$this->data['categories'] = $this->themes_model->get_categories();
		$this->data['current'] = 'themes/'.$slug;

		if( $slug == FALSE )
			redirect(themes);
		else
		{
			$this->data['category'] = $this->themes_model->get_category(NULL,$slug);
			$this->data["posts"] = $this->themes_model->get_category_theme($slug);
		}
		
		$this->render('themes/index','public_master');
	}

	public function add_new_theme()
    {
        $this->data['page_title'] = 'Add Theme | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['categories'] = $this->themes_model->get_categories();
            $this->data['statuses']   = $this->site_model->get_data_statuses();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));


            $this->form_validation->set_rules('theme_name', 'Title', 'required');
            $this->form_validation->set_rules('theme_image', 'Image', 'required');
            $this->form_validation->set_rules('theme_code', 'Code', 'required');
            $this->form_validation->set_rules('theme_preview', 'Preview', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('themes/add_new_theme', 'admin_master');
            } else {

                $user       = $this->ion_auth->user()->row();
                $name       = $this->input->post('theme_name');
                $body       = $this->input->post('theme_body');
                $categories = $this->input->post('theme_category[]');
                $image      = $this->input->post('theme_image');
                $preview    = $this->input->post('theme_preview');
                $code       = $this->input->post('theme_code');
                $status     = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                $this->themes_model->add_new_theme($user->id, $name, $image, $preview, $code, $body, $categories, $status, $tweet);
                $this->session->set_flashdata('message', $name.' Added');
                redirect('themes/add_new_theme');
            }
        }
    }

    public function delete_theme($id)
    {

        $this->themes_model->delete_theme($id);
        $this->session->set_flashdata('message', '1 theme Deleted!');
        redirect('themes/manage_themes');
    }

    public function update_theme($id = '')
    {
        $this->data['page_title'] = 'Edit Theme | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data['query'] = $this->themes_model->get_theme($id);
            $this->data['statuses'] = $this->site_model->get_data_statuses();

            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));


            $this->form_validation->set_rules('theme_name', 'Title', 'required');
            $this->form_validation->set_rules('theme_image', 'Image', 'required');
            $this->form_validation->set_rules('theme_code', 'Code', 'required');
            $this->form_validation->set_rules('theme_preview', 'Preview', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('themes/add_new_theme', 'admin_master');
            } else {

                $id         = $this->input->post('theme_id');
                $name       = $this->input->post('theme_name');
                $body       = $this->input->post('theme_body');
                $categories = $this->input->post('theme_category[]');
                $image      = $this->input->post('theme_image');
                $preview    = $this->input->post('theme_preview');
                $code       = $this->input->post('theme_code');
                $status     = $this->input->post('status');
                $tweet      = $this->input->post('tweet');

                $this->themes_model->update_theme($id, $name, $image, $preview, $code, $body, $status, $tweet);
                $this->session->set_flashdata('message', $name.' updated');
                redirect('themes/update_theme/'.$id);
            }
        }
    }

    public function manage_themes($slug = "")
    {
        $this->data['page_title'] = 'Manage Blog Entries | Hello Little Red';
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['PgNm']       = "";
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $config["per_page"]        = 15;
            $config["uri_segment"]     = 3;
            $config['display_pages']   = TRUE;
            $config['cur_tag_open']    ='<li class="active">';
            $config['cur_tag_close']   = '</li>';
            $config['num_tag_open']    = '<li class="waves-effect">';
            $config['num_tag_close']   = '</li>';
            $config['next_link']       = '<i class="material-icons">chevron_right</i>';
            $config['next_tag_open']   = '<li class="waves-effect">';
            $config['next_tag_close']  = '</li>';
            $config['prev_link']       = '<i class="material-icons">chevron_left</i>';
            $config['prev_tag_open']   = '<li class="waves-effect">';
            $config['prev_tag_close']  = '</li>';
            $config['last_link']       = '';
            $config['first_link']      = '';

            if($slug == "") {
                $this->data["PgNm"]        = "All";
                $config["base_url"]        = base_url() . "themes/manage_themes";
                $config["total_rows"]      = $this->themes_model->total_all_count();
                $this->pagination->initialize($config);
                $this->data['paginglinks'] = $this->pagination->create_links();

                $page                      = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $this->data["posts"]       = $this->themes_model->get_all_themes($config["per_page"], $page);
            } else {
                $this->data["PgNm"]        = $slug;
                $config["base_url"]        = base_url() . "themes/manage_themes/".$slug;
                $config["total_rows"]      = $this->themes_model->total_count_all_slug($slug);
                $this->pagination->initialize($config);
                $this->data['paginglinks'] = $this->pagination->create_links();
                $page                      = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $this->data["posts"]       = $this->themes_model->get_all_category_theme($slug, $config["per_page"], $page);
            }
            $this->data['categories'] = $this->themes_model->get_categories();
            $this->render('themes/manage_themes', 'admin_master');
        }
    }

    public function add_new_theme_category($id = "")
    {

        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add New Category | Hello Little Red';
        $this->data['categories'] = $this->themes_model->get_categories();

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
                if($id != "") $this->data['query'] = $this->themes_model->get_category($id, NULL);
                $this->render('themes/add_new_theme_category', 'admin_master');
            } else {

                $name = $this->input->post('category_name');

                if ($this->input->post('category_slug') != '')
                    $slug = $this->input->post('category_slug');
                else
                    $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

                if($id != "") {
                    $this->themes_model->update_category($id, $name, $slug);
                    $this->session->set_flashdata('message', $name.' updated!');

                } else {
                    $this->themes_model->add_new_category($name, $slug);
                    $this->session->set_flashdata('message', $name.' Added');
                }
                redirect('themes/add-new-theme-category');
            }
        }
    }

    public function delete_theme_category($id)
    {
        $this->themes_model->delete_category($id);
        $this->session->set_flashdata('message', 'a category is deleted.');
        redirect('themes/add_new_theme_category');
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */