<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends CI_Model {

	function search($slug)
	{
		$posts=$this->db->query("select * from entry where entry_body like '%$slug%' or entry_name like '%$slug%' ");
		return $posts->result(); // return an array of post object
	}

	
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */