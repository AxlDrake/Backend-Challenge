<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	private $table = 'users';	

	public function insert_user($email, $password)
	{
		$data = array(
			'email' => $email,
			'password' => md5($password)
		);

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function get_user($email, $password)
	{
		$data = array(
			'email' => $email,
			'password' => md5($password)
		);
		
		$this->db->select('id');
		$this->db->where($data);
		$query = $this->db->get($this->table);
		
		if(!$query->num_rows())
		{	
			return FALSE;
		}
		
		return $query->row()->id;
	}	

	public function get($uid)
	{
		$this->db->where('id', $uid);
		$query = $this->db->get($this->table);

		if($query->num_rows() > 0)
		{
			return $query->row();
		}

		return $query;
	}


	public function check_email($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->num_rows();	
	}

}
