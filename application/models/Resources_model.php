<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resources_model extends CI_Model {

	function get_resources()
	{
		$this->db->select('*');
		$this->db->from('resources');
		$this->db->join('resources_types', 'resources.resource_type = resources_types.type_id ');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->order_by('resource_date','desc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_resources()
	{
		$this->db->select('*');
		$this->db->from('resources');
		$this->db->join('resources_types', 'resources.resource_type = resources_types.type_id ');
		$this->db->join('status', 'resources.status = status.id and resources.status != "4"');
		$this->db->order_by('resource_date','desc');
		$query = $this->db->get();
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

	function add_new_resource($author, $name, $preview, $download, $type, $status, $tweet)
	{
		$data = array(
			'author_id'         => $author,
			'resource_name'     => $name,
			'resource_preview'  => $preview,
			'resource_download' => $download,
			'resource_type'     => $type,
			'status'            => $status,
			);

		$this->db->insert('resources', $data);

		$query = $this->db->query('select id from design order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> resource_id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'resource',
			);
		$this->db->insert('master', $master_data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Added a new resource: "'.$name.'" check it out here '.base_url().'resource/',
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}

	function get_resource($id)
	{
		$this->db->where('resource_id', $id);
		$query = $this->db->get('resources');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function add_new_type($name, $slug)
	{
		$i = 0;
		$slug_taken = FALSE;

		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_type(NULL, $slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'type_name' => $name,
					'type_slug' => $slug,
					);
				$this->db->insert('resources_types', $data);
				$status_data = array(
					'author_id'		=> 1,
					'status'		=> 'Added a new resource type: "'.$name
					);
				$this->db->insert('statuses', $status_data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}

	function update_type($id, $name, $slug)
	{
		$i = 0;
		$slug_taken = FALSE;

		while( $slug_taken ==  FALSE ) // to avoid duplicate slug
		{
			$category = $this->get_type(NULL, $slug);
			if( $category == FALSE )
			{
				$slug_taken = TRUE;
				$data = array(
					'type_name' => $name,
					'type_slug' => $slug,
					);
				$this->db->where('type_id', $id);
				$this->db->update('resources_types', $data);
				$status_data = array(
					'author_id'		=> 1,
					'status'		=> 'Updated a resource type: "'.$name
					);
				$this->db->insert('statuses', $status_data);
			}
			$i = $i + 1;
			$slug = $slug.'-'.$i;
		}
	}

	function get_type($id = FALSE, $slug)
	{
		if( $id != FALSE)
			$this->db->where('type_id', $id);
		elseif( $slug )
			$this->db->where('type_slug', $slug);

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
		
		$this->db->select('*');
		$this->db->from('resources');
		$this->db->join('resources_types', 'resources.resource_type = resources_types.type_id ');
		$this->db->join('status', 'resources.status = status.id and resources.status != "4"');
		$this->db->order_by('resource_date','desc');
		$this->db->where('resources_types.type_slug', $slug);
		$query = $this->db->get();
		return $query->result();

	}

	function delete_resource ($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('resource_id', $id);
		$this->db->update('resources', $data);
		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted a resource "'
			);
		$this->db->insert('statuses', $status_data);
	}

	function delete_type ($id) {
		$this->db->delete('resources_types', array('resource_id' => $id));
		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted a resource type'
			);
		$this->db->insert('statuses', $status_data);
	}

	function update_resource($id, $name, $preview, $download, $type, $status, $tweet)
	{
		$data = array(
			'resource_name'     => $name,
			'resource_preview'  => $preview,
			'resource_download' => $download,
			'resource_type'     => $type,
			'status'            => $status
			);

		$this->db->where('resource_id', $id);
		$this->db->update('resources', $data);
		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a resource : "'.$name
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