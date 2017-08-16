<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class writing_model extends CI_Model {
	
	function total_count() {
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->from('writing');
		return $this->db->count_all_results();
	}

	function total_all_count() {
		$this->db->select('writing.*, status.name');
		$this->db->from('writing');
		$this->db->join('status', 'writing.status = status.id and writing.status != "4"');
		return $this->db->count_all_results();
	}
	
	function add_new_story($title, $type, $genre, $rating, $fandom, $pairs, $summary, $link1, $link2, $link3, $status, $tweet)
	{
		$genres = "";
		foreach($genre as $g)
		{
			$genres .= $g.", ";
		}
		$data = array(
			'title'	=> $title,
			'type'=> $type,
			'genre'	=> $genres,
			'rating'	=> $rating,
			'fandom'	=> $fandom,
			'pairs'	=> $pairs,
			'summary'	=> $summary,
			'read1'	=> $link1,
			'read2'	=> $link2,
			'read3'	=> $link3,
			'status'	=> $status,
			);
		$this->db->insert('writing', $data);
		$query = $this->db->query('select id from writing order by date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
			'object_type'	=> 'writing',
			);
		$this->db->insert('master', $master_data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Added a new story: "'.$title.'" check it out here '.base_url().'writing/',
			);
		$this->db->insert('statuses', $status_data);
		
		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
	
	function get_story($id)
	{
		$this->db->where('id', $id);
		
		$query = $this->db->get('writing');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_stories($limit=false, $start=false)
	{
		if($limit != false || $start!=false) {
			$this->db->limit($limit, $start);

		}
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$this->db->order_by("id", "desc");
		$query = $this->db->get('writing'); 
		return $query->result();
	}

	function get_all_stories($limit=false, $start=false)
	{
		if($limit != false || $start!=false) {
			$this->db->limit($limit, $start);

		}
		$this->db->select('writing.*, status.name');
		$this->db->from('writing');
		$this->db->join('status', 'writing.status = status.id and writing.status != "4"');
		$this->db->order_by("writing.id", "desc");
		$query = $this->db->get(); 
		return $query->result();
	}

	function delete_writing($id) {
		$data = array(
			'status'	=> '4'
			);
		$this->db->where('id', $id);
		$this->db->update('writing', $data);
		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Deleted a story',
			);
		$this->db->insert('statuses', $status_data);
	}


	function update_story($id, $title, $type, $genre, $rating, $fandom, $pairs, $summary, $link1, $link2, $link3, $status, $tweet)
	{
		$genres = "";
		foreach($genre as $g)
		{
			$genres .= $g.", ";
		}
		$data = array(
			'title'   => $title,
			'type'    => $type,
			'genre'   => $genres,
			'rating'  => $rating,
			'fandom'  => $fandom,
			'pairs'   => $pairs,
			'summary' => $summary,
			'read1'   => $link1,
			'read2'   => $link2,
			'read3'   => $link3,
			'status'  => $status,
			);
		$this->db->where('id', $id);
		$this->db->update('writing', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> 'Updated a story: "'.$title.'" check it out here '.base_url().'writing/',
			);
		$this->db->insert('statuses', $status_data);

		if($status == 3 && $tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
	
	function get_fic_rec($limit=false, $start=false)
	{
		if($limit != false || $start!=false) {
			$this->db->limit($limit, $start);

		}
		$this->load->library('ion_auth');
		$this->db->where('status','1');
		$this->db->order_by("pairs", "asc");
		$query = $this->db->get('ficrec'); 
		return $query->result();
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */