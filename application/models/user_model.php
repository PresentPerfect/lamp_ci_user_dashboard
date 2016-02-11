<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Los_Angeles");

class User_model extends CI_Model
{
	public function add_user($user_info)
	{
		$have_user = $this->db->query("SELECT * FROM users LIMIT 1")->row_array();

		if (!$have_user)
		{
			$query="INSERT INTO users (email, first_name, last_name, password, level, created_at, updated_at) VALUES(?,?,?,?,?,?,?)";
			$values = array($user_info['email'], $user_info['first_name'],$user_info['last_name'], $user_info['password'],9,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'));
			return $this->db->query($query,$values);
		}
		else
		{
			$query="INSERT INTO users (email, first_name, last_name, password, level, created_at, updated_at) VALUES(?,?,?,?,?,?,?)";
			$values = array($user_info['email'], $user_info['first_name'],$user_info['last_name'], $user_info['password'],1,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'));
			return $this->db->query($query,$values);
		}		
	}

	public function login($email)
	{
		$query = "SELECT * FROM users WHERE email=?";
		return $this->db->query($query,array($email))->row_array();
	}

	public function get_user($id)
	{
		$query = "SELECT * FROM users WHERE id=?";
		return $this->db->query($query,array($id))->row_array();
	}

	public function get_all_users()
	{
		return $this->db->query("SELECT * FROM users")->result_array();
	}

	public function edit_user($user_info)
	{
		if ($this->session->userdata['user_info']['level']==9)
		{
			$query = "UPDATE users SET email=?,first_name=?,last_name=?,level=?,password=?, updated_at=? WHERE id=?";
			$values = array($user_info['email'],$user_info['first_name'],$user_info['last_name'],$user_info['level'],$user_info['password'],date('Y-m-d H:i:s'),$user_info['id']);
			return $this->db->query($query,$values);
		}
		if ($this->session->userdata['user_info']['level']==1)
		{
			$query = "UPDATE users SET email=?,first_name=?,last_name=?,password=?, updated_at=? WHERE id=?";
			$values = array($user_info['email'],$user_info['first_name'],$user_info['last_name'],$user_info['password'],date('Y-m-d H:i:s'),$user_info['id']);
			return $this->db->query($query,$values);
		}
		
	}

	public function admin_num()
	{
		return $this->db->query('SELECT COUNT(level) FROM users WHERE level=?',array(9))->row_array();
	}

	public function remove($email)
	{
		return $this->db->query('DELETE FROM users WHERE email=?',array($email));
	}
}

?>