<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class look_model extends CI_Model {

	function get_sidebars()
	{
		$query = $this->db->get('sidebars');
		return $query->result();
	}

	function get_sidebar($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('sidebars');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}

	function get_website($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('websites');
		
		if( $query->num_rows() !== 0 )
		{
			return $query->result();
		}
		else
			return FALSE; // return false if no category in database
	}


	function get_socmeds()
	{
		$this->db->where('id','1');
		$query = $this->db->get('socmeds');
		return $query->result();
	}

	function get_websites()
	{
		$query = $this->db->get('websites');
		return $query->result();
	}


	function get_headers()
	{
		$this->db->where('id','1');
		$query = $this->db->get('headers');
		return $query->result();
	}
	
	function add_new_sidebar($name, $content)
	{
		$data = array(
			'name'		=> $name,
		 	'content'	=> $content,
		);
		$this->db->insert('sidebars',$data);
	}
	
	function add_new_website($name, $link, $icon, $description)
	{
		$data = array(
			'name'		=> $name,
		 	'link'	=> $link,
			'icon'		=> $icon,
		 	'description'	=> $description,
		);
		$this->db->insert('websites',$data);
	}
	
	function delete_sidebar ($id) {
	    $this->db->delete('sidebars', array('id' => $id)); 
	}
	
	function delete_website ($id) {
	    $this->db->delete('websites', array('id' => $id)); 
	}

	function update_sidebar($id, $name, $content)
	{
		$data = array(
		 	'name'	=> $name,
		 	'content'	=> $content,
		);
		$this->db->where('id', $id);
		$this->db->update('sidebars', $data);
	}

	function update_website($id, $name, $link, $icon, $description)
	{
		$data = array(
		 	'name'	=> $name,
		 	'link'	=> $link,
		 	'icon'	=> $icon,
		 	'description'	=> $description,
		);
		$this->db->where('id', $id);
		$this->db->update('websites', $data);
	}

	function update_header($link)
	{
		$data = array(
		 	'link'	=> $link,
		);
		$this->db->where('id', '1');
		$this->db->update('headers', $data);
	}

	function update_socmeds($codepen, $deviantart, $facebook, $flickr, $instagram, $linkedin, $soundcloud, $tumblr, $twitter, $youtube, $behance, $github)
	{
		$data = array(
		 	'codepen'	=> $codepen,
		 	'deviantart'	=> $deviantart,
		 	'facebook'	=> $facebook,
		 	'flickr'	=> $flickr,
		 	'instagram'	=> $instagram,
		 	'linkedin'	=> $linkedin,
		 	'soundcloud'	=> $soundcloud,
		 	'tumblr'	=> $tumblr,
		 	'twitter'	=> $twitter,
		 	'youtube'	=> $youtube,
		 	'behance'	=> $behance,
		 	'github'	=> $github,
		);

		$this->db->where('id', '1');
		$this->db->update('socmeds', $data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */