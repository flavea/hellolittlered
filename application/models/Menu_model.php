<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

	function get_parents()
	{
		
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('admin','0');
        }
        
		$this->db->where('parent','0');
		$this->db->order_by('priority','asc');
		$query = $this->db->get('menu');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
    }
    
	function get_children($id)
	{
		
		if (!$this->ion_auth->logged_in()) {
			$this->db->where('admin','0');
        }
        
		$this->db->where('parent',$id);
		$this->db->order_by('priority','asc');
		$query = $this->db->get('menu');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function get_menu($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('menu');
		if($query->num_rows()!==0)
		{
			return $query->result();
		}
		else
			return FALSE;
	}
	
	function add_menu($menu_en, $menu_id, $link, $parent, $priority, $admin, $status)
	{
		$data = array(
			'menu_en'		=> $menu_en,
			'menu_id'	=> $menu_id,
			'link'	=> $link,
			'parent'	=> $parent,
			'priority'	=> $priority,
			'admin'	=> $admin,
			'status'		=> $status
			);
		$this->db->insert('menu', $data);
	}

	function delete_menu ($id) {
		$this->db->where('id', $id);
		$this->db->delete('menu');
	}

	function update_menu($id, $menu_en, $menu_id, $link, $parent, $priority, $admin, $status)
	{
		$data = array(
			'menu_en'		=> $menu_en,
			'menu_id'	=> $menu_id,
			'link'	=> $link,
			'parent'	=> $parent,
			'priority'	=> $priority,
			'admin'	=> $admin,
			'status'		=> $status
			);

		$this->db->where('id', $id);
		$this->db->update('menu', $data);
	}
}

/* End of file blog_model.php */
/* Location: ./application/models/blog_model.php */