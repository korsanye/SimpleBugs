<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	
	public function index()
	{
		$data['users'] = $this->simpleusers->users();
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/users/overview');
		$this->load->view('admin/footer');
	}
	
	public function create()
	{
		$data['name'] = '';
		$data['email'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('password_conf', 'lang:password_conf', 'required|matches[password]');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->simpleusers->create( set_value('name'), set_value('password'), set_value('email') );
			$this->session->set_flashdata('alert-success', lang('user_has_been_created'));
			redirect('admin/users');
			exit;		
		}
		
		
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/users/create_edit');
		$this->load->view('admin/footer');		
	}
	
	public function edit( $id = NULL )
	{
		if( ! $user = $this->simpleusers->user($id) )
		{
			show_404();
		}
		$data['name'] = $user->username;
		$data['email'] = $user->email;
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
			$this->simpleusers->update( $user->id, set_value('name'), set_value('email'), set_value('password') );
			$this->session->set_flashdata('alert-success', lang('user_has_been_saved'));
			redirect('admin/users');
			exit;		
		}
		
		
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/users/create_edit');
		$this->load->view('admin/footer');		
	}	
}