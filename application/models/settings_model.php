<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Simple Settings model
*/

class Settings_model extends CI_Model
{
	// Array containing the settings
	private $settings = array();
	
	public function __construct()
	{
		$query = $this->db->get('settings');
		
		foreach($query->result() as $row)
		{
			$this->settings[$row->name] = json_decode($row->value);
		}
	}
	
	/**
	* Get a setting based on the name
	*
	* @param	$name
	* @param	$fallback_value Fallback if no setting is present.
	* @return	mixed
	*/
	public function get( $name, $fallback_value = NULL )
	{
		$name = strtolower($name);
		
		if(isset($this->settings[$name]))
		{
			return $this->settings[$name];
		}
	
		if( ! is_null($fallback_value) )
		{
			return $fallback_value;
		}
		
		return NULL;
		
	}

	/**
	* Sets a setting with a value and links it to the name.
	*
	* @param	$name
	* @param	$value
	* @return	boolean
	*/	
	public function set( $name, $value )
	{
		$name = strtolower($name);
		if( ! is_null($this->get($name)) )
		{
			return $this->_update($name, $value);			
		}
	
		$data = array(
									'name' => $name,
									'value' => json_encode($value)
									);
									
		return $this->db->insert('settings', $data);	
	}	

	/**
	* Updates a setting linked to an existing entry.
	*
	* @param	$name
	* @param	$value
	* @return	boolean
	*/		
	private function _update( $name, $value )
	{
		return $this->db->where('name', $name)->update('settings', array('value' => json_encode($value)) );
	}
		
}