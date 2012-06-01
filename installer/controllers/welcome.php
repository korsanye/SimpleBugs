<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $path;
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('setup');
		$this->load->helper(array('language', 'url', 'form', 'string'));
		$this->load->library('form_validation');
		$this->config->set_item('encryption_key', 'tmp');			
	}
	
	public function index()
	{
		
		// Precheck of files needed to be modified before installation
		$files = $this->_get_installation_files();

		$precheck = array();
		$install = TRUE;
		foreach( $files as $file )
		{
			if( is_readable($file) && is_writable($file) )
			{
				if( strlen(file_get_contents($file)) != 0)
				{
					show_error( lang('installation_already_complete'), 500);	
				}
				$precheck[$file] = TRUE;
			}
			else
			{
				$precheck[$file] = FALSE;
				$install = FALSE;
			}
		}
		
		
		
		$data['precheck'] = $precheck;
				
			
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$this->form_validation->set_rules('db_hostname', 'lang:db_hostname', 'trim|required');
		$this->form_validation->set_rules('db_username', 'lang:db_username', 'trim|required');
		$this->form_validation->set_rules('db_password', 'lang:db_password', 'trim|required');
		$this->form_validation->set_rules('db_prefix', 'lang:db_prefix', 'trim');
		$this->form_validation->set_rules('db_driver', 'lang:db_driver', 'trim');
		$this->form_validation->set_rules('db_database', 'lang:db_database', 'trim|required|callback_db_connection_test');		
		
		$this->form_validation->set_rules('email', 'lang:email_address', 'trim|required|valid_email');		
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('password_confirm', 'lang:password_confirm', 'required|matches[password]');

		if ($this->form_validation->run() == TRUE)
		{ 			
			if($install)
			{
				$this->_write_config();
			}						
			
			// Database was loaded in $this->_db_connection_test()
			$this->load->model('install_schema');
			$this->install_schema->create_tables();
			
			$this->load->library('simpleusers');						
			if( ! $this->simpleusers->create('Admin', $this->input->post('password'), $this->input->post('email'), TRUE) )
			{
				show_error( lang('couldnt_create_user_message'), 500);
			}
			
			
			$this->load->view('done');	
		}
		else
		{
		
			$this->load->vars($data);
			$this->load->view('setup');		
		}
	}
	
	public function user()
	{

		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'lang:password', 'required');
		$this->form_validation->set_rules('password_confirm', 'lang:password_confirm', 'required|matches[password]');		

		if ($this->form_validation->run() == TRUE)
		{ 			
			$this->load->database();
			$this->config->set_item('encryption_key', 'tmp');
			
			if( ! $this->simpleusers->create('Admin', $this->input->post('password'), $this->input->post('email'), TRUE ) )
			{
				show_error( lang('couldnt_create_user'), lang('couldnt_create_user_message') );
				
			}
			else
			{
				redirect('setup/done');
				exit;
			}
		}		
		
		$this->load->view('setup/create_user');
	}
	
	public function done()
	{
		$this->load->view('setup/done');
	}
	
	private function _get_installation_files()
	{
		$files[] = FCPATH."application/config/config.php";
		$files[] = FCPATH."application/config/database.php";
		
		return $files;
	}
	
	private function _write_config()
	{
		$config = file_get_contents(APPPATH.'config/config_tmpl.php');
		$config = str_replace('{encryption_key}', random_string('alnum', 12), $config);
		file_put_contents(FCPATH."application/config/config.php", $config);

		$database = file_get_contents(APPPATH.'config/database.php');				
		$search = array('{hostname}', '{username}', '{password}', '{database}', '{dbdriver}', '{dbprefix}');
		$replace = array(set_value('db_hostname'), set_value('db_username'), set_value('db_password'), set_value('db_database'), set_value('db_driver'), set_value('db_prefix'));
		$database = str_replace($search, $replace, $database);		
		file_put_contents(FCPATH."application/config/database.php", $config);
	}
	

	/**
	* DB Driver Test
	*
	* Test a given driver to ensure the server can use it. We'll also create the
	* database here if we need to.
	*
	* @access private
	* @param array
	* @return bool
	*/
	public function db_connection_test( $str )
	{
		unset($this->db);
				
		$db_config['hostname'] = set_value('db_hostname');
		$db_config['username'] = set_value('db_username');
		$db_config['password'] = set_value('db_password');
		$db_config['database'] = set_value('db_database');
		$db_config['dbprefix'] = set_value('db_prefix');
		$db_config['dbdriver'] = set_value('db_driver');
		
		
		$db_config['db_debug'] = false;
		
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
					$this->form_validation->set_message('db_connection_test', lang('could_not_create'));
					return FALSE;
				}
			}
		}
		else
		{
			$this->form_validation->set_message('db_connection_test', lang('could_not_connect'));
			return FALSE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */