<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (APPPATH . 'core/MY_Controller.php');

class projects extends MY_Controller

{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}

	function index()
	{
		$this->data['title']       = 'Projects - ' . $this->config->item('site_title', 'ion_auth');
		$this->data['projects']    = $this->projects_model->get_projects();
		$this->render('projects/index', 'public_master');
	}

	public function projects($id = false)
    {

        $this->load->model('projects_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Projects';
        $this->data['categories'] = $this->projects_model->get_all_projects();
        $this->data['query']     = $this->projects_model->get_project($id);
        $this->data['status'] = "add";

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

                $this->render('projects/projects', 'admin_master');
            } else {

                $name    = $this->input->post('name');
                $image   = $this->input->post('img');
                $exp     = $this->input->post('exp');
                $link    = $this->input->post('link');
                $behance = $this->input->post('behance');
                $status  = $this->input->post('status');
                $tweet   = $this->input->post('tweet');
                if ($id == false) {
                    $this->projects_model->add_new_project($name,$image,$exp,$link, $behance, $status, $tweet);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('projects/projects');
                } else {
                    $this->data['status'] = "edit";;
                    $this->projects_model->update_project($id,$name,$image,$exp,$link, $behance, $status, $tweet);
                    $this->session->set_flashdata('message', $name . ' Updated');
                    redirect('projects/projects');

                }
            }
        }
    }

    public function delete_project($id)
    {

        $this->load->model('projects_model');
        $this->projects_model->delete_project($id);
        $this->session->set_flashdata('message', 'a project is deleted.');
        redirect('projects/projects');
    }


}
