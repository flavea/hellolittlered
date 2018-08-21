<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends CI_Model {

	function search_blog($slug)
	{
		$posts=$this->db->query("select * from entry where entry_body like '%$slug%' or entry_name like '%$slug%' or entry_body_id like '%$slug%' and status = '3' order by entry_date desc");
		return $posts->result(); // return an array of post object
	}

	function search_theme($slug)
	{
		$posts=$this->db->query("select * from theme where theme_body like '%$slug%' or theme_name like '%$slug%' or theme_body_id like '%$slug%' and status = '3' order by theme_date desc");
		return $posts->result(); // return an array of post object
	}

	function search_page($slug)
	{
		$posts=$this->db->query("select * from page where page_title like '%$slug%' or page_body like '%$slug%' or page_body_id like '%$slug%' and status = '3' order by page_date desc");
		return $posts->result(); // return an array of post object
	}

	function search_projects($slug)
	{
		$posts=$this->db->query("select * from projects where name like '%$slug%' or exp like '%$slug%' or exp_id like '%$slug%' and status = '3' order by date_up desc");
		return $posts->result(); // return an array of post object
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */