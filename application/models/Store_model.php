<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class store_model extends CI_Model {

	function get_designs($limit, $start) 
	{
      	$this->db->limit($limit, $start);
		$query = $this->db->get('design');
		return $query->result();
	}

	function get_design($id)
	{
		$this->db->where('id',$id);
		
		$query = $this->db->get('design');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}

	function total_count() {
       return $this->db->count_all("design");
    }
	
	function add_new_design($name,$image,$redbubble,$tees)
	{
		$data = array(
		 	'name'	=> $name,
		 	'image'	=> $image,
		 	'redbubble'	=> $redbubble,
		 	'tees'	=> $tees,
		);
		$this->db->insert('design',$data);

		$query = $this->db->query('select id from design order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'store',
		);
		$this->db->insert('master',$master_data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Added a new store item: "'.$name.'" check it out here '.base_url().'shop/',
		);
		$this->db->insert('statuses',$status_data);
	}

	function delete_design($id) {
	    $this->db->delete('design', array('id' => $id)); 
	    $this->db->delete('master', array('object_id' => $id, 'object_type' => 'store')); 
	}

	function update_design($id, $name,$image,$redbubble,$tees)
	{
		$data = array(
		 	'name'	=> $name,
		 	'image'	=> $image,
		 	'redbubble'	=> $redbubble,
		 	'tees'	=> $tees,
		);
		$this->db->where('id', $id);
		$this->db->update('design', $data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a store item: "'.$name.'" check it out here '.base_url().'shop/',
		);
		$this->db->insert('statuses',$status_data);
	}

	
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */