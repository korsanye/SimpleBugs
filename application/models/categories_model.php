<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model {


	/**
	* Update a category
	*
	* @param	$id	The unique ID of the category
	* @param	$name	The new name
	* @param	$default	Whether this should be the default category
	*/
	public function update( $id, $name, $default = FALSE )
	{
	
		$data = array(
									'name' => $name,
									);
																
		$this->db->where('id', $id)->update('categories', $data);
		if($default)
		{
			$this->set_as_default($id);
		}		
	}
	
	/**
	* Sets the new default category to use when creating new issues
	*
	* @param	$id	The unique ID for the category
	*/
	public function set_as_default( $id )
	{
		$this->db->update('categories', array('default' => 0));
		$this->db->where('id', $id)->update('categories', array('default' => 1));
	}

	/**
	* Create a category
	*
	* @param	$name	The name of the category
	* @param	$default	Whether this should be the default category
	* @return	mixed	The auto incremented ID of the new category or FALSE if insert failed.
	*/
	public function create( $name, $default = FALSE )
	{
		$data = array(
									'name' => $name									
									);
									
		if( $this->db->insert('categories', $data) )
		{
			$id = $this->db->insert_id();
			if($default)
			{
				$this->set_as_default($id);
			}
			return $id;
		}
		
		return FALSE;
	}
	
	/**
	* Get all categories
	*
	* @return	object	CI DB result
	*/
	public function categories()
	{
		return $this->db->order_by('name', 'asc')->get('categories');
	}

	/**
	* Get single category
	*
	* @param	$id	The unique ID of the category
	* @return	object
	*/	
	public function category($id)
	{	
		$query = $this->db->where('id', $id)->limit(1)->get('categories');
		if( $query->num_rows() == 0 )
		{
			return FALSE;
		}
		
		return $query->row();
	}
	
	/**
	* Deletes a category
	*
	* @param	$id	The uniqiue ID to delete
	*/
	public function delete( $id )
	{
		$this->db->where('id', $id)->delete('categories');
	}
	
	
}