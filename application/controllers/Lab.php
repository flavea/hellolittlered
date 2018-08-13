<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class lab extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}

	function index()
	{
		$this->data['title']       = 'Experiments - ' . $this->config->item('site_title', 'ion_auth');
		$this->data['current']     = 'Experiments';
		$this->data['explanation'] = 'My experiments in various programming language.';
		$this->data['posts']    = $this->projects_model->get_experiments();

		$this->render('lab/index', 'public_master');
	}

	
    public function lab($id = false)
    {

        $this->load->model('projects_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Lab';
        $this->data['categories'] = $this->projects_model->get_all_experiments();
        $this->data['query']      = $this->projects_model->get_experiment($id);
        $this->data['status']     = "add";

        if($id != false) {
            $this->data['status'] = "edit";
        }


        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->render('lab/lab', 'admin_master');
            } else {

                $name        = $this->input->post('name');
                $image       = $this->input->post('image');
                $code        = $this->input->post('code');
                $link        = $this->input->post('link');
                $description = $this->input->post('exp');
                $status      = $this->input->post('status');
                $tweet       = $this->input->post('tweet');
                if ($id == false) {
                    $this->projects_model->add_new_experiment($name, $image, $link, $code, $description, $status, $tweet);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('lab/lab');
                } else {
                    $this->data['status'] = "edit";
                    $this->projects_model->update_experiment($id, $name, $image, $link, $code, $description, $status, $tweet);
                    $this->session->set_flashdata('message', $name . ' Updated');
                    redirect('lab/lab');

                }
            }
        }
    }

    public function delete_experiment($id)
    {
        $this->load->model('projects_model');
        $this->projects_model->delete_experiment($id);
        $this->session->set_flashdata('message', 'an experiment is deleted.');
        redirect('lab/projects');
    }

}
