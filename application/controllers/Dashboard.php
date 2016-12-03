<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller
{
	function __construct()
        {
            parent::__construct();
            $this->load->library('ion_auth');
            if($this->ion_auth->is_admin()===FALSE)
        {
            redirect('/');
        }
    }

    public function index()
    {
        redirect('admin/Dashboard');
    }


}