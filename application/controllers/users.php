<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("America/Los_Angeles");
	
	class Users extends CI_Controller
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
		}

		public function index()
		{
			$this->load->view('view_main');
		}

		public function login_view()
		{
			$this->load->view('login_view');
		}

		public function regis_view()
		{
			$this->load->view('regis_view');
		}

		public function admin_edit_view($email)
		{
			$user_by_email = $this->user_model->login($email);
			$this->load->view('admin_edit_view',$user_by_email);
		}

		public function user_edit_view($email)
		{
			$user_by_email = $this->user_model->login($email);
			$this->load->view('user_edit_view',$user_by_email);
		}

		public function remove_view()
		{
			$thits->load->view('remove_view');
		}

		public function dashboard()
		{
			if ($this->session->userdata['user_info']['level']==9) 
			{
				$this->load->view('admin_view');
			}
			else
			{
				$this->load->view('user_view');
			}
		}

		public function addnew_view()
		{
			$this->load->view('addnew_view');
		}

		public function regis_act()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email','Email Address','valid_email|required|is_unique[users.email]');
			$this->form_validation->set_rules('password','Password','min_length[8]|required');
			$this->form_validation->set_rules('password_confirm','Confirm Password','matches[password]|required');

			if ($this->form_validation->run() == FALSE) 
			{
				$validation['errors'] = validation_errors();				
				$this->session->set_flashdata('regis_error_msg',$validation['errors']);
				redirect('/users/regis_view');
			}
			else
			{
				$regis_success = $this->user_model->add_user($this->input->post());
				$this->session->set_userdata('login',$regis_success);
				$user_by_email = $this->user_model->login($this->input->post('email'));
				$this->session->set_userdata('user_info',$user_by_email);
				$all_users = $this->user_model->get_all_users();
				$this->session->set_userdata('all_users_info',$all_users);
				redirect('/users/dashboard');
			}							
		}

		public function addnew_act()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email','Email Address','valid_email|required|is_unique[users.email]');
			$this->form_validation->set_rules('password','Password','min_length[8]|required');
			$this->form_validation->set_rules('password_confirm','Confirm Password','matches[password]|required');

			if ($this->form_validation->run() == FALSE) 
			{
				$validation['errors'] = validation_errors();				
				$this->session->set_flashdata('addnew_error_msg',$validation['errors']);
				redirect('/users/addnew_view');
			}
			else
			{
				$regis_success = $this->user_model->add_user($this->input->post());
				$this->session->set_userdata('login',$regis_success);
				$all_users = $this->user_model->get_all_users();
				$this->session->set_userdata('all_users_info',$all_users);
				redirect('/users/dashboard');
			}					
		}

		public function logoff_act()
		{
			$this->session->sess_destroy();
			redirect('/users/login_view');
		}

		public function login_act()
		{			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email Address','valid_email|required');
			$this->form_validation->set_rules('password','Password','min_length[8]|required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$validation['errors'] = validation_errors();				
				$this->session->set_flashdata('login_error_msg',$validation['errors']);
				redirect('/users/login_view');
			}
			else
			{
				$user_by_email = $this->user_model->login($this->input->post('email'));
			
				if (!$user_by_email)
				{
					$this->session->set_flashdata('login_error_msg','<p>Email is not registered in the system. Please register to login.<p>');
					redirect('/users/login_view');
				}
				
				if($this->input->post('password')!=$user_by_email['password'])
				{
					$this->session->set_flashdata('login_error_msg','<p>Incorrect password.<p>');
					redirect('/users/login_view');
				}

				if ($this->input->post('password')==$user_by_email['password'])
				{
					$this->session->set_userdata('login',TRUE);
					$this->session->set_userdata('user_info',$user_by_email);
					$all_users = $this->user_model->get_all_users();
					$this->session->set_userdata('all_users_info',$all_users);
					redirect('/users/dashboard');
				}
			}
		}

		public function edit_user_act()
		{
			$user_by_email = $this->input->post();

			// Check if an admin changing his/her own user level, not allow change of level if there is only one admin in the database.
			if ($this->session->userdata['user_info']['level']==9 AND $user_by_email['id']==$this->session->userdata['user_info']['id'])
			{
				$admin_num = $this->user_model->admin_num();
				if ($admin_num['COUNT(level)']==1)
				{
					$this->session->set_flashdata("error_msg","<p>Cannot change user #".$user_by_email['id']." to normal-level user. There must be at least one user with admin level.</p>");
					redirect('/users/dashboard');
				}
			}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('email','Email Address','valid_email|required');
			$this->form_validation->set_rules('password','Password','min_length[8]|required');
			$this->form_validation->set_rules('password_confirm','Confirm Password','matches[password]|required');

			if ($this->form_validation->run() == FALSE) 
			{
				$validation['errors'] = validation_errors();				
				$this->session->set_flashdata('error_msg',$validation['errors']);
				redirect('/users/dashboard');
			}
			else
			{
				$edit_success = $this->user_model->edit_user($user_by_email);
				$all_users = $this->user_model->get_all_users();
				$this->session->set_userdata('all_users_info',$all_users);
				$user_by_email = $this->user_model->login($this->input->post('email'));
				$this->session->set_userdata('user_info',$user_by_email);
				redirect('/users/dashboard');
			}
		}

		public function remove_act($email)
		{
			$remove_success = $this->user_model->remove($email);

			//Check if an admin delete him/her own account. If so, log off after deleting the account.
			$user_by_email = $this->user_model->login($this->session->userdata['user_info']['email']);
			if (!$user_by_email)
			{
				redirect('/users/logoff_act');
			}
			else
			{
				$all_users = $this->user_model->get_all_users();
				$this->session->set_userdata('all_users_info',$all_users);
				redirect('/users/dashboard');
			}
		}

	}

?>