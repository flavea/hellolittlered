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
        $this->data["explanation_id"] = "Tema dan template gratis untuk berbagai platform.<br>";

		$this->data["file"] = "themes/index";
		$this->render($this->data["file"], 'public_master');
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
		
		if($preview!="preview") {
            $this->data['query']      = $this->themes_model->get_theme_short($id);
			if($this->themes_model->get_theme($id))
			{
				if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
					show_404();
				else if($this->data['query'][0]->status == 4) show_404();
				else if($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in()) show_404();
				else {
					foreach($this->data['query'] as $row)
					{
                        $this->data['title']       = $row->theme_name;
                        $this->data['explanation'] = ($row->theme_body != "" ? $row->theme_body : $row->theme_body_id);
                        $this->data['image']       = $row->theme_image;
					}

                    $this->data["file"] = "themes/theme";
                    $this->render($this->data["file"], 'public_master');
				}
			}
		} else if($preview=="preview") {
            $this->data['query']      = $this->themes_model->get_theme($id);
            $this->data["file"] = "themes/theme_preview";
            $this->render($this->data["file"], 'preview_master');
		}
    }
    
    public function get_theme($id) {
	    $this->load->helper('file');
        $data['cat'] = $this->themes_model->get_related_categories($id);
        $data['theme'] = $this->themes_model->get_theme($id);
        $data['code'] = read_file(FCPATH.'preview/'.$id.'.html');
        echo json_encode($data);
    }
	
	public function type($slug = FALSE)
	{
		$this->data['title'] = $slug.' - '.$this->config->item('site_title', 'ion_auth');
		$this->data['pagetitle'] = $slug;
		$this->data['current'] = 'themes/'.$slug;

		if( $slug == FALSE )
			redirect(themes);
		else
		{
            $this->data["file"] = "themes/index";
            $this->render($this->data["file"], 'public_master');
        }
    }
    
    public function get_categories($slug) {
        $data = $this->themes_model->get_categories();
        echo json_encode($data);
    }
    
    public function get_themes_by_slug($slug) {
        if($slug == "all") $data = $this->themes_model->get_themes_simplified(12, 0);
        else $data =  $this->themes_model->get_category_theme($slug);
        echo json_encode($data);
    }
    
    public function get_category($slug) {
        $data =  $this->themes_model->get_category(null, $slug);
        echo json_encode($data);
    }

	public function form_theme()
    {
        $this->data['title'] = 'Theme Form';
        $this->data['current'] = $this->data['title'];
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "themes/form_theme";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function delete_theme($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->themes_model->delete_theme($id);
            $data['status'] = "success";
            $data['message'] = 'Theme deleted!';
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
            $data['status'] = "success";
            $data['message'] = $name.' added!';
            $data['message_id'] = $name.' ditambahkan!';
            echo json_encode($data);
        }
    }

    public function update_theme($id = '')
    {
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
            $data['status'] = "success";
            $data['message'] = $name.' updated!';
            $data['message_id'] = $name.' diperbaharui!';
            echo json_encode($data);
        
        }
    }

    public function manage_themes($slug = "")
    {
        $this->data['title'] = 'Manage Themes | Hello Little Red';
        $this->data['current'] = $slug;
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "themes/manage_themes";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function manage_category($id = "")
    {

        $this->data['title'] = 'Manage Categories';
        $this->data['current'] = $this->data['title'];

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
                $this->data["file"] = "themes/manage_category";
                $this->render($this->data["file"], 'admin_master');
        }
    }

    public function add_category() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $name = $this->input->post('category_name');

            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

            $this->themes_model->add_new_category($name, $slug);
            $data['status'] = "success";
            $data['message'] = $name.' added!';
            $data['message_id'] = $name.' ditambahkan!';
            echo json_encode($data);
        }
    }

    public function update_category($id) {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $name = $this->input->post('category_name');

            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));

            $this->themes_model->update_category($id, $name, $slug);
            $data['status'] = "success";
            $data['message'] = $name.' updated!';
            $data['message_id'] = $name.' diperbaharui!';
            echo json_encode($data);
        }
    }

    public function delete_category($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->themes_model->delete_category($id);
            $data['status'] = "success";
            $data['message'] = 'Category deleted!';
            $data['message_id'] = 'Kategori dihapus!';
            echo json_encode($data);
        }
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */