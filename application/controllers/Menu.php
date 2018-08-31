<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
    protected $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
	}

	public function index()
	{
		$this->data['title']      = 'Menu - '.$this->config->item('site_title', 'ion_auth');
		$this->data['current']    = 'menu';
        $this->data["file"] = "menu/index";
        $this->render($this->data["file"], 'admin_master');
	}

	public function menu($id)
	{
		$this->data['title']     = "Menu";
		$this->data['current']   = "menu";
		
		if( $this->ion_auth->logged_in() ) {
            $this->data["file"] = "menu/menu";
            $this->render($this->data["file"], 'admin_master');
        } else {
            show_404();
        }
    }
    
    public function get_menu($id) {
        $get = $this->menu_model->get_menu($id);
        echo json_encode($get);
    }
    
    public function get_children($id) {
        $get = $this->menu_model->get_children($id);
        echo json_encode($get);
    }

    public function add_menu() {
        $menu_en  = $this->input->post('menu_en');
        $menu_id  = $this->input->post('menu_id');
        $link   = $this->input->post('link');
        $parent   = $this->input->post('parent');
        $priority   = $this->input->post('priority');
        $admin = $this->input->post('admin');
        $status  = $this->input->post('status');

        $this->menu_model->add_menu($menu_en, $menu_id, $link, $parent, $priority, $admin, $status);
        $data['status'] = "success";
        $data['message'] = $menu_en.' added!';
        $data['message_id'] = $menu_en.' ditambahkan!';
        echo json_encode($data);
    }

    public function manage_menus()
    {
        $this->data['title'] = 'Manage menus';
        $this->data['current'] = $this->data['title'];
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "menus/manage_menus";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function delete_menu($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->menu_model->delete_menu($id);
            $data['status'] = "success";
            $data['message'] = 'menu deleted!';
            $data['message_id'] = 'Halaman dihapus!';
            echo json_encode($data);
        }
    }

    public function update_menu($id = '')
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $menu_en  = $this->input->post('menu_en');
            $menu_id  = $this->input->post('menu_id');
            $link   = $this->input->post('link');
            $parent   = $this->input->post('parent');
            $priority   = $this->input->post('priority');
            $admin = $this->input->post('admin');
            $status  = $this->input->post('status');

            $this->menu_model->update_menu($id, $menu_en, $menu_id, $link, $parent, $priority, $admin, $status);
            $data['status'] = "success";
            $data['message'] = $menu_en.' updated!';
            $data['message_id'] = $menu_en.' diperbaharui!';
            echo json_encode($data);
        }
    }
	
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */