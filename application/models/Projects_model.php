<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects_model extends CI_Model {

	function get_projects() 
	{
		$query = $this->db->get('projects');
		return $query->result();
	}

	function get_project($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('projects');
		return $query->result();
	}

	function get_latest_project() 
	{
		$query = $this->db->query('select * from projects order by id DESC limit 1');
		return $query->result();
	}

	function add_new_project($name,$image,$exp,$link, $behance)
	{
		$data = array(
		 	'name'	=> $name,
		 	'img'	=> $image,
		 	'exp'	=> $exp,
		 	'link'	=> $link,
		 	'behance'	=> $behance
		);
		print_r($data);
		$this->db->insert('projects',$data);

		$query = $this->db->query('select id from projects order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'project',
		);
		$this->db->insert('master',$master_data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Added a new project: "'.$name.'" check it out here '.base_url().'projects/',
		);
		$this->db->insert('statuses',$status_data);

		$this->load->model('social_model');
		$this->social_model->post_tweet($status_data['status']);
	}

	function delete_project($id) {
	    $this->db->delete('projects', array('id' => $id)); 
	    $this->db->delete('master', array('object_id' => $id, 'object_type' => 'project')); 
	}

	function update_project($id,$name,$image,$exp,$link, $behance)
	{
		$data = array(
		 	'name'	=> $name,
		 	'img'	=> $image,
		 	'exp'	=> $exp,
		 	'link'	=> $link,
		 	'behance'	=> $behance
		);
		$this->db->where('id', $id);
		$this->db->update('projects', $data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a project item: "'.$name.'" check it out here '.base_url().'projects',
		);
		$this->db->insert('statuses',$status_data);

		
		$this->load->model('social_model');
		$this->social_model->post_tweet($status_data['status']);
	}

	
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */