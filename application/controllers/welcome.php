<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function index()
	{
		$data['issues'] = $this->issues_model->get_issues();
		$this->load->vars($data);
		$this->load->view('header');
		$this->load->view('issues/overview');
		$this->load->view('footer');				
	}
	
	
}