<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects_model extends CI_Model {

	function get_projects() 
	{
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$query = $this->db->get('projects');
		return $query->result();
	}

	function get_all_projects() 
	{
		$this->db->select('projects.*, status.name as status_name');
		$this->db->from('projects');
		$this->db->join('status', 'projects.status = status.id and projects.status != "4"');
		$this->db->order_by('date_up','desc');
		$query = $this->db->get();
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
		$query = $this->db->query('select * from projects where status = "3" order by id DESC limit 1');
		return $query->result();
	}

	function add_new_project($name, $image, $exp, $exp_id, $link, $behance, $status, $tweet)
	{
		$data = array(
			'name'    => $name,
			'img'     => $image,
			'exp'     => $exp,
			'exp_id'  => $exp_id,
			'link'    => $link,
			'behance' => $behance,
			'status'  => $status
			);
		print_r($data);
		$this->db->insert('projects', $data);

		$query = $this->db->query('select id from projects order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'project',
			);
		$this->db->insert('master', $master_data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Added a new project: "'.$name.'" check it out here '.base_url().'projects/',
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}

	function delete_project($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('id', $id);
		$this->db->update('projects', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted a project'
			);
		$this->db->insert('statuses', $status_data);
	}

	function update_project($id, $name, $image, $exp, $exp_id, $link, $behance, $status, $tweet)
	{
		$data = array(
			'name'    => $name,
			'img'     => $image,
			'exp'     => $exp,
			'exp_id'  => $exp_id,
			'link'    => $link,
			'behance' => $behance,
			'status'  => $status
			);
		$this->db->where('id', $id);
		$this->db->update('projects', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a project item: "'.$name.'" check it out here '.base_url().'projects',
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}

	function get_experiments() 
	{
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$query = $this->db->get('lab');
		return $query->result();
	}

	function get_all_experiments() 
	{
		$this->db->select('lab.*, status.name as status_name');
		$this->db->from('lab');
		$this->db->join('status', 'lab.status = status.id and lab.status != "4"');
		$this->db->order_by('date_up','desc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_experiment($id) 
	{
		$this->db->where('id', $id);
		$query = $this->db->get('lab');
		return $query->result();
	}

	function get_latest_experiment() 
	{
		$query = $this->db->query('select * from lab where status = "3" order by id DESC limit 2');
		return $query->result();
	}

	function add_new_experiment($name, $image, $link, $code, $description, $description_id, $status, $tweet)
	{
		$data = array(
			'name'        => $name,
			'image'       => $image,
			'link'        => $link,
			'code'        => $code,
			'description' => $description,
			'description_id' => $description_id,
			'status'      => $status
			);
		$this->db->insert('lab', $data);

		$query = $this->db->query('select id from lab order by id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'lab',
			);
		$this->db->insert('master', $master_data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Added a new experiment: "'.$name.'" check it out here '.$link
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}

	function delete_experiment($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('id', $id);
		$this->db->update('lab', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted an experiment'
			);
		$this->db->insert('statuses', $status_data);
	}

	function update_experiment($id, $name, $image, $link, $code, $description, $description_id, $status, $tweet)
	{
		$data = array(
			'name'        => $name,
			'image'       => $image,
			'link'        => $link,
			'code'        => $code,
			'description' => $description,
			'description_id' => $description_id,
			'status'      => $status
			);
		$this->db->where('id', $id);
		$this->db->update('lab', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a experiment: "'.$name.'" check it out here '.$link
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