<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->data['keywords'] = 'blog';
	}

	public function index($offset = 0)
	{

		$this->data['title']       = 'Blog';
		$this->data['pagetitle']   = 'Latest Blog Posts';
		$this->data['current']     = 'Blog';
		$this->data['explanation'] = 'Thoughts and rants about anything and everything.';
		$this->data['explanation_id'] = 'Catatan mengenai apa pun.';
		$this->data["file"] = "blog/index";
		$this->render($this->data["file"], 'public_master');
    }
    
    public function get_posts($offset = 0) {
        
		$config                    = array();
		$config["base_url"]        = base_url() . "blog/get_posts";
		$config["total_rows"]      = $this->blog_model->total_count();
		$config["per_page"]        = 9;
		$config["uri_segment"]     = 3;
		$config['display_pages']   = FALSE;
		$config['next_link']       = '<span class="fa fa-chevron-right"></span>';
		$config['next_tag_open']   = '<span class="button big next">';
		$config['next_tag_close']  = '</span>';
		$config['prev_link']       = '<span class="fa fa-chevron-left"></span>';
		$config['prev_tag_open']   = '<span class="button big previous">';
		$config['prev_tag_close']  = '</span>';
		$config['last_link']       = '';
		$config['first_link']      = '';
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
        $data['posts'] = $this->blog_model->get_posts(9, $offset);
        echo json_encode($data);
    }

    public function get_all_posts() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $data = $this->blog_model->get_posts();
            echo json_encode($data);
        }
    }

	public function form_entry()
    {
        $this->data['current']  = 'Add Blog Post';
        $this->data['title']  = 'Post | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "blog/form_entry";
            $this->render($this->data["file"], 'admin_master');
        }
    }

    public function delete_post($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->blog_model->delete_post($id);
            $data['status'] = "success";
            $data['message_id'] = 'Blog post deleted!';
            $data['message'] = 'Pos dihapus!';
            echo json_encode($data);
        }
    }

    public function add_post() {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $user       = $this->ion_auth->user()->row();
            $title      = $this->input->post('entry_name');
            $title_id   = $this->input->post('entry_name_id');
            $body       = $this->input->post('entry_body');
            $body_id    = $this->input->post('entry_body_id');
            $categories = $this->input->post('entry_categories');
            $image      = $this->input->post('entry_image');
            $video      = $this->input->post('entry_video');
            $tags       = $this->input->post('entry_tags');
            $status     = $this->input->post('status');
            $tweet      = $this->input->post('tweet');

            $this->blog_model->add_new_entry($user->id, $title, $title_id, $body, $body_id, $categories, $image, $video, $tags, $status, $tweet);
            $data['status'] = "success";
            $data['message'] = $title.' ditambahkan!';
            $data['message_id'] = $title.'added!';
            echo json_encode($data);
        }
    }

    public function update_post($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $title  = $this->input->post('entry_name');
            $title_id   = $this->input->post('entry_name_id');
            $body   = $this->input->post('entry_body');
            $body_id    = $this->input->post('entry_body_id');
            $image  = $this->input->post('entry_image');
            $video  = $this->input->post('entry_video');
            $tags   = $this->input->post('entry_tags');
            $status = $this->input->post('status');
            $tweet  = $this->input->post('tweet');

            $this->blog_model->update_entry($id, $title, $title_id, $body, $id, $image, $video, $tags, $status, $tweet);
            $data['status'] = "success";
            $data['message'] = $title.' updated!';
            $data['message_id'] = $title.'diperbaharui!';
            echo json_encode($data);
        }
    }

    public function manage_posts($offset = 0)
    {
        $this->data['current']  = 'Manage Blog Posts';
        $this->data['title'] = 'Posts | Hello Little Red';
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            show_404();
        } else {
            $this->data["file"] = "blog/manage_posts";
            $this->render($this->data["file"], 'admin_master');
        }
    }
	
	public function post($id, $private = "")
	{
		$this->data['post_id']    = $id;
		$this->data['categories'] = $this->blog_model->get_categories();
		$this->data['pagetitle']  = '';
		
		if( $this->ion_auth->logged_in() )
			$this->data['user'] = $this->ion_auth->user()->row();
		
		$this->load->helper('form');
		$this->load->library(array('form_validation'));
		
        $this->data['query'] = $this->blog_model->get_post_short($id);

		if($this->data['query'])
		{
			if(($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
				show_404();
			else if($this->data['query'][0]->status == 4) show_404();
			else if($this->data['query'][0]->status != 3) show_404();
			else {
				foreach($this->data['query'] as $row)
				{
					$this->data['title']       = ($row->entry_name != "" ? $row->entry_name : $row->entry_name_id).' - '.$this->config->item('site_title', 'ion_auth');
					$this->data['explanation'] = ($row->entry_body != "" ? $row->entry_body : $row->entry_body_id);
					$this->data['image']       = $row->entry_image;
					$this->data['keywords']    = $row->entry_tags;
				}

                $this->data["file"] = "blog/post";
                $this->render($this->data["file"], 'public_master');
			}
		}
		else
			show_404();
    }
    
    public function get_post($id) {
        $data['cat'] = $this->blog_model->get_related_categories($id);
        $data['post'] = $this->blog_model->get_post($id);
        echo json_encode($data);
    }
	
	public function category($slug = FALSE)
	{
        $this->data['title'] = 'Blog Categories | Hello Little Red';
		$this->data['current']  = 'Blog Categories';
		
		if( $slug == FALSE )
			show_404();
		else {
            $this->data["file"] = "blog/category";
            $this->render($this->data["file"], 'public_master');
        }
    }
    
    public function get_category_posts($slug) {
        $data['category'] = $this->blog_model->get_category(NULL,$slug);
        $data['query']    = $this->blog_model->get_category_post($slug);
        echo json_encode($data);
    }

	public function manage_category($id = "")
    {
        $this->data['current']             = 'Blog Categories';
        $this->data['title'] = 'Blog Categories | Hello Little Red';

        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->load->helper('form');
            if($id != "") {
                $name = $this->input->post('category_name');

                if ($this->input->post('category_slug') != '')
                    $slug = $this->input->post('category_slug');
                else
                    $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
                $this->blog_model->update_category($id, $name, $slug);
                $data['status'] = "success";
                $data['message'] = $name.' Updated!';
                $data['message_id'] = $name.' diperbaharui!';
                echo json_encode($data);
            } else {
                $this->data["file"] = "blog/manage_category";
                $this->render($this->data["file"], 'admin_master');
            }
        }
    }
	public function add_category()
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $name = $this->input->post('category_name');

            if ($this->input->post('category_slug') != '')
                $slug = $this->input->post('category_slug');
            else
                $slug = strtolower(preg_replace('/[^A-Za-z0-9_-]+/', '-', $name));
            $this->blog_model->add_new_category($name, $slug);
            $data['status'] = "success";
            $data['message'] = $name.' Added!';
            $data['message_id'] = $name.' ditambahkan!';
            echo json_encode($data);
        }
    }

    public function delete_category($id)
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) 
        {
            show_404();
        } else {
            $this->blog_model->delete_category($id);
            $data['status'] = "success";
            $data['status'] = "1 category deleted";
            echo json_encode($data);
        }
    }
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */