<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resources_model extends CI_Model {

	function get_resources()
	{
		$query = $this->db->query('call get_resources()');
		mysqli_next_result( $this->db->conn_id );
		return $query->result();
	}

	function total_count() {
       return $this->db->count_all("resources");
    }
    
	function total_count_slug($slug) {

		$this->db->select('type_id');
		$this->db->where('type_slug', $slug);
		$id = $this->db->get('resources_types');

		$this->db->where('resource_type', $id);
		$this->db->from('resources');
		return $this->db->count_all_results();
    }
	
	function add_new_resource($author,$name,$preview,$download,$type)
	{
		$data = array(
			'author_id'		=> $author,
		 	'resource_name'	=> $name,
		 	'resource_preview'	=> $preview,
		 	'resource_download'	=> $download,
		 	'resource_type'	=> $type,
		);
		$this->db->insert('resources',$data);

		$query = $this->db->query('select id from design order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> resource_id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'resource',
		);
		$this->db->insert('master',$master_data);
	}
	
	function get_resource($id)
	{
		$this->db->where('resource_id',$id);
		$query = $this->db->get('resources');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
	
	function add_new_type($name,$slug)
	{
		$i = 0;
		$slug_taken = FALSE;
		
		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_type(NULL,$slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'type_name'	=> $name,
					'type_slug'			=> $slug,
				);
				$this->db->insert('resources_types',$data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}
	
	function get_type($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('type_id',$id);
		elseif( $slug )
			$this->db->where('type_slug',$slug);
		
		$query = $this->db->get('resources_types');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}


	
	function get_types()
	{
		$query = $this->db->get('resources_types'); 
		return $query->result();
	}
	
	function get_category_resource($slug)
	{
		$query2 = 'call get_resources_by_slug("'.$slug.'")';
		$query = $this->db->query($query2);
		mysqli_next_result( $this->db->conn_id );
		
		return $query->result();
		
	}

	function delete_resource ($id) {
	    $this->db->delete('resources', array('resource_id' => $id)); 
	    $this->db->delete('master', array('object_id' => $id, 'object_type' => 'resource')); 
	}

	function delete_type ($id) {
	    $this->db->delete('resources_types', array('resource_id' => $id)); 
	}

	function update_resource($id,$name,$preview,$download,$type)
	{
		$data = array(
		 	'resource_name'	=> $name,
		 	'resource_preview'	=> $preview,
		 	'resource_download'	=> $download,
		 	'resource_type'	=> $type,
		);
		$this->db->where('resource_id', $id);
		$this->db->update('resources', $data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */