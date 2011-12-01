<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * NOTICE OF LICENSE
 * 
 * Licensed under the Academic Free License version 3.0
 * 
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

class Setup extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hostname', 'Hostname', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('database', 'database', 'trim|required');
		$this->form_validation->set_rules('dbprefix', 'Prefix', 'trim');
		
		$this->form_validation->set_rules('admin_username', 'Admin Username', 'trim|required');
		$this->form_validation->set_rules('admin_email', 'Admin email', 'trim|required|valid_email');
		$this->form_validation->set_rules('admin_password', 'Admin Password', 'trim|required|matches[admin_passconf]');
		$this->form_validation->set_rules('admin_passconf', 'Password confirmation', 'required');
				
		if ($this->form_validation->run() == TRUE)
		{					
			$db_config['hostname'] = $this->input->post('hostname');
			$db_config['username'] = $this->input->post('username');
			$db_config['password'] = $this->input->post('password');
			$db_config['database'] = $this->input->post('database');
			$db_config['dbprefix'] = $this->input->post('dbprefix');
		  $db_config['dbdriver'] = 'mysql';
			if( ! $this->_db_connection_test($db_config) )
				$data["errors"][] = "A connection to the database could not be made. Please verify your connection settings provided.";			
			
			
			$this->load->vars($data);
		}
	
		$this->load->view('installation');
	}
	
	
	/**
	 * DB Driver Test
	 *
	 * Test a given driver to ensure the server can use it. We'll also create the
	 * database here if we need to.
	 *
	 * @access	private
	 * @param	array
	 * @return	bool
	 */
	private function _db_connection_test($db_config)
	{
		unset($this->db);
		$db_config['db_debug'] = FALSE;
		$this->load->database($db_config);

		if (is_resource($this->db->conn_id) OR is_object($this->db->conn_id))
		{
			$this->load->dbutil();
			
			if ($this->dbutil->database_exists($this->db->database))
			{
				return TRUE;
			}
			else
			{
				$this->load->dbforge();
				if ($this->dbforge->create_database($this->db->database))
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
		else
		{
			return FALSE;
		}
	}	
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */