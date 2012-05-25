<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('simpleusers');
		
		if( ! $this->simpleusers->logged_in() && $this->uri->segment(1) != 'login' )
		{
			if( ! $this->session->userdata('uri') && $this->uri->segment(1) != 'login' )
			{
				$this->session->set_userdata('uri', $this->uri->uri_string());
			}
			
			redirect(site_url('login'));
		}
		
	}
		
}