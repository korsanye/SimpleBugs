<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function index()
	{

		if( $this->input->post() !== FALSE )
		{
			$remember_me = (bool)$this->input->post('remember_me');
			if( ! $this->simpleusers->login($this->input->post('email'), $this->input->post('password'), $remember_me) )
			{
				$data['login_error'] = true;
				$this->load->vars($data);
			}
			else
			{
				if( $this->session->userdata('uri') )
				{
					$url = site_url( $this->session->userdata('uri') );
				}
				else
				{
					$url = base_url();
				}
				redirect($url);
				exit;
			}
		}
			
		$this->load->view('login');		
	}
	
	
}