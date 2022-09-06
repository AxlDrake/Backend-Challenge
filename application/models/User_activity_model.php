<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_activity_model extends CI_Model {

	private $table = 'user_activities';	

	public function get_by($column, $value)
	{
		$this->db->select('ua.*');
		$this->db->from('user_activities ua');
		$this->db->join('users u', 'u.id = ua.uid', 'left');
		$this->db->where("ua.$column", $value);
		$this->db->where('u.id is NOT NULL', NULL, FALSE);	
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}

		return FALSE;
		
	}


}
