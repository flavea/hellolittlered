<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class themes_model extends CI_Model {

	function get_themes($limit, $start) {
		$this->db->limit($limit, $start);
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->order_by('theme_id','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get('theme');
		return $query->result();
	}

	function get_all_themes($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('theme');
		$this->db->join('status', 'theme.status = status.id and theme.status != "4"');
		$this->db->order_by('theme_id','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get();
		return $query->result();
	}

	function total_count() {
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->from('theme');
		return $this->db->count_all_results();
	}

	function total_all_count() {
		$this->db->from('theme');
		$this->db->where('status !=', '4');
		return $this->db->count_all_results();
	}

	function add_new_theme($author, $name, $image, $preview, $code, $body, $categories, $status, $tweet)
	{
		$data = array(
			'author_id'		=> $author,
			'theme_name'	=> $name,
			'theme_image'	=> $image,
			'theme_preview'	=> $preview,
			'theme_code'	=> $code,
			'theme_body'	=> $body,
			'status'		=> $status
			);
		$this->db->insert('theme', $data);

		$query = $this->db->query('select theme_id from theme order by theme_date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> theme_id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'theme',
			);
		$this->db->insert('master', $master_data);


		$status_data = array(
			'author_id'		=> $author,
			'status'		=> 'Added a new theme: "'.$name.'" check it out here '.base_url().'theme/'.$id,
			);
		$this->db->insert('statuses', $status_data);
		
		
		foreach($categories as $category)
		{
			$relationship = array(
					'object_id'		=> $id, // object id is post id
					'category_id'	=> $category,
					);
			$this->db->insert('theme_relationships', $relationship);
		}
		
		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
	
	function get_theme($id)
	{

		$this->db->select('*');
		$this->db->from('theme');
		$this->db->join('status', 'theme.status = status.id and theme.status != "4"');
		$this->db->where('theme_id', $id);
		$query = $this->db->get();
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_theme2($id)
	{
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('theme_id', $id)->where('status','3');
		} else {
			$this->db->where('theme_id', $id)->where('status','3')->or_where('status','2');
		}
		$query = $this->db->get('theme');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
	
	function add_new_category($name, $slug)
	{
		$i = 0;
		$slug_taken = FALSE;
		
		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_category(NULL, $slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'category_name'	=> $name,
					'slug'			=> $slug,
					);
				$this->db->insert('theme_category', $data);
				$status_data = array(
					'author_id'		=> 1,
					'status'		=> 'Added a new theme category: "'.$name
					);
				$this->db->insert('statuses', $status_data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}

	function update_category($id, $name, $slug)
	{
		$data = array(
			'category_name'	=> $name,
			'slug'			=> $slug,
			);
		$this->db->where('category_id', $id);
		$this->db->update('theme_category', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a theme category: "'.$name,
			);
		$this->db->insert('statuses', $status_data);
	}
	
	function get_category($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('category_id', $id);
		elseif( $slug )
			$this->db->where('slug', $slug);
		
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
		$id = $object_id ->category_id;

		$this->db->select('*');
		$this->db->from('theme_relationships');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->join('theme', 'theme.theme_id = theme_relationships.object_id and theme.status = "3"');
		} else {
			$this->db->join('theme', 'theme.theme_id = theme_relationships.object_id and theme.status = "3" or theme.status = "2"');
		}
		$this->db->where('category_id', $id);
		return $this->db->count_all_results();
	}

	function total_count_all_slug($slug) {


		$this->db->where('slug', $slug);
		$query = $this->db->get('theme_category');
		$object_id = max($query->result());
		$id = $object_id->category_id;

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
		
		$this->db->where('object_id', $id);
		$query = $this->db->get('theme_relationships'); // get category id related to the post
		
		foreach($query->result() as $row)
		{
			$this->db->where('category_id', $row->category_id);
			$query = $this->db->get('theme_category'); // get category details
			$category = array_merge($category, $query->result());
		}
		
		return $category;
	}
	function get_category_theme($slug, $limit, $start)
	{
		$list_post = array();
		$this->db->where('slug', $slug);
		$query = $this->db->get('theme_category'); // get category id
		if( $query->num_rows() == 0 )
			show_404();
		
		foreach($query->result() as $category)
		{	
			$this->db->limit($limit, $start);
			$this->db->where('category_id', $category->category_id);
			$this->db->order_by("relationship_id", "desc"); 
			$query = $this->db->get('theme_relationships'); // get posts id which related the category
			$posts = $query->result();
		}
		
		if( isset($posts) && $posts )
		{
			foreach($posts as $post)
			{
				$list_post = array_merge($list_post, $this->get_theme2($post->object_id)); // get posts and merge them into array
			}		
		}
		
		return $list_post; // return an array of post object
	}

	function get_all_category_theme($slug, $limit, $start)
	{
		$list_post = array();
		$this->db->where('slug', $slug);
		$query = $this->db->get('theme_category'); // get category id
		if( $query->num_rows() == 0 )
			show_404();
		
		foreach($query->result() as $category)
		{	
			$this->db->limit($limit, $start);
			$this->db->where('category_id', $category->category_id);
			$this->db->order_by("relationship_id", "desc"); 
			$query = $this->db->get('theme_relationships'); // get posts id which related the category
			$posts = $query->result();
		}
		
		if( isset($posts) && $posts )
		{
			foreach($posts as $post)
			{
				$list_post = array_merge($list_post, $this->get_theme($post->object_id)); // get posts and merge them into array
			}		
		}
		
		return $list_post; // return an array of post object
	}

	function delete_theme ($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('theme_id', $id);
		$this->db->update('theme', $data);
		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted a theme'
			);
		$this->db->insert('statuses', $status_data);
	}

	function delete_category ($id) {
		$this->db->delete('theme_category', array('category_id' => $id)); 
		$this->db->delete('theme_relationships', array('category_id' => $id));
	}

	function update_theme($id, $name, $image, $preview, $code, $body, $status, $tweet)
	{
		$data = array(
			'theme_name'	=> $name,
			'theme_image'	=> $image,
			'theme_preview'	=> $preview,
			'theme_code'	=> $code,
			'theme_body'	=> $body,
			'status'		=> $status
			);
		$this->db->where('theme_id', $id);
		$this->db->update('theme', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a theme: "'.$name.'" check it out here '.base_url().'theme/'.$id,
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */