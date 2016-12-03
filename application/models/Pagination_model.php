<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pagination_model extends CI_Model
{
    public function __construct() {
       parent::__construct();
    }
    public function total_count() {
       return $this->db->count_all("entry");
    }
    public function total_themes() {
       return $this->db->count_all("theme");
    }
    public function get_entries($limit, $start) {
      $this->db->limit($limit, $start);
      $query = $this->db->get("entry");
      if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return false;
   }
}