<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Authentication Library
 */
 
class Simpleusers {
	
	protected $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('simpleusers', TRUE);
		$this->CI->load->helper(array('email', 'url', 'cookie'));		
		$this->CI->load->library(array('session', 'email'));		
		$this->CI->load->database();
		
		//Prevent browsers from using history to browse in the user system.
		$this->CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->CI->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		$this->CI->output->set_header("Pragma: no-cache"); 
		
		
		$this->_check_remember_me();
		$this->_set_last_activity();
	}
		
		
	/**
	* Creates a user
	*
	* @param $username
	* @param $password
	* @param $email
	* @return boolean FALSE if user couldn't be created, otherwise the new users unique ID.
	*/
	public function create( $username, $password, $email, $is_admin = FALSE )
	{		
		$password_hash = $this->_hash_password($password);
		
		$user_data = array(
							'username' => $username,
							'password' => $password_hash,
							'email' => $email,
							'join_date' => date('Y-m-d H:i:s')
							);
							
		if( $is_admin )
		{
			$user_data['is_admin'] = 1;	
		}
		
		if( $this->CI->db->insert('users', $user_data) )
		{
			return $this->CI->db->insert_id();	
		}
		
		return FALSE;					
	}
	
	/**
	* Updates user
	* 
	* @param	$id	The id of the user who needs to be updated
	* @param	$username
	* @param	$email
	* @param	$password	Should be NULL if the user doesn't needs to get his password updated
	* @return	boolean
	*/
	public function update( $id, $username, $email, $password = NULL, $is_admin = FALSE)
	{		
		if( !is_null($password) && !empty($password) )
		{
			$data['password'] =	$this->_hash_password($password);
		}
		
		$data['username'] = $username;
		$data['email'] = $email;
		$data['is_admin'] = 0;
		if( $is_admin )
		{
			$data['is_admin'] = 1;	
		}
		
		return $this->CI->db->where('id', $id)->update('users', $data);	
	}
		
	/**
	* Log in the user
	*
	* @param	$username
	* @param	$password
	* @return	mixed Object of user if user can be authenticaed, otherwise boolean FALSE
	*/		
	public function login( $username, $password, $remember_me = FALSE )
	{
		$query = $this->CI->db->where($this->CI->config->item('user_login', 'simpleusers'), $username)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		$user = $query->row();
		
		if( crypt($password, $user->password) == $user->password )
		{

			$this->CI->session->set_userdata('user_id', $user->id);

			if($remember_me)
			{
				$this->_remember_me();
			}

			return $user;	
		}
		
		
		return FALSE;		
	}
	
	/**
	* Checks whether a username is registered.
	*
	* @param $username
	* @return boolean
	*/	
	public function check_username( $username )
	{
		$query = $this->CI->db->where('username', $username)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		return TRUE;
	}
	
	/**
	* Checks whether a email is registered.
	*
	* @param $email
	* @return boolean
	*/	
	public function check_email( $email )
	{
		$query = $this->CI->db->where('email', $email)->limit(1)->get('users');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		return TRUE;
	}	
	
	/**
	* Logs out users
	* Void function
	*/
	public function logout()
	{
		if($this->CI->input->cookie('autologin') !== FALSE)
		{
			$this->CI->input->set_cookie('autologin');			
		}
		
		$this->CI->session->unset_userdata('user_id');		
	}
	
	public function reset_password( $username )
	{
		
		$query = $this->CI->db->where($this->CI->config->item('user_login', 'simpleusers'), $username)->limit(1)->get('users');
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
		/*				
		$this->CI->db->where('id', $user->id)->update('users', $data);
		
		// Send the e-mail
		$this->CI->email->from($this->CI->config->item('site_email', 'simpleusers'), $this->CI->config->item('site_name', 'simpleusers'));
		$this->CI->email->to($user->email);
			
		$this->CI->email->subject( lang('email_reset_password_subject') );
		$this->CI->email->message( sprintf( lang('email_reset_password_body'), site_url('users/reset/'.$key) ) );
		$this->CI->email->send();		
		*/
								
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
	* Void function which checks whether the user is logged in
	* and sets the public logged_in variable to either TRUE or FALSE
	*/	
	public function logged_in()
	{
		if( $this->CI->session->userdata('user_id') !== FALSE )
		{
			return TRUE;
		}			
		
		return FALSE;
	}

	/**
	* Tells whether the user is registered as an admin
	*
	* @param	$id	The user ID to check - if none provided, it checks the current user
	* @return	boolean
	*/
	public function is_admin( $id = NULL )
	{
		if( is_null($id) )
		{
			if( $this->CI->session->userdata('user_id') === FALSE )
			{
				return FALSE;	
			}
			
			$id = $this->CI->session->userdata('user_id');
		}
		
		$user = $this->user($id);
		if( $user->is_admin == 1 )
		{
			return TRUE;
		}
		return FALSE;
	}	

	/**
	* Sets the users last activity time
	* Void function
	*/
	private function _set_last_activity()
	{
		if($this->logged_in())
		{
			$user = $this->user();
			$this->CI->db->where('id', $user->id)->update('users', array('last_activity' => date("Y-m-d H:i:s")));	
		}	
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
	* Sets the 'Remember me' cookie, for fast login
	* Void function.
	*/
	private function _remember_me()
	{
		
		$user = $this->user();
		$key = $this->_generate_salt();
		$digest = $this->_hash_password($key);
		
		$data = array(
									'remember_me_key' => $digest,
									);
		
		$this->CI->db->where('id', $user->id)->update('users', $data);
		
		$cookie = array(
		    'name'   => 'autologin',
		    'value'  => base64_encode( serialize( array($user->id, $key) ) ),
		    'expire' => 60 * 60 * 24 * 31 //approx one month
		);		
		
		
		$this->CI->input->set_cookie($cookie); 
	}
	
	private function _check_remember_me()
	{
		if( $this->CI->input->cookie('autologin') === FALSE || $this->logged_in())
		{
			return;
		}
		
		$cookie_data = unserialize(base64_decode($this->CI->input->cookie('autologin')));
		if( ! is_array($cookie_data) || count($cookie_data) != 2 )
		{
			return;
		}
		
		list($user_id, $remember_me_key) = $cookie_data;
		if( $user = $this->user($user_id) )
		{
			if( crypt($remember_me_key, $user->remember_me_key) == $user->remember_me_key )
			{
				$this->CI->session->set_userdata('user_id', $user->id);
			}
		}
		
		
		
	}
		
	/**
	* Generates a random salt of 16 characters in length
	*
	* @param	$length	integer
	* @return	string
	*/	
	private function _generate_salt( $length = 22 )
	{	
					
		if( $this->CI->config->item('random_org', 'simpleusers') === TRUE )
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