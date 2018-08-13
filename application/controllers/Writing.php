<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');header('Access-Control-Allow-Origin: *');

class writing extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('writing_model');
		$this->load->model('blog_model');
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->output->set_header('Access-Control-Allow-Origin: *');
	}

	public function index()
	{
		// set page title
		$this->data['title']       = 'Stories - '.$this->config->item('site_title', 'ion_auth');
		// set current menu highlight
		$this->data['current']     = 'Stories';

		$this->data['explanation'] = "Fictions and fanfictions that I made.";

		$config                    = array();
		$config["base_url"]        = base_url() . "blog/index";
		$config["total_rows"]      = $this->writing_model->total_count();
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
		$this->data["posts"]       = $this->writing_model->get_stories($config["per_page"], $page);
		$this->data["total"]       = $this->writing_model->total_count();
		$this->render('writing/index','public_master');
	}
	
	public function ficrec()
	{
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$data["results"] = $this->writing_model->get_fic_rec();
        	echo json_encode($data["results"]);
	}

	
    public function writing($id = false)
    {

        $this->load->model('writing_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Writing';
        $this->data['query']      = $this->writing_model->get_story($id);

        $config                   = array();
        $config["base_url"]       = base_url() . "writing/manage_posts";
        $config["total_rows"]     = $this->writing_model->total_all_count();
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
        $this->data["categories"] = $this->writing_model->get_all_stories($config["per_page"], $page);

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('title', 'title', 'required|max_length[300]');
            $this->form_validation->set_rules('type', 'type', 'required|max_length[300]');
            $this->form_validation->set_rules('link1', 'link', 'required|max_length[300]');

            if ($this->form_validation->run() == FALSE) {

                $this->render('writing/writing', 'admin_master');
            }

            else {

                $title    = $this->input->post('title');
                $type     = $this->input->post('type');
                $genre    = $this->input->post('genre[]');
                $rating   = $this->input->post('rating');
                $fandom   = $this->input->post('fandom');
                $pairs    = $this->input->post('pairs');
                $summary  = $this->input->post('summary');
                $link1    = $this->input->post('link1');
                $link2    = $this->input->post('link2');
                $link3    = $this->input->post('link3');
                $status   = $this->input->post('status');
                $language = $this->input->post('language');
                $tweet    = $this->input->post('tweet');

                if ($id == false) {
                    $this->writing_model->add_new_story($title, $type, $genre, $rating, $fandom, $pairs, $summary, $link1, $link2, $link3, $status, $tweet);
                    $this->session->set_flashdata('message', $title.' Added');
                    redirect('writing/writing');
                } else {
                    $this->writing_model->update_story($id, $title, $type, $genre, $rating, $fandom, $pairs, $summary, $link1, $link2, $link3, $status, $tweet);
                    $this->session->set_flashdata('message', $title . ' Updated');
                    redirect('writing/writing');

                }
            }
        }
    }

    public function delete_story($id)
    {
        $this->load->model('writing_model');
        $this->writing_model->delete_writing($id);
        $this->session->set_flashdata('message', 'a story is deleted.');
        redirect('writing/writing');
    }

}