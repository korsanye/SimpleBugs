<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milestones_model extends CI_Model {


	/**
	* Update a milestone
	*
	* @param	$id	The unique ID of the project
	* @param	$name	The new name
	* @param	$name	The new milestone date (YYYY-MM-DD)
	*	@return	boolean
	*/
	public function update( $id, $name, $milestone )
	{
		$data = array(
									'name' => $name,
									'milestone' => $milestone
									);
		return $this->db->where('id', $id)->update('milestones', $data);
	}

	/**
	* Create a milestone
	*
	* @param	$name	The name of the milestone
	* @param	$milestone	The date of the milestone (YYYY-MM-DD)
	* @return	mixed	The auto incremented ID of the new project or FALSE if insert failed.
	*/
	public function create( $name, $milestone )
	{
		$data = array(
									'name' => $name,
									'milestone' => $milestone
									);
		if( $this->db->insert('milestones', $data) )
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	/**
	* Get all milestones
	*
	* @return	object	CI DB result
	*/
	public function milestones()
	{
		return $this->db->order_by('milestone', 'desc')->get('milestones');
	}

	/**
	* Get single milestone
	*
	* @param	$id	The unique ID of the project
	* @return	object
	*/	
	public function milestone($id)
	{	
		$query = $this->db->where('id', $id)->limit(1)->get('milestone');
		if( $query->num_rows() == 0 )
		{
			return FALSE;
		}
		
		return $query->row();
	}
	
}