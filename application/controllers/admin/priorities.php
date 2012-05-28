<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priorities extends MY_Controller {
	
	public function index()
	{
		$data['priorities'] = $this->priorities_model->priorities();
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/priorities/overview');
		$this->load->view('admin/footer');

	}
	
	public function create()
	{		
		$data['name'] = '';
		$data['default'] = 0;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->priorities_model->create( set_value('name'), $this->input->post('default') );
			$this->session->set_flashdata('alert-success', lang('priority_has_been_created'));
			redirect('admin/priorities');
			exit;		
		}

		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/priorities/create_edit');
		$this->load->view('admin/footer');				
	}
	
	public function edit( $id )
	{		
		
		if( ! $priority = $this->priorities_model->priority($id) )
		{
			show_404();
		}
		
		$data['name'] = $priority->name;
		$data['default'] = $priority->default;
		$data['edit'] = TRUE;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		
		if ($this->form_validation->run() === TRUE)
		{
			$this->priorities_model->update( $priority->id, set_value('name'), $this->input->post('default') );
			$this->session->set_flashdata('alert-success', lang('priority_has_been_saved'));
			redirect('admin/priorities');
			exit;		
		}

		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/priorities/create_edit');
		$this->load->view('admin/footer');				
	}	
	
	public function delete( $id )
	{
		if( ! $priority = $this->priorities_model->priority( $id ) )
		{
			show_404();
		}
		
		if( $this->input->post('delete') )
		{
			$this->priorities_model->delete( $id );
			redirect('admin/priorities');
			exit;
		}
		
		$data['priority'] = $priority;
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/priorities/delete');
		$this->load->view('admin/footer');
		
	}
	
	public function sort( $way, $id )
	{
		if( ! $priority = $this->priorities_model->priority( $id ) )
		{
			show_404();
		}
		
		
		if($way == "up")
		{
			$this->priorities_model->sort_up($id);
		}

		if($way == "down")
		{
			$this->priorities_model->sort_down($id);
		}		
		
		redirect('admin/priorities');
	}
	
}