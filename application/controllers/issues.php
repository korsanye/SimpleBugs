<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issues extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$data['users'] = $this->simpleusers->users();
		$data['categories'] = $this->categories_model->categories();
		$data['priorities'] = $this->priorities_model->priorities();
		$data['projects'] = $this->projects_model->projects();
		$data['milestones'] = $this->milestones_model->milestones();
		$this->load->vars($data);
	}

	public function index()
	{
	
	}
	
	public function create()
	{
		$this->load->view('header');
		$this->load->view('issues/assign');
		$this->load->view('footer');
	}
	
	public function view( $issue )
	{
		$this->load->view('header');
		$this->load->view('footer');
	}

	public function assign( $issue )
	{
		$this->load->view('header');
		$this->load->view('footer');
	}
	

}