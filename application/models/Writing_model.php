<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class writing_model extends CI_Model {
	
	function total_count() {
       return $this->db->count_all("writing");
    }
	
	
	function add_new_story($title,$type,$genre,$rating,$fandom,$pairs,$summary,$link1,$link2,$link3,$hide)
	{
		$data = array(
		 	'title'	=> $title,
		 	'type'=> $type,
		 	'genre'	=> $genre,
		 	'rating'	=> $rating,
		 	'fandom'	=> $fandom,
		 	'pairs'	=> $pairs,
		 	'summary'	=> $summary,
		 	'read1'	=> $link1,
		 	'read2'	=> $link2,
		 	'read3'	=> $link3,
		 	'hide'	=> $hide,
		);
		$this->db->insert('writing',$data);
		/*$query = $this->db->query('select id from writing order by date DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'writing',
		);
		$this->db->insert('master',$master_data);

		$status_data = array(
			'author_id'		=> $author,
		 	'status'		=> 'Added a new story: "'.$title.'" check it out here '.base_url().'writing/',
		);
		$this->db->insert('statuses',$status_data);*/
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

	function get_stories()
	{
		$query = $this->db->get('writing'); 
		return $query->result();
	}
	

	function delete_writing($id) {
	    $this->db->delete('writing', array('id' => $id)); 
	}


	function update_story($id,$title,$type,$genre,$rating,$fandom,$pairs,$summary,$link1,$link2,$link3,$hide)
	{
		$data = array(
		 	'title'	=> $title,
		 	'type'=> $type,
		 	'genre'	=> $genre,
		 	'rating'	=> $rating,
		 	'fandom'	=> $fandom,
		 	'pairs'	=> $pairs,
		 	'summary'	=> $summary,
		 	'read1'	=> $link1,
		 	'read2'	=> $link2,
		 	'read3'	=> $link3,
		 	'hide'	=> $link4,
		);
		$this->db->where('id', $id);
		$this->db->update('writing', $data);

		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a story: "'.$title.'" check it out here '.base_url().'writing/',
		);
		$this->db->insert('statuses',$status_data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */