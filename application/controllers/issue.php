<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends MY_Controller {
	
	public function index()
	{
		$this->load->view('header');
		
		$this->load->view('footer');
	}
	
	public function view( $id )
	{
		$this->output->set_output($id);
	}
	
}