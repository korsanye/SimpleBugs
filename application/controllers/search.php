<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
	
	public function index()
	{
		if( $this->input->post('search') )
		{
			$parts = explode(" ", $this->input->post('search'));
			if(count($parts) == 1)
			{
				if( $issue = $this->issues_model->get_issue( (int)$parts[0] ) )
				{
					redirect(site_url($issue->id));	
				}
			}
		
		}
	}
	
	
}