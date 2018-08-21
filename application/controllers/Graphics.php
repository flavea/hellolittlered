<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class graphics extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('photo_model');
		$this->load->model('social_model');
	}

	function index()
	{
		$this->data['title']       = 'Graphics - ' . $this->config->item('site_title', 'ion_auth');
		
		$this->data['current']     = 'Graphics';
		$this->data['explanation'] = 'Graphics I made for various things. Just for memories, because I suck at this.';
		
        $this->data['explanation_id'] = 'Poster, edit, dll.';
		$this->data['results']     = $this->social_model->get_tumblr_posts(9, "gyuseu", "gfx");
		$this->data['seconds']     = $this->social_model->get_tumblr_posts(6, "slayein", false);

		$this->render('graphics/index', 'public_master');
	}

	public function design($id = false)
    {
        $this->load->model('store_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Store';
        $this->data['query']      = $this->store_model->get_design($id);
        $config                   = array();
        $config["base_url"]       = base_url() . "graphics/designs/index";
        $config["total_rows"]     = $this->store_model->total_all_count();
        $config["per_page"]       = 15;
        $config["uri_segment"]    = 3;
        $config['display_pages']  = TRUE;
        $config['cur_tag_open'] ='<li class="active">';
        $config['cur_tag_close'] = '</li>';
        $config['num_tag_open']  = '<li class="waves-effect">';
        $config['num_tag_close'] = '</li>';
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
        $this->data["categories"] =$this->store_model->get_all_designs($config["per_page"], $page);;

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_graphics()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');
            $this->form_validation->set_rules('image', 'Image', 'required|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->render('graphics/design', 'graphics_master');
            } else {
                $name      = $this->input->post('name');
                $image     = $this->input->post('image');
                $redbubble = $this->input->post('redbubble');
                $tees      = $this->input->post('tees');
                $status    = $this->input->post('status');
                $tweet      = $this->input->post('tweet');
                if ($id == false) {
                    $this->store_model->add_new_design($name, $image, $redbubble, $tees, $status, $tweet);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('graphics/design');
                } else {
                    $this->store_model->update_design($id, $name, $image, $redbubble, $tees, $status, $tweet);
                    $this->session->set_flashdata('message', $name . ' Updated');
                    redirect('graphics/design');

                }
            }
        }
    }

    public function delete_design($id)
    {
        $this->load->model('store_model');
        $this->store_model->delete_design($id);
        $this->session->set_flashdata('message', 'a store item is deleted.');
        redirect('graphics/design');
    }


}
