<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact_model extends CI_Model {

	function get_emails($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->order_by('date','desc'); // get all entry, sort by latest to oldest
		$query = $this->db->get('contacts');
		return $query->result();
	}

	public function total_count_emails() {
		return $this->db->count_all("contacts");
	}

	public function total_count_quesions() {
		$this->db->from('questions');
		$this->db->where('answer !=', '');
		return $this->db->count_all_results();
	}

	public function total_all_count_quesions() {
		return $this->db->count_all("questions");
	}

	function search_question($flag=false, $slug)
	{
		$query = "select * from questions where message like '%".$slug."%' or answer like '%".$slug."%' and answer != NULL";
		$posts=$this->db->query($query);
		return $posts->result(); // return an array of post object
	}

	function get_questions($flag = false, $limit, $start)
	{
		if($flag==true) {
			$this->db->where('answer !=','');
		}
		$this->db->order_by('date','desc'); // get all entry, sort by latest to oldest
		$this->db->limit($limit, $start);
		$query = $this->db->get('questions');
		return $query->result();
	}

	function get_question($id)
	{
		$this->db->where('id', $id); // get all entry, sort by latest to oldest
		$query = $this->db->get('questions');
		return $query->result();
	}

	function add_new_contact($name, $email, $message)
	{
		$data = array(
			'name'    => $name,
			'email'   => $email,
			'message' => $message,
			);
		$this->db->insert('contacts', $data);
	}

	function mark_read($id = "") {
		$data = array(
			'status'	=> '2'
			);
		if($id != "") $this->db->where('contact_id', $id);
		$this->db->update('contacts', $data);
	}

	function add_new_question($name, $message)
	{
		$data = array(
			'name'    => $name,
			'message' => $message,
			);
		$this->db->insert('questions', $data);
	}


	function answer_questions($id, $name, $question, $answer, $tweet)
	{
		$data = array(
			'answer'	=> $answer
			);
		$this->db->where('id', $id);
		$this->db->update('questions', $data);

		$status_data = array(
			'author_id'		=> 1,
			'status'		=> $name.' Asks: '.$question.' '.base_url().'contact/q',
			);
		$this->db->insert('statuses', $status_data);

		if($tweet == 1) {
			$this->load->model('social_model');
			$this->social_model->post_tweet($status_data['status']);
		}
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */