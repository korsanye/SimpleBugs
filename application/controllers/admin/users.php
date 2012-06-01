<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	
	public function index()
	{
		$data['users'] = $this->simpleusers->users();
		
		$data['main_content'] = 'admin/users/overview';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}
	
	public function create()
	{
		$data['id'] = 0;
		$data['name'] = '';
		$data['email'] = '';
		$data['is_admin'] = 0;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('password_conf', 'lang:password_conf', 'required|matches[password]');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->simpleusers->create( set_value('name'), set_value('password'), set_value('email'), $this->input->post('is_admin') );
			$this->session->set_flashdata('alert-success', lang('user_has_been_created'));
			redirect('admin/users');
			exit;		
		}
		
		
		
		$data['main_content'] = 'admin/users/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}
	
	public function edit( $id = NULL )
	{
		if( ! $user = $this->simpleusers->user($id) )
		{
			show_404();
		}
		$data['id'] = $user->id;
		$data['name'] = $user->username;
		$data['email'] = $user->email;
		$data['is_admin'] = $user->is_admin;		
		$data['edit'] = TRUE;

		
		$unique = "";
		if($this->input->post('email') != $user->email)
		{
			$unique = "|is_unique[users.email]";
		}
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email'.$unique);
		$this->form_validation->set_rules('password', 'lang:password', '');
		$this->form_validation->set_rules('password_conf', 'lang:password_conf', 'matches[password]');
		
		if ($this->form_validation->run() === TRUE)
		{
			$is_admin = $this->input->post('is_admin');
			if($user->id == 1)
			{
				$is_admin = TRUE;
			}
			
			$this->simpleusers->update( $user->id, set_value('name'), set_value('email'), set_value('password'), $is_admin );
			$this->session->set_flashdata('alert-success', lang('user_has_been_saved'));
			redirect('admin/users');
			exit;		
		}
		
		
		
		$data['main_content'] = 'admin/users/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}	
}