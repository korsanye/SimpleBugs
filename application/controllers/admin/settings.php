<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {
	
	public function index()
	{
		if( $this->input->post() )
		{
			
			$this->settings_model->set('date_format', $this->input->post('date_format'));
			$this->session->set_flashdata('alert-info', lang('settings_updated'));
			redirect('admin/settings');
			exit;
		}


		$this->load->helper('form');
		$data['date_format'] = $this->settings_model->get('date_format', "Y-m-d");
		
		
		
		$this->load->vars($data);
		$this->load->view('admin/header');
		$this->load->view('admin/settings');
		$this->load->view('admin/footer');
	}
}