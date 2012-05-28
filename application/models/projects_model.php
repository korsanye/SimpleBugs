<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model {


	/**
	* Update a project
	*
	* @param	$id	The unique ID of the project
	* @param	$name	The new name
	*	@return	boolean
	*/
	public function update( $id, $name )
	{
		$data = array(
									'name' => $name
									);
		return $this->db->where('id', $id)->update('projects', $data);
	}

	/**
	* Create a project
	*
	* @param	$name	The name of the project
	* @return	mixed	The auto incremented ID of the new project or FALSE if insert failed.
	*/
	public function create( $name )
	{
		$data = array(
									'name' => $name
									);
		if( $this->db->insert('projects', $data) )
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	/**
	* Get all projects
	*
	* @return	object	CI DB result
	*/
	public function projects()
	{
		return $this->db->order_by('name', 'asc')->get('projects');
	}

	/**
	* Get single project
	*
	* @param	$id	The unique ID of the project
	* @return	object
	*/	
	public function project($id)
	{	
		$query = $this->db->where('id', $id)->limit(1)->get('projects');
		if( $query->num_rows() == 0 )
		{
			return FALSE;
		}
		
		return $query->row();
	}
	
}