<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Authentication Library
 */
 
class Users {
	
	protected $CI;	
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('users');
		$this->CI->load->helper('language');
		$this->CI->lang->load('users');
		$this->CI->load->library('session');
		
		
		if( strlen($this->CI->config->item('secret_hash_key')) == 0 )
		{
			show_error( lang('config_secret_hash_key'), 500 );
		}				
	}
		
	/**
	* Generates a random salt of 16 characters in length
	*
	* @param	$size	integer
	* @return	string
	*/	
	private function _generate_salt( $length = 22 )
	{	
					
		if( $this->CI->config->item('random_org') === TRUE )
		{							
			$num = ceil($length / 20);
			$salt = trim(str_replace("\n", "", file_get_contents('http://www.random.org/strings/?num='.$num.'&len=20&digits=on&upperalpha=on&loweralpha=on&unique=on&format=plain&rnd=new')));
			return substr($salt, 0, $length);
		}	
		
		// Try to use a better random generation
		if(function_exists('openssl_random_pseudo_bytes')) 
		{
			$salt = base64_encode(openssl_random_pseudo_bytes($length, $strong));
			if($strong == TRUE)
			{
				return substr($salt, 0, $length);
			}
		}
        		
		// Fallback method
		$salt = '';
		$available = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+'; // !#%&()=?@${[]}+-*/^~';			
		while(strlen($salt) < $length)
			$salt .= $available{mt_rand(0, strlen($available)-1)};			
			
		return $salt;					
	}
	
	
		
}
	
	

	