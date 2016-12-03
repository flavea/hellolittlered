<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class themes_model extends CI_Model {

	function get_themes($limit, $start) {
      	$this->db->limit($limit, $start);
		$this->db->order_by('theme_id','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get('theme');
		return $query->result();
	}

	function total_count() {
       return $this->db->count_all("theme");
    }

	function add_new_theme($author,$name,$image,$preview,$code,$body,$categories)
	{
		$data = array(
			'author_id'		=> $author,
		 	'theme_name'	=> $name,
		 	'theme_image'	=> $image,
		 	'theme_preview'	=> $preview,
		 	'theme_code'	=> $code,
		 	'theme_body'	=> $body,
		);
		$this->db->insert('theme',$data);

		$query = $this->db->query('select theme_id from theme order by theme_date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> theme_id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'theme',
		);
		$this->db->insert('master',$master_data);


		$status_data = array(
			'author_id'		=> $author,
		 	'status'		=> 'Added a new theme: "'.$name.'" check it out here '.base_url().'theme/'.$id,
		);
		$this->db->insert('statuses',$status_data);
		
		//$object_id = (int) mysql_insert_id(); // get latest post id
		
		foreach($categories as $category)
		{
			$relationship = array(
				'object_id'		=> $id, // object id is post id
				'category_id'	=> $category,
			);
			$this->db->insert('theme_relationships',$relationship);
		}
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
	
	function add_new_category($name,$slug)
	{
		$i = 0;
		$slug_taken = FALSE;
		
		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_category(NULL,$slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'category_name'	=> $name,
					'slug'			=> $slug,
				);
				$this->db->insert('theme_category',$data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}
	
	function get_category($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('category_id',$id);
		elseif( $slug )
			$this->db->where('slug',$slug);
		
		$query = $this->db->get('theme_category');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}

	function total_count_slug($slug) {

		$this->db->where('slug', $slug);
		$query = $this->db->get('theme_category');
		$object_id = max($query->result());
		$id = $object_id -> category_id;

		$this->db->where('category_id', $id);
		$this->db->from('theme_relationships');
		return $this->db->count_all_results();
    }
	
	
	function get_categories()
	{
		$query = $this->db->get('theme_category'); 
		return $query->result();
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
	function get_category_theme($slug, $limit, $start)
	{
		$list_post = array();
		$this->db->where('slug',$slug);
		$query = $this->db->get('theme_category'); // get category id
		if( $query->num_rows() == 0 )
			show_404();
		
		foreach($query->result() as $category)
		{	
			$this->db->limit($limit, $start);
			$this->db->where('category_id',$category->category_id);
			$this->db->order_by("relationship_id", "desc"); 
			$query = $this->db->get('theme_relationships'); // get posts id which related the category
			$posts = $query->result();
		}
		
		if( isset($posts) && $posts )
		{
			foreach($posts as $post)
			{
				$list_post = array_merge($list_post,$this->get_theme($post->object_id)); // get posts and merge them into array
			}		
		}
		
		return $list_post; // return an array of post object
	}

	function delete_theme ($id) {
	    $this->db->delete('theme', array('entry_id' => $id)); 
	    $this->db->delete('theme_relationships', array('object_id' => $id));
	}

	function delete_category ($id) {
	    $this->db->delete('theme_category', array('category_id' => $id)); 
	    $this->db->delete('theme_relationships', array('category_id' => $id));
	}

	function update_theme($id,$name,$image,$preview,$code,$body)
	{
		$data = array(
		 	'theme_name'	=> $name,
		 	'theme_image'	=> $image,
		 	'theme_preview'	=> $preview,
		 	'theme_code'	=> $code,
		 	'theme_body'	=> $body,
		);
		$this->db->where('theme_id', $id);
		$this->db->update('theme', $data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a theme: "'.$name.'" check it out here '.base_url().'theme/'.$id,
		);
		$this->db->insert('statuses',$status_data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */