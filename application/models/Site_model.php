<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class site_model extends CI_Model {

	function get_statuses()
	{
		$this->db->limit(7);
		$this->db->order_by('date', 'desc');
		$query = $this->db->get('statuses');
		return $query->result();
	}

	function get_data()
	{
		$query = $this->db->get('site_data');
		return $query->result();
	}

	function update_data($title,$description,$keywords)
	{
		$data = array(
		 	'title'	=> $title,
		 	'description'	=> $description,
		 	'keywords'	=> $keywords,
		);
		$this->db->where('id', '1');
		$this->db->update('site_data', $data);
	}

	function get_updates()
	{
		$this->db->limit(15);
		$this->db->order_by('master_id', 'desc');
		$query = $this->db->get('master');
		return $query->result();
	}

	function get_theme($id)
	{
		$this->db->where('theme_id',$id);
		$query = $this->db->get('theme');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_post($id)
	{
		$this->db->where('entry_id',$id);
		$query = $this->db->get('entry');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
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

	function get_album($id)
	{
		$this->db->where('album_id',$id);
		$query = $this->db->get('photo_album');
		
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
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

	function get_story($id)
	{
		$this->db->where('id',$id);
		
		$query = $this->db->get('writing');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}

	function get_related_categories($id)
	{
		$category = array();
		
		$this->db->where('object_id',$id);
		$query = $this->db->get('theme_relationships'); // get category id related to the post
		
		foreach($query->result() as $row)
		{
			$this->db->where('category_id',$row->category_id);
			$query = $this->db->get('theme_category'); // get category details
			$category = array_merge($category,$query->result());
		}
		
		return $category;
	}

	function get_themes_categories()
	{
		$query = $this->db->get('theme_category'); 
		return $query->result();
	}

	function get_resources_types()
	{
		$query = $this->db->get('resources_types'); 
		return $query->result();
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */