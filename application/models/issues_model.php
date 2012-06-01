<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issues_model extends CI_Model {
	
	
	/**
	* Creates a new issue and returns the new issue auto incremented ID.
	*
	* @param	$input	array
	* @return	integer
	*/
	public function create_issue( $input )
	{
		$white_list = array('project_id', 'category_id', 'priority_id', 'milestone_id', 'created_by', 'assigned_to', 'title', 'estimate', 'time_spent');
		$data = array();
		foreach($input as $key => $value)
		{
			if( ! in_array($key, $white_list) )
			{
				continue;	
			}	
			
			$data[$key] = $value;
		}
		
		$data['create_date'] = date("Y-m-d H:i:s");
		$data['last_update'] = date("Y-m-d H:i:s");
				
		$this->db->insert('issues', $data);	
		return $this->db->insert_id();
	}

	/**
	* Updates an issue.
	*
	* @param	$issue_id	integer	
	* @param	$input	array
	* @return	boolean
	*/	
	public function update_issue( $issue_id, $input )
	{
		$white_list = array('project_id', 'category_id', 'priority_id', 'milestone_id', 'created_by', 'assigned_to', 'title', 'estimate', 'time_spent');
		$data = array();
		foreach($input as $key => $value)
		{
			if( ! in_array($key, $white_list) )
			{
				continue;	
			}	
			
			$data[$key] = $value;
		}
		
		$data['last_update'] = date("Y-m-d H:i:s");
		
		$this->db->where('id', $issue_id);
		return $this->db->update('issues', $data);			
	}	
	
	/**
	* Get a single issue
	* 
	* @param	$id	integer
	* @return	mixed
	*/
	public function get_issue( $id )
	{
		$query = $this->db->where('id', $id)->limit(1)->get('issues');
		
		if($query->num_rows() == 0)
		{
			return FALSE;	
		}
		
		return $query->row();
	}
	
	/**
	* Get all issues
	* 
	* @return	object	query result
	*/
	public function get_issues( $filter = array() )
	{			
		$this->db->where('resolved', 0);
		
		$query = $this->db->get('issues');
		return $query;
	}
	
	/**
	* Mark an issue as resolved
	* 
	* @param	integer	the issue ID
	* @return	boolean
	*/
	public function resolve_issue( $issue_id )
	{
		$this->_set_last_update( $issue_id );
		return $this->db->where('id', $issue_id)->limit(1)->update('issues', array('resolved' => 1));				
	}	
	
	/**
	* Creates a new issue post and returns the new issue post auto incremented ID.
	*
	* @param	$input	array
	* @return	integer
	*/		
	public function create_post( $input )
	{
		$white_list = array('issue_id', 'content', 'assigned_to', 'assigned_from', 'first_post');
		$data = array();
		foreach($input as $key => $value)
		{
			if( ! in_array($key, $white_list) )
			{
				continue;	
			}	
			
			$data[$key] = $value;
		}
		$data['assigned_date'] = date("Y-m-d H:i:s");
				
		$this->db->insert('issues_posts', $data);	
		$this->_set_last_update( $data['issue_id'] );
		return $this->db->insert_id();		
	}
	
	public function get_posts( $issue_id )
	{
		return $this->db->where('issue_id', $issue_id)->order_by('assigned_date', 'desc')->get('issues_posts');
	}
	
	private function _set_last_update( $id )
	{
		$this->db->where('id', $id)->limit(1)->update('issues', array('last_update' => date("Y-m-d H:i:s")));	
	}

}