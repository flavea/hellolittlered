
    <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tema extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('themes_model');
        $this->data['explanation'] = 'Free themes.';
        $this->data['paginglinks'] = '';
    }
    
    public function form_theme() {
        $this->data['title']   = 'Theme Form';
        $this->data['current'] = $this->data['title'];
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "themes/form_theme";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function delete_theme($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->themes_model->delete_theme($id);
            $data['status']     = "success";
            $data['message']    = 'Theme deleted!';
            $data['message_id'] = ' Tema dihapus!';
            echo json_encode($data);
        }
    }
    
    public function add_theme() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $user       = $this->ion_auth->user()->row();
            $name       = $this->input->post('theme_name');
            $body       = $this->input->post('theme_body');
            $body_id    = $this->input->post('theme_body_id');
            $categories = $this->input->post('theme_category[]');
            $image      = $this->input->post('theme_image');
            $preview    = $this->input->post('theme_preview');
            $code       = $this->input->post('theme_code');
            $status     = $this->input->post('status');
            $tweet      = $this->input->post('tweet');
            
            $this->themes_model->add_new_theme($user->id, $name, $image, $preview, $code, $body, $body_id, $categories, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function update_theme($id = '') {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name       = $this->input->post('theme_name');
            $body       = $this->input->post('theme_body');
            $body_id    = $this->input->post('theme_body_id');
            $categories = $this->input->post('theme_category');
            $image      = $this->input->post('theme_image');
            $preview    = $this->input->post('theme_preview');
            $code       = $this->input->post('theme_code');
            $status     = $this->input->post('status');
            $tweet      = $this->input->post('tweet');
            
            $this->themes_model->update_theme($id, $name, $image, $preview, $code, $body, $body_id, $status, $tweet);
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
            
        }
    }
    
    public function index($slug = "") {
        $this->data['title']   = 'Manage Themes | Hello Little Red';
        $this->data['current'] = $slug;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "themes/manage_themes";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function manage_category($id = "") {
        
        $this->data['title']   = 'Manage Categories';
        $this->data['current'] = $this->data['title'];
        
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "themes/manage_category";
            $this->render($this->data["file"], 'admin_master');
        }
    }
    
    public function add_category() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name = $this->input->post('category_name');
            
            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
            
            $this->themes_model->add_new_category($name, $slug);
            $data['status']     = "success";
            $data['message']    = $name . ' added!';
            $data['message_id'] = $name . ' ditambahkan!';
            echo json_encode($data);
        }
    }
    
    public function update_category($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $name = $this->input->post('category_name');
            
            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
            
            $this->themes_model->update_category($id, $name, $slug);
            $data['status']     = "success";
            $data['message']    = $name . ' updated!';
            $data['message_id'] = $name . ' diperbaharui!';
            echo json_encode($data);
        }
    }
    
    public function delete_category($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->themes_model->delete_category($id);
            $data['status']     = "success";
            $data['message']    = 'Category deleted!';
            $data['message_id'] = 'Kategori dihapus!';
            echo json_encode($data);
        }
    }

    public function get_categories($slug) {
        $data = $this->themes_model->get_categories();
        echo json_encode($data);
    }
    
    public function get_themes_by_slug($slug) {
        if ($slug == "all")
            $data = $this->themes_model->get_themes_simplified(12, 0);
        else
            $data = $this->themes_model->get_category_theme($slug);
        echo json_encode($data);
    }
    
    public function get_category($slug) {
        $data = $this->themes_model->get_category(null, $slug);
        echo json_encode($data);
    }
}