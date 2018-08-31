<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {

	function get_posts($limit=false, $start=false)
	{
		if($limit != false || $start!=false) {
			$this->db->limit($limit, $start);

		}
		
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->order_by('entry_date','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get('entry');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function get_posts_simplified($limit=false, $start=false)
	{
		if($limit != false || $start!=false) {
			$this->db->limit($limit, $start);

		}
		
		$this->db->select('entry_id, entry_name, entry_name_id, entry_date');
		$this->db->from('entry');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->order_by('entry_date','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function total_count() {
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->from('entry');
		return $this->db->count_all_results();
	}
	
	function add_new_entry($author, $name, $name_id, $body, $body_id, $categories, $image, $video, $tags, $status, $tweet)
	{
		$data = array(
			'author_id'		=> $author,
			'entry_name'	=> $name,
			'entry_name_id'	=> $name_id,
			'entry_body'	=> $body,
			'entry_body_id'	=> $body_id,
			'entry_image'	=> $image,
			'entry_video'	=> $video,
			'entry_tags'	=> $tags,
			'status'		=> $status
			);
		$this->db->insert('entry', $data);

		$query = $this->db->query('select entry_id from entry order by entry_date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> entry_id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'news',
			);
		$this->db->insert('master', $master_data);

		$status_data = array(
			'author_id'		=> $author,
			'status'		=> 'Posted a new blog post: "'.$name.'" check it out here '.base_url().'post/'.$id,
			);
		$this->db->insert('statuses', $status_data);
		
		foreach($categories as $category)
		{
			$relationship = array(
				'object_id'		=> $id, // object id is post id
				'category_id'	=> $category,
				);
			$this->db->insert('entry_relationships', $relationship);
		}
		
		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
	
	function get_post($id)
	{
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->where('entry_id', $id);
		$query = $this->db->get('entry');
		if($query->num_rows()!==0)
			return $query->result();
		else
			return FALSE;
	}

	function get_post_short($id)
	{
		$this->db->select('entry_name, status, entry_name_id, substring(entry_body, 0, 200) as entry_body, substring(entry_body_id, 0, 200) as entry_body_id, entry_image, entry_tags');
		$this->db->from('entry');
		$this->db->where('entry_id', $id);
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$query = $this->db->get();
		if($query->num_rows()!==0)
			return $query->result();
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
				$this->db->insert('entry_category', $data);
				$status_data = array(
					'author_id'		=> 1,
					'status'		=> 'Added a new blog category: "'.$name,
					);
				$this->db->insert('statuses', $status_data);
				
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}

	function update_category($id, $name, $slug)
	{
		$slug_taken = TRUE;
		$data = array(
			'category_name'	=> $name,
			'slug'			=> $slug,
			);
		

		$this->db->where('category_id', $id);
		$this->db->update('entry_category', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a blog category: "'.$name,
			);
		$this->db->insert('statuses', $status_data);
	}

	function get_category($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('category_id', $id);
		elseif( $slug )
			$this->db->where('slug', $slug);
		
		$query = $this->db->get('entry_category');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE;
	}
	
	function get_categories()
	{
		$query = $this->db->query('select * from entry_category'); 
		return $query->result();
	}
	
	function get_related_categories($post_id)
	{
		$category = array();
		$this->db->where('object_id', $post_id);
		$query = $this->db->get('entry_relationships');
		
		foreach($query->result() as $row)
		{
			$this->db->where('category_id', $row->category_id);
			$query = $this->db->get('entry_category');
			$category = array_merge($category, $query->result());
		}
		
		return $category;
	}
	
	function get_category_post($slug)
	{
		$list_post = array();
		
		$this->db->where('slug', $slug);
		$query = $this->db->get('entry_category');
		if( $query->num_rows() == 0 )
			show_404();
		
		foreach($query->result() as $category)
		{
			$this->db->where('category_id', $category->category_id);
			$query = $this->db->get('entry_relationships');
			$posts = $query->result();
		}
		
		if( isset($posts) && $posts )
		{
			foreach($posts as $post)
			{
				$list_post = array_merge($list_post, $this->get_post($post->object_id));
			}		
		}
		
		return $list_post;
	}

	function delete_post ($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('entry_id', $id);
		$this->db->update('entry', $data);
	}

	function delete_category ($id) {
		$this->db->delete('entry_category', array('category_id' => $id)); 
		$this->db->delete('entry_relationships', array('category_id' => $id));
	}

	function update_entry($id, $name, $name_id, $body, $body_id, $image, $video, $tags, $status, $tweet)
	{
		$data = array(
			'entry_name'	=> $name,
			'entry_name_id' => $name_id,
			'entry_body'	=> $body,
			'entry_body_id'	=> $body_id,
			'entry_image'	=> $image,
			'entry_video'	=> $video,
			'entry_tags'	=> $tags,
			'status'		=> $status
			);

		$this->db->where('entry_id', $id);
		$this->db->update('entry', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a blog post: "'.$name.'" check it out here '.base_url().'post/'.$id,
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