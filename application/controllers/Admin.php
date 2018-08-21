<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH . 'core/MY_Controller.php');

class Admin extends MY_Controller
{
    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('themes_model');
        $this->load->library('form_validation');
        $user                            = $this->ion_auth->user()->row();
        $this->data['user']              = $user;
        $this->data['query']             = '';
        $site_data                       = $this->site_model->get_data();
        $this->data['site_data']         = $site_data;
        $this->data['updates']           = $this->site_model->get_statuses();
        $this->data['statuses']          = $this->site_model->get_data_statuses();
        $this->data['theme_categories']  = $this->themes_model->get_categories();
        $this->data['commissions_count'] = $this->site_model->get_commissions_count();
        $this->data['q_count']           = $this->site_model->get_questions_count();
        $this->data['emails_count']      = $this->site_model->get_emails_count();
        $this->data['friends_count']     = $this->site_model->get_friends_count();
        $site_title                      = '';
        if(!isset($_SESSION['gravatar']) || $_SESSION['gravatar'] != "") $_SESSION['gravatar'] = md5(strtolower(trim('youareabsurd@yahoo.com')));
        foreach ($site_data as $site) {
            $site_title = $site->title;
        }
    }

    /*
    ==================================================
    |                  Basic Options                 |
    ==================================================
    */

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        } else {
            redirect('admin/dashboard');
        }
    }

    public function login()
    {

        $site_data  = $this->site_model->get_data();
        $site_title = '';
        foreach ($site_data as $site) {
            $site_title = $site->title;
        }
        $this->data['page_title'] = 'Admin Login | ' . $site_title;
        if (!$this->ion_auth->logged_in()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() === FALSE) {
                if ($this->input->post('ajax')) {
                    $response['username_error'] = form_error('username');
                    $response['password_error'] = form_error('password');
                    header("content-type:application/json");
                    echo json_encode($response);
                    exit;
                }
                $this->load->helper('form');
                $this->render('admin/login_view', 'admin_master');
            } else {
                $remember = (bool) $this->input->post('remember');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $this->ion_auth->set_hook('post_login_successful', 'get_gravatar_hash', $this, '_gravatar', array());

                if ($this->ion_auth->login($username, $password, $remember)) {
                    if ($this->input->post('ajax')) {
                        $response['logged_in'] = 1;
                        header("content-type:application/json");
                        echo json_encode($response);
                        exit;
                    }
                    redirect('admin/dashboard', 'admin_master');
                } else {
                    if ($this->input->post('ajax')) {
                        $response['username'] = $username;
                        $response['password'] = $password;
                        $response['error']    = $this->ion_auth->errors();
                        header("content-type:application/json");
                        echo json_encode($response);
                        exit;
                    }
                    $_SESSION['auth_message'] = $this->ion_auth->errors();
                    $this->session->mark_as_flash('auth_message');
                    redirect('admin/login', 'admin_master');
                }
            }
        } else {
            redirect('admin/dashboard');

        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('admin/login', 'refresh');
    }

    public function _gravatar()
    {
        if ($this->form_validation->valid_email($_SESSION['email'])) {
            $gravatar_url         = md5(strtolower(trim($_SESSION['email'])));
            $_SESSION['gravatar'] = $gravatar_url;
        }
        return TRUE;
    }

    public function tweet()
    {

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('tweet', 'tweet', 'required');

            $tweet = $this->input->post('tweet');

            $this->load->model('social_model');
            $this->social_model->post_tweet($tweet);
            redirect("admin/dashboard");
        }
    }

    public function dashboard()
    {

        $site_data  = $this->site_model->get_data();
        $site_title = '';
        foreach ($site_data as $site) {
            $site_title = $site->title;
        }
        $this->data['page_title'] = 'Admin dashboard | ' . $site_title;
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/login');
        }

        $this->form_validation->set_rules('title', 'title', 'trim');
        if ($this->form_validation->run() === FALSE) {
            $this->render('admin/dashboard_view', 'admin_master');
        } else {
            $title       = $this->input->post('title');
            $description = $this->input->post('description');
            $description_id = $this->input->post('description_id');
            $keywords    = $this->input->post('keywords');

            $this->site_model->update_data($title, $description, $description_id, $keywords);
            $this->session->set_flashdata('message', 'Site data updated!');
            redirect('admin/dashboard');
        }
    }

    public function profile()
    {
        $site_data  = $this->site_model->get_data();
        $site_title = '';
        foreach ($site_data as $site) {
            $site_title = $site->title;
        }
        $this->data['page_title'] = 'Edit Profile | ' . $site_title;
        if (!$this->ion_auth->logged_in()) {
            redirect('admin');
        }
        $this->data['page_title']        = 'User Profile';
        $user                            = $this->ion_auth->user()->row();
        $this->data['user']              = $user;
        $this->data['current_user_menu'] = '';

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->render('admin/profile_view', 'admin_master');
        } else {
            $new_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'company'    => $this->input->post('company'),
                'phone'      => $this->input->post('phone')
                );
            if (strlen($this->input->post('password')) >= 6)
                $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user->id, $new_data);

            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('admin/profile', 'refresh');
        }
    }

    public function sidebar($id = false)
    {

        $this->load->model('look_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add Sidebar | Hello Little Red';
        $this->data['categories'] = $this->look_model->get_all_sidebars();
        $this->data['query']      = $this->look_model->get_sidebar($id);

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('name', 'name', 'required|max_length[200]');
            $this->form_validation->set_rules('content', 'content', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->render('admin/sidebar', 'admin_master');
            } else {



                $user    = $this->ion_auth->user()->row();
                $name    = $this->input->post('name');
                $content = $this->input->post('content');
                $status = $this->input->post('status');
                if ($id == false) {
                    //print_r($name);print_r($location);die();
                    $this->look_model->add_new_sidebar($name, $content, $status);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('admin/sidebar');
                } else {
                    $this->look_model->update_sidebar($id, $name, $content, $status);
                    $this->session->set_flashdata('message', $name.' Updated');
                    redirect('admin/sidebar');

                }
            }
        }
    }

    public function delete_sidebar($id)
    {

        $this->load->model('look_model');
        $this->look_model->delete_sidebar($id);
        $this->session->set_flashdata('message', 'a sidebar is deleted.');
        redirect('admin/add_new_photo_album');
    }

    public function socmeds()
    {

        $this->load->model('look_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Social Medias | Hello Little Red';
        $this->data['query']      = $this->look_model->get_socmeds();

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('id', 'id', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->render('admin/socmeds', 'admin_master');
            } else {
                $codepen    = $this->input->post('codepen');
                $deviantart = $this->input->post('deviantart');
                $facebook   = $this->input->post('facebook');
                $flickr     = $this->input->post('flickr');
                $instagram  = $this->input->post('instagram');
                $linkedin   = $this->input->post('linkedin');
                $soundcloud = $this->input->post('soundcloud');
                $tumblr     = $this->input->post('tumblr');
                $twitter    = $this->input->post('twitter');
                $youtube    = $this->input->post('youtube');
                $behance    = $this->input->post('behance');
                $github     = $this->input->post('github');

                $this->look_model->update_socmeds($codepen, $deviantart, $facebook, $flickr, $instagram, $linkedin, $soundcloud, $tumblr, $twitter, $youtube, $behance, $github);
                $this->session->set_flashdata('message', 'Social Media Updated');
                redirect('admin/socmeds');

            }
        }
    }

    public function header()
    {

        $this->load->model('look_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Header | Hello Little Red';
        $this->data['query']      = $this->look_model->get_headers();

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            $this->form_validation->set_rules('id', 'id', 'required');


            if ($this->form_validation->run() == FALSE) {

                $this->render('admin/header', 'admin_master');
            } else {

                $link = $this->input->post('link');

                $this->look_model->update_header($link);
                $this->session->set_flashdata('message', 'Header Updated');
                redirect('admin/header');

            }
        }
    }

    public function website($id = false)
    {

        $this->load->model('look_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'Add Website | Hello Little Red';
        $this->data['categories'] = $this->look_model->get_all_websites();
        $this->data['query']      = $this->look_model->get_website($id);

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            $this->load->library(array(
                'form_validation'
                ));

            
            $this->form_validation->set_rules('name', 'name', 'required|max_length[200]');
            $this->form_validation->set_rules('link', 'link', 'required|max_length[200]');

            if ($this->form_validation->run() == FALSE) {

                $this->render('admin/website', 'admin_master');
            } else {


                $name        = $this->input->post('name');
                $link        = $this->input->post('link');
                $icon        = $this->input->post('icon');
                $description = $this->input->post('description');

                if ($id == false) {
                    //print_r($name);print_r($location);die();
                    $this->look_model->add_new_website($name, $link, $icon, $description);
                    $this->session->set_flashdata('message', $name.' Added');
                    redirect('admin/website');
                } else {
                    $id = $this->input->post('album_id');
                    $this->look_model->update_website($id, $name, $link, $icon, $description);
                    $this->session->set_flashdata('message', $name.' Updated');
                    redirect('admin/website');

                }
            }
        }
    }

    public function delete_website($id)
    {

        $this->load->model('look_model');
        $this->look_model->delete_website($id);
        $this->session->set_flashdata('message', 'a website is deleted.');
        redirect('admin/website');
    }


    public function history()
    {

        $this->load->model('site_model');
        $user                     = $this->ion_auth->user()->row();
        $this->data['user']       = $user;
        $this->data['page_title'] = 'History';

        $config                   = array();
        $config["base_url"]       = base_url() . "admin/history";
        $config["total_rows"]     = $this->site_model->count_statuses();
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
        $this->data["categories"] = $this->site_model->get_statuses($config["per_page"], $page);

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {

            $this->render('admin/history', 'admin_master');
            
        }
    }

    public function empty_history()
    {
        $this->load->model('site_model');

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->site_model->empty_history();
            $this->session->set_flashdata('message', 'History is emptied');
            redirect('admin/history');
            
        }
    }
}