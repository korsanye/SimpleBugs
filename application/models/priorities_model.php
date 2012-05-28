<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priorities_model extends CI_Model {


	/**
	* Update a priority
	*
	* @param	$id	The unique ID of the project
	* @param	$name	The new name
	* @param	$default	Whether this should be the default priority
	*/
	public function update( $id, $name, $default = FALSE )
	{
	
		$data = array(
									'name' => $name,
									);
																
		$this->db->where('id', $id)->update('priorities', $data);
		if($default)
		{
			$this->set_as_default($id);
		}		
	}
	
	/**
	* Sets the new default priority to use when creating new issues
	*
	* @param	$id	The unique ID for the priority
	*/
	public function set_as_default( $id )
	{
		$this->db->update('priorities', array('default' => 0));
		$this->db->where('id', $id)->update('priorities', array('default' => 1));
	}

	/**
	* Create a priority
	*
	* @param	$name	The name of the priority
	* @param	$default	Whether this should be the default priority
	* @return	mixed	The auto incremented ID of the new project or FALSE if insert failed.
	*/
	public function create( $name, $default = FALSE )
	{
		$data = array(
									'name' => $name,
									'sort' => $this->priorities()->num_rows()
									);
		if( $this->db->insert('priorities', $data) )
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
	* Get all priorities
	*
	* @return	object	CI DB result
	*/
	public function priorities()
	{
		return $this->db->order_by('sort', 'asc')->get('priorities');
	}

	/**
	* Get single priority
	*
	* @param	$id	The unique ID of the project
	* @return	object
	*/	
	public function priority($id)
	{	
		$query = $this->db->where('id', $id)->limit(1)->get('priorities');
		if( $query->num_rows() == 0 )
		{
			return FALSE;
		}
		
		return $query->row();
	}
	
	public function sort_up( $id )
	{
		$priority = $this->priority($id);
		if( $priority->sort == 0 )
		{
			return FALSE;
		}
		
		$query = $this->db->where('sort', ($priority->sort - 1))->limit(1)->get('priorities');
		$priority_to = $query->row();
		
		$this->db->where('id', $priority->id)->update('priorities', array('sort' => $priority_to->sort));		
		$this->db->where('id', $priority_to->id)->update('priorities', array('sort' => $priority->sort));		
		return TRUE;
	}	
	
	public function sort_down( $id )
	{
		$priority = $this->priority($id);
		if( $priority->sort == ($this->priorities()->num_rows() - 1) )
		{
			return FALSE;
		}
		
		$query = $this->db->where('sort', ($priority->sort + 1))->limit(1)->get('priorities');
		$priority_to = $query->row();
		
		$this->db->where('id', $priority->id)->update('priorities', array('sort' => $priority_to->sort));		
		$this->db->where('id', $priority_to->id)->update('priorities', array('sort' => $priority->sort));		
		return TRUE;
	}	
	
	/**
	* Deletes a priority and fixes sorting
	*
	* @param	$id	The uniqiue ID to delete
	*/
	public function delete( $id )
	{
		$this->db->where('id', $id)->delete('priorities');
		$this->_fix_sorting();
	}
	
	private function _fix_sorting()
	{
		$priorities = $this->priorities();
		$i = 0;
		foreach($priorities->result() as $priority)
		{
			$this->db->where('id', $priority->id)->update('priorities', array('sort' => $i));
			$i++;
		}
	}
	
}