<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class themes extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('themes_model');
        $this->data['explanation'] = 'Free themes.';
        $this->data['paginglinks'] = '';
    }
    
    public function index() {
        $this->data['title']          = 'Themes - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['current']        = 'themes';
        $this->data['explanation']    = 'Free themes and templates that I made for various platforms.<br>';
        $this->data["explanation_id"] = "Tema dan template gratis untuk berbagai platform.<br>";
        
        $this->data["file"] = "themes/index";
        $this->render($this->data["file"], 'public_master');
    }
    
    public function shorten_string($string, $wordsreturned) {
        $retval = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array  = explode(" ", $string);
        if (count($array) <= $wordsreturned) {
            $retval = $string;
        } else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array) . " ...";
        }
        return $retval;
    }
    
    public function theme($id, $preview = '', $private = false) {
        $this->data['pagetitle'] = '';
        
        if ($preview != "preview") {
            $this->data['query'] = $this->themes_model->get_theme_short($id);
            if ($this->themes_model->get_theme($id)) {
                if (($this->data['query'][0]->status == 2 || $this->data['query'][0]->status == 1) && $private == "" && !$this->ion_auth->logged_in())
                    show_404();
                else if ($this->data['query'][0]->status == 4)
                    show_404();
                else if ($this->data['query'][0]->status == 1 && !$this->ion_auth->logged_in())
                    show_404();
                else {
                    foreach ($this->data['query'] as $row) {
                        $this->data['title']       = $row->theme_name;
                        $this->data['explanation'] = ($row->theme_body != "" ? $row->theme_body : $row->theme_body_id);
                        $this->data['image']       = $row->theme_image;
                    }
                    
                    $this->data["file"] = "themes/theme";
                    $this->render($this->data["file"], 'public_master');
                }
            }
        } else if ($preview == "preview") {
            $this->data['query'] = $this->themes_model->get_theme($id);
            $this->data["file"]  = "themes/theme_preview";
            $this->render($this->data["file"], 'preview_master');
        }
    }
    
    public function get_theme($id) {
        $this->load->helper('file');
        $data['cat']   = $this->themes_model->get_related_categories($id);
        $data['theme'] = $this->themes_model->get_theme($id);
        $data['code']  = read_file(FCPATH . 'preview/' . $id . '.html');
        echo json_encode($data);
    }
    
    public function type($slug = FALSE) {
        $this->data['title']     = $slug . ' - ' . $this->config->item('site_title', 'ion_auth');
        $this->data['pagetitle'] = $slug;
        $this->data['current']   = 'themes/' . $slug;
        
        if ($slug == FALSE)
            redirect(themes);
        else {
            $this->data["file"] = "themes/index";
            $this->render($this->data["file"], 'public_master');
        }
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