<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Los_Angeles");
	
	class messages extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// $this->output->enable_profiler(TRUE);

			$this->output->set_header("HTTP/1.0 200 OK");
			$this->output->set_header("HTTP/1.1 200 OK");
			$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
			$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			$this->load->model('user_model');
			$this->load->model('message_model');
		}

		public function index()
		{			
			$this->load->view('show_view');
		}

		public function show_by_email($email)
		{
			$user_by_email = $this->user_model->login($email);
			$this->session->set_userdata('to_user',$user_by_email);
			$to_user = $this->session->userdata['to_user'];

			$all_msgs = $this->message_model->get_allmsgs($to_user['id']);
			$this->session->set_userdata('all_msgs',$all_msgs);

			$all_comms = $this->message_model->get_allcomms($to_user['id']);
			$this->session->set_userdata('all_comms',$all_comms);

			redirect('/messages');
		}

		public function addmsg_act()
		{
			$msg = $this->input->post();
			$addmsg_success = $this->message_model->addmsg($msg);
			$all_msgs = $this->message_model->get_allmsgs($msg['to_user']);
			$this->session->set_userdata('all_msgs',$all_msgs);
			redirect('/messages');
		}

		public function add_comment_act()
		{
			$comment = $this->input->post();
			$addcomm_success = $this->message_model->add_comment($comment);
			$all_comms = $this->message_model->get_allcomms($comment['profile_id']);
			$this->session->set_userdata('all_comms',$all_comms);
			redirect('/messages');
		}



	}

?>