<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class photo_model extends CI_Model {
	
	function total_count() {
       return $this->db->count_all("photo_album");
    }
	
	
	function add_new_album($author,$name,$location,$date,$cover,$story,$embed)
	{
		$data = array(
			'author_id'		=> $author,
		 	'album_name'	=> $name,
		 	'album_location'=> $location,
		 	'album_date'	=> $date,
		 	'album_cover'	=> $cover,
		 	'album_story'	=> $story,
		 	'album_embed'	=> $embed,
		);
		$this->db->insert('photo_album',$data);
		$query = $this->db->query('select album_id from photo_album order by album_id DESC limit 1');
		$object_id = max($query->result());
		$id = $object_id -> album_id;

		$master_data = array(
			'object_id'		=> $id,
		 	'object_type'	=> 'album',
		);
		$this->db->insert('master',$master_data);

		$status_data = array(
			'author_id'		=> $author,
		 	'status'		=> 'Posted a new photo album: "'.$name.'" check it out here '.base_url().'album/'.$id,
		);
		$this->db->insert('statuses',$status_data);
	}
	
	function get_album($id)
	{
		$this->db->where('album_id',$id);
		
		$query = $this->db->get('photo_album');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE;
	}

	function get_albums()
	{
		$query = $this->db->get('photo_album'); 
		return $query->result();
	}
	

	function delete_album($id) {
	    $this->db->delete('photo_album', array('album_id' => $id)); 
	}


	function update_album($id,$name,$location,$date,$cover,$story,$embed)
	{
		$data = array(
		 	'album_name'	=> $name,
		 	'album_location'=> $location,
		 	'album_date'	=> $date,
		 	'album_cover'	=> $cover,
		 	'album_story'	=> $story,
		 	'album_embed'	=> $embed,
		);
		$this->db->where('album_id', $id);
		$this->db->update('photo_album', $data);


		$status_data = array(
			'author_id'		=> 1,
		 	'status'		=> 'Updated a photo album: "'.$name.'" check it out here '.base_url().'album/'.$id,
		);
		$this->db->insert('statuses',$status_data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */