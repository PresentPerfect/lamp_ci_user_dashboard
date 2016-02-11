<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Los_Angeles");

class Message_model extends CI_Model
{
	public function addmsg($msg)
	{
		$query = "INSERT INTO messages(message,from_user,to_user,created_at,updated_at) VALUES(?,?,?,?,?)";
		$values= array($msg['message'],$msg['from_user'],$msg['to_user'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s'));
		return $this->db->query($query,$values);
	}

	public function get_allmsgs($id)
	{
		$query = "SELECT messages.id AS message_id, message,messages.created_at, from_user AS from_user_id, CONCAT(first_name,' ',last_name) AS from_user_name, users.email AS from_user_email, messages.to_user AS to_user_id FROM messages LEFT JOIN users ON messages.from_user=users.id
			WHERE to_user=? ORDER BY messages.created_at DESC";
		return $this->db->query($query,array($id))->result_array();
	}

	public function add_comment($comment)
	{
		$query = "INSERT INTO comments(comment,message_id,author_id,profile_id,profile_email, created_at,updated_at) VALUES(?,?,?,?,?,?,?)";
		$values= array($comment['comment'],$comment['message_id'],$comment['author_id'],$comment['profile_id'],$comment['profile_email'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s'));
		return $this->db->query($query,$values);
	}

	public function get_allcomms($profile_id)
	{
		$query = "SELECT comments.id,comments.comment,comments.created_at, message_id, author_id, CONCAT(first_name,' ',last_name) AS author_name, users.email AS author_email 
			FROM comments LEFT JOIN users ON comments.author_id=users.id
			WHERE comments.message_id IN (SELECT id FROM messages WHERE to_user=?)
			ORDER BY comments.id desc";
		return $this->db->query($query,array($profile_id))->result_array();

	}
}

?>