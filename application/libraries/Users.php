<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Authentication Library
 */
 
class Users {
	
	protected $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('users', TRUE);
		$this->CI->load->helper(array('language', 'email', 'url'));
		$this->CI->lang->load('users');
		$this->CI->load->library(array('session', 'email'));		
		$this->CI->load->database();		
	}
	
	public function salt()
	{
		//return $this->_hash_password('j26211');
	}
	
	
	public function create( $username, $password, $email )
	{		
		$password_hash = $this->_hash_password($password);
		
		$user_data = array(
							'username' => $username,
							'password' => $password_hash,
							'email' => $email,
							'join_date' => date('Y-m-d H:i:s')
							);
							
		if( $this->CI->db->insert('users', $user_data) )
		{
			return $this->CI->db->insert_id();	
		}
		
		return FALSE;					
	}
		
	/**
	* Log in the user
	*
	* @param	$username
	* @param	$password
	* @return	mixed Object of user if user can be authenticaed, otherwise boolean FALSE
	*/		
	public function login( $username, $password )
	{
		$query = $this->CI->db->where($this->CI->config->item('user_login', 'users'), $username)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		$user = $query->row();
		
		if( crypt($password, $user->password) == $user->password )
		{
			return $user;	
		}
		
		return FALSE;		
	}
	
	public function check_username( $username )
	{
		$query = $this->CI->db->where('username', $username)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		return $query->row();
	}
	
	/**
	* Logs out users
	* Void function
	*/
	public function logout()
	{
		$this->CI->session->unset_userdata('user_id');
	}
	
	public function reset_password( $username )
	{
		
		$query = $this->CI->db->where($this->CI->config->item('user_login', 'users'), $username)->limit(1)->get('users');
		if( $query->num_rows() == 0 )
		{
			return FALSE;	
		}
		
		$user = $query->row();
		
		$key = $this->_generate_salt(64);
		$hashed = $this->_hash_password($key);
		
		$data = array(
						'reset_password_key' => $hashed
						);
						
		$this->CI->db->where('id', $user->id)->update('users', $data);
		
		// Send the e-mail
		$this->CI->email->from($this->CI->config->item('site_email', 'users'), $this->CI->config->item('site_name', 'users'));
		$this->CI->email->to($user->email);
			
		$this->CI->email->subject( lang('email_reset_password_subject') );
		$this->CI->email->message( sprintf( lang('email_reset_password_body'), site_url('users/reset/'.$key) ) );
		$this->CI->email->send();
		
		echo $this->CI->email->print_debugger();
								
		return TRUE;				
	}
	
	/**
	* Returns all users
	*
	* @return	array of objects
	*/	
	public function users()
	{
		$users = array();
		$query = $this->CI->db->get('users');
		
		foreach($query->result() as $row)
		{
			$users[] = $row;
		}
		
		return $users;		
	}
	
	/**
	* Gets the current user if he is logged in
	*
	* @param	$id	If an id is passed, the info for that user will be fetched
	* @return	mixed	An object with user information or boolean FALSE
	*/
	public function user( $id = NULL )
	{
		if( is_null($id) )
		{
			if( $this->CI->session->userdata('user_id') === FALSE )
			{
				return FALSE;	
			}
			
			$id = $this->CI->session->userdata('user_id');
		}
		
		$query = $this->CI->db->where('id', $id)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		return $query->row();
	}

	/**
	* Hashes the password
	* 
	* @param	$password
	* @return	string
	*/	
	private function _hash_password( $password )
	{		
		if (CRYPT_BLOWFISH == 1 )
		{
			$salt = '$2a$08$'.$this->_generate_salt(22).'$';
			return crypt($password, $salt);			
		}
				
		if ( CRYPT_EXT_DES == 1 )
		{
			$salt = '_'.$this->_generate_salt(8);
			return crypt($password, $salt);
		}
		
		// Fallback
		return crypt($password, $this->_generate_salt(2));								
	}
	
	/**
	* Void function which checks whether the user is logged in
	* and sets the public logged_in variable to either TRUE or FALSE
	*/	
	private function logged_in()
	{
		if( $this->CI->session->userdata('user_id') !== FALSE )
		{
			return TRUE;
		}			
		
		return FALSE;
	}
		
	/**
	* Generates a random salt of 16 characters in length
	*
	* @param	$length	integer
	* @return	string
	*/	
	private function _generate_salt( $length = 22 )
	{	
					
		if( $this->CI->config->item('random_org', 'users') === TRUE )
		{							
			$num = ceil($length / 20);
			
			// Supressing the E_WARNING from file_get_contents for silently moving on to fallback methodst
			if( $data = @file_get_contents('http://www.random.org/strings/?num='.$num.'&len=20&digits=on&upperalpha=on&loweralpha=on&unique=on&format=plain&rnd=new') )
			{	
				$salt = trim(str_replace(array("\r", "\n"), "", $data));
				return substr($salt, 0, $length);
			}
		}
		
		// Check to see if I'm able to read /dev/urandom - use this if possible
		if( file_exists('/dev/urandom') && is_readable('/dev/urandom') )
		{
			$salt = str_replace('+', '.', base64_encode(file_get_contents('/dev/urandom', FALSE, NULL, NULL, $length)));	
			return substr($salt, 0, $length);
		}
		
		// Fallback to another method for random generation
		if(function_exists('openssl_random_pseudo_bytes')) 
		{
			$salt = str_replace('+', '.', base64_encode(openssl_random_pseudo_bytes($length, $strong)));
			if($strong == TRUE)
			{
				return substr($salt, 0, $length);
			}
		}
        		
		// Fallback method - not the best, but works for the purpose.
		$salt = '';
		$available = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/.';
		while(strlen($salt) < $length)
			$salt .= $available{mt_rand(0, strlen($available)-1)};			
			
		return $salt;					
	}
	
	
		
}
	
	

	