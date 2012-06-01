<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milestones extends MY_Controller {
	
	public function index()
	{
		$data['milestones'] = $this->milestones_model->milestones();
			
		$data['main_content'] = 'admin/milestones/overview';
		$this->load->vars($data);
		$this->load->view('admin/template');						
		
	}
	
	public function create()
	{		
		$data['name'] = '';
		$data['milestone'] = date('Y-m-d', strtotime('+1 month'));
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('milestone', 'lang:milestone_date', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->milestones_model->create( set_value('name'), set_value('milestone') );
			$this->session->set_flashdata('alert-success', lang('milestone_has_been_created'));
			redirect('admin/milestones');
			exit;		
		}

		$data['main_content'] = 'admin/milestones/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');						
	}
	
	public function edit( $id )
	{		
		if( ! $milestone = $this->milestones_model->milestone($id) )
		{
			show_404();
		}
		
		$data['name'] = $milestone->name;
		$data['milestone'] = $milestone->milestone;
		$data['edit'] = TRUE;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('milestone', 'lang:milestone_date', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->milestones_model->update( $milestone->id, set_value('name'), set_value('milestone') );
			$this->session->set_flashdata('alert-success', lang('milestone_has_been_saved'));
			redirect('admin/milestones');
			exit;		
		}

		$data['main_content'] = 'admin/milestones/create_edit';
		$this->load->vars($data);
		$this->load->view('admin/template');						
	}
}