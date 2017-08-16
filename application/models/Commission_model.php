<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class commission_model extends CI_Model {

	function get_commissions()
	{
		$this->db->order_by('commission_id','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get('commissions');
		return $query->result();
	}

	public function total_count() {
       return $this->db->count_all("commissions");
    }

	function add_new_commission($name, $email, $site, $sketch, $message, $categories)
	{
		$data = array(
				'name'    => $name,
				'email'   => $email,
				'site'    => $site,
				'sketch'  => $sketch,
				'message' => $message,
		);
		$this->db->insert('commissions', $data);

		$query = $this->db->query('select commission_id from commissions order by commission_id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> commission_id;


		//$object_id = (int) mysql_insert_id(); // get latest post id

		foreach($categories as $category)
		{
			$relationship = array(
				'object_id'		=> $id, // object id is post id
				'category_id'	=> $category,
			);
			$this->db->insert('commissions_relationships', $relationship);
		}
	}

	function get_commission($id)
	{
		$this->db->where('commission_id', $id);
		$query = $this->db->get('commissions');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_categories()
	{
		$query = $this->db->get('commission_category');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function mark_read($id = "") {
		$data = array(
			'status'	=> '2'
			);
		if($id != "") $this->db->where('commission_id', $id);
		$this->db->update('commissions', $data);
	}

	function get_related_categories($post_id)
	{
		$category = array();

		$this->db->where('object_id', $post_id);
		$query = $this->db->get('commissions_relationships'); // get category id related to the post

		foreach($query->result() as $row)
		{
			$this->db->where('category_id', $row->category_id);
			$query = $this->db->get('commission_category'); // get category details
			$category = array_merge($category, $query->result());
		}

		return $category;
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */