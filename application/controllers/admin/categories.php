<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {
	
	public function index()
	{
		$data['categories'] = $this->categories_model->categories();
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/categories/overview');
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
			$this->categories_model->create( set_value('name'), $this->input->post('default') );
			$this->session->set_flashdata('alert-success', lang('category_has_been_created'));
			redirect('admin/categories');
			exit;		
		}

		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/categories/create_edit');
		$this->load->view('admin/footer');				
	}
	
	public function edit( $id )
	{		
		
		if( ! $category = $this->categories_model->category($id) )
		{
			show_404();
		}
		
		$data['name'] = $category->name;
		$data['default'] = $category->default;
		$data['edit'] = TRUE;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('default', 'lang:set_as_default', '');

		if ($this->form_validation->run() === TRUE)
		{
						$this->categories_model->update( $category->id, set_value('name'), $this->input->post('default') );
			$this->session->set_flashdata('alert-success', lang('category_has_been_saved'));
			redirect('admin/categories');
			exit;		
		}

		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/categories/create_edit');
		$this->load->view('admin/footer');				
	}
	
	public function delete( $id )
	{
		if( ! $category = $this->categories_model->category( $id ) )
		{
			show_404();
		}
		
		if( $this->input->post('delete') )
		{
			$this->categories_model->delete( $id );
			redirect('admin/categories');
			exit;
		}
		
		$data['category'] = $category;
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/categories/delete');
		$this->load->view('admin/footer');
		
	}
		
}