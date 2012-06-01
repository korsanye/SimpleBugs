<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller {
		
	public function index()
	{
		$data['projects'] = $this->projects_model->projects();
		
		$data['main_content'] = 'admin/projects/overview';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}
	
	public function create()
	{		
		$data['name'] = '';
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->projects_model->create( set_value('name') );
			$this->session->set_flashdata('alert-success', lang('project_has_been_created'));
			redirect('admin/projects');
			exit;		
		}

		$data['main_content'] = 'admin/projects/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}
	
	public function edit( $id )
	{		
		
		if( ! $project = $this->projects_model->project($id) )
		{
			show_404();
		}
		
		$data['name'] = $project->name;
		$data['edit'] = TRUE;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->projects_model->update( $project->id, set_value('name') );
			$this->session->set_flashdata('alert-success', lang('project_has_been_saved'));
			redirect('admin/projects');
			exit;		
		}

		$data['main_content'] = 'admin/projects/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');				
	}	
	
}