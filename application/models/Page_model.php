<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {
	function get_pages()
	{
		$this->db->order_by('page_date','desc');
		$this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()) {
			$this->db->where('status','3');
		} else {
			$this->db->where('status','3')->or_where('status','2');
		}
		$query = $this->db->get('page');
		return $query->result();
	}

	function get_all_pages()
	{
		$this->db->select('*');
		$this->db->from('page');
		$this->db->join('status', 'page.status = status.id and page.status != "4"');
		$this->db->order_by('page_date','desc');
		$query = $this->db->get();
		return $query->result();
	}


	function add_new_page($author, $name, $body, $slug, $status, $tweet)
	{
		$data = array(
			'author_id'		=> $author,
		 	'page_title'	=> $name,
		 	'page_body'		=> $body,
		 	'slug'			=> $slug,
		 	'status'		=> $status
		);
		$this->db->insert('page', $data);

		$query = $this->db->query('select page_id from page order by page_date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id->page_id;

		$status_data = array(
			'author_id'		=> $author,
		 	'status'		=> 'Added a new page: "'.$name.'" check it out here '.base_url().'p/'.$id,
		);
		$this->db->insert('statuses', $status_data);
	}

	function get_page($slug)
	{
		$this->db->where('slug', $slug);
		$query = $this->db->get('page');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_page_by_id($id)
	{
		$this->db->where('page_id', $id);
		$query = $this->db->get('page');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
		return FALSE;
	}


	function delete_page ($id) {
	    $this->db->delete('page', array('page_id' => $id)); 

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Deleted a page'
		);
		$this->db->insert('statuses', $status_data);
	}

	function update_page($id, $name, $body, $slug, $status)
	{
		$data = array(
		 	'page_title'	=> $name,
		 	'page_body'		=> $body,
		 	'slug'			=> $slug,
		 	'status'		=> $status
		);
		$this->db->where('page_id', $id);
		$this->db->update('page', $data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a page: "'.$name.'" check it out here '.base_url().'p/'.$id,
		);
		$this->db->insert('statuses', $status_data);
	}

}

/* End of file page_model.php */
/* Location: ./application/models/page_model.php */