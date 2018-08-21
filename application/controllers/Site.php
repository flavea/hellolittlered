<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	}

	public function index() {
		$this->data['title'] = 'Home - '.$this->config->item('site_title', 'ion_auth');
        $this->data["current"] = "home";
		$this->render('blog/front','public_master');
	}

	public function get_front_data() {
        $this->load->model('blog_model');
        $this->load->model('themes_model');
        $this->load->model('projects_model');
		$data['posts'] = $this->blog_model->get_posts_simplified(3, 0);
		$data['themes'] = $this->themes_model->get_themes_simplified(4, 0);
		$data['project'] = $this->projects_model->get_latest_project();
		$data['exp'] = $this->projects_model->get_latest_experiment();
		echo json_encode($data);
	}

	public function get_data() {
        $this->load->model('blog_model');
        $this->load->model('site_model');
        $this->load->model('look_model');
		$this->load->model('page_model');
        $this->load->model('themes_model');
        $this->load->model('resources_model');
		$data['resources']= $this->resources_model->get_types();
		$data['basic'] = $this->site_model->get_data();
		$data['websites'] = $this->look_model->get_websites();
		$data['categories'] = $this->blog_model->get_categories();
		$data['theme_categories'] = $this->themes_model->get_categories();
		$data['pages'] = $this->page_model->get_pages_simplified();
		$data['sidebars'] = $this->look_model->get_sidebars();
		$data['sns'] = $this->look_model->get_socmeds();
		$data['friends'] = $this->look_model->get_friends(5);
		echo json_encode($data);
	}

	public function search($cari) {
        $this->load->model('search_model');
		$data["blogs_res"]    = $this->search_model->search_blog($cari);
		$data["themes_res"]   = $this->search_model->search_theme($cari);
		$data["page_res"]     = $this->search_model->search_page($cari);
		$data["projects_res"] = $this->search_model->search_projects($cari);
		echo json_encode($data);
	}
}