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
		
	}
	
	
	/**
	* Generates a random salt of 20 chars
	*
	* @param	$size	integer
	* @return	string
	*/	
	private function _generate_salt( $size = 20 )
	{	
		if($size > 20)
		{
			$size = 20;
		}
			
		if($this->CI->config->item('random_org') === TRUE)
		{		
			return trim(file_get_contents('http://www.random.org/strings/?num=1&len='.$size.'&digits=on&upperalpha=on&loweralpha=on&unique=on&format=plain&rnd=new'));
		}	
				
		$salt = '';
		$available = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // !#%&()=?@${[]}+-*/^~';			
		while(strlen($salt) < $size)
			$salt .= $available{mt_rand(0, strlen($available)-1)};			
			
		return $salt;					
	}
	
	
		
}
	
	

	