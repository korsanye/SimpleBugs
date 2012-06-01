<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issues extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$data['users'] = $this->simpleusers->users();
		$data['categories'] = $this->categories_model->categories();
		$data['priorities'] = $this->priorities_model->priorities();
		$data['projects'] = $this->projects_model->projects();
		$data['milestones'] = $this->milestones_model->milestones();
		$this->load->vars($data);
	}

	public function index()
	{
		$data['issues'] = $this->issues_model->get_issues();
		$this->load->vars($data);
		$this->load->view('header');
		$this->load->view('issues/overview');
		$this->load->view('footer');
		
		
	}
	
	public function create()
	{
		$page_data['estimate'] = '';
		$page_data['assigned_to'] = 0;
		$page_data['project_id'] = 0;
		$page_data['priority_id'] = 0;
		$page_data['milestone_id'] = 0;
		$page_data['title'] = '';
		$page_data['category_id'] = 0;
		$page_data['created_by'] = 0;
		
				
		$this->form_validation->set_rules('assigned_to', 'lang:assign_to', 'required|integer');
		$this->form_validation->set_rules('project_id', 'lang:project', 'required|integer');
		$this->form_validation->set_rules('priority_id', 'lang:priority', 'required|integer');
		$this->form_validation->set_rules('milestone_id', 'lang:milestone', 'integer');
		$this->form_validation->set_rules('title', 'lang:issue_title', 'trim|required');
		$this->form_validation->set_rules('category_id', 'lang:category', 'required|integer');
		$this->form_validation->set_rules('content', 'lang:content', 'trim|required');
		$this->form_validation->set_rules('estimate', 'lang:estimate', 'trim');
		$this->form_validation->set_rules('time_spent', 'lang:time_spent', 'trim');
		
		
		if( $this->form_validation->run() === TRUE )
		{			
			$data['assigned_to'] = set_value('assigned_to');
			$data['project_id'] = set_value('project_id');
			$data['priority_id'] = set_value('priority_id');
			$data['milestone_id'] = set_value('milestone_id');
			$data['title'] = set_value('title');
			$data['category_id'] = set_value('category_id');
			$data['created_by'] = $this->simpleusers->user()->id;
			$data['estimate'] = convert_to_unix_time(set_value('estimate'));
			$data['time_spent'] = convert_to_unix_time(set_value('time_spent'));
			
			$issue_id = $this->issues_model->create_issue($data);
					
			$post_data['issue_id'] = $issue_id;
			$post_data['content'] = set_value('content');
			$post_data['assigned_from'] = $this->simpleusers->user()->id;
			$post_data['assigned_to'] = set_value('assigned_to');
			$post_data['first_post'] = 1; // For easier telling which was the opening post			
			
			$this->issues_model->create_post($post_data);
			redirect(site_url($issue_id));
			exit;			
		}
		
		$this->load->vars($page_data);
		$this->load->view('header');
		$this->load->view('issues/assign');
		$this->load->view('footer');
	}
	
	public function resolve( $issue_id )
	{
		if( ! $issue = $this->issues_model->get_issue($issue_id) )
		{
			show_404();
		}

		$this->issues_model->resolve_issue($issue->id);
		redirect(site_url($issue->id));
	}
	
	public function assign( $issue_id )
	{
		if( ! $issue = $this->issues_model->get_issue($issue_id) )
		{
			show_404();
		}
		
		$estimate = '';
		if($issue->estimate > 0)
		{
			$time_object = convert_from_unix_time($issue->estimate);
			
			if($time_object->hours > 0)
			{
				$estimate .= $time_object->hours.'h ';
			}
			
			if($time_object->minutes > 0)
			{
				$estimate .= $time_object->minutes.'m';
			}
						
		}
		$page_data = $data = $this->_get_issue_info( $issue );
		$page_data['page_title'] = lang('assign_issue'). ' #' . $issue->id;
		
		$page_data['issue'] = $issue;		
		$page_data['edit'] = TRUE;
		$page_data['estimate'] = $estimate;
		$page_data['assigned_to'] = $issue->assigned_to;
		$page_data['project_id'] = $issue->project_id;
		$page_data['priority_id'] = $issue->priority_id;
		$page_data['milestone_id'] = $issue->milestone_id;
		$page_data['title'] = $issue->title;
		$page_data['category_id'] = $issue->category_id;
		$page_data['created_by'] = $issue->created_by;
		
		$this->form_validation->set_rules('assigned_to', 'lang:assign_to', 'required|integer');
		$this->form_validation->set_rules('project_id', 'lang:project', 'required|integer');
		$this->form_validation->set_rules('priority_id', 'lang:priority', 'required|integer');
		$this->form_validation->set_rules('milestone_id', 'lang:milestone', 'integer');
		$this->form_validation->set_rules('category_id', 'lang:category', 'required|integer');
		$this->form_validation->set_rules('content', 'lang:content', 'trim|required');
		$this->form_validation->set_rules('estimate', 'lang:estimate', 'trim');
		$this->form_validation->set_rules('time_spent', 'lang:time_spent', 'trim');
		
		
		if( $this->form_validation->run() === TRUE )
		{			
			$data['assigned_to'] = set_value('assigned_to');
			$data['project_id'] = set_value('project_id');
			$data['priority_id'] = set_value('priority_id');
			$data['milestone_id'] = set_value('milestone_id');
			$data['category_id'] = set_value('category_id');			
			$data['estimate'] = convert_to_unix_time(set_value('estimate'));
			$data['time_spent'] = $issue->time_spent + convert_to_unix_time(set_value('time_spent'));
			
			$issue_id = $this->issues_model->update_issue($issue->id, $data);
					
			$post_data['issue_id'] = $issue->id;
			$post_data['content'] = set_value('content');
			$post_data['assigned_from'] = $this->simpleusers->user()->id;
			$post_data['assigned_to'] = set_value('assigned_to');
			
			$this->issues_model->create_post($post_data);
			redirect(site_url($issue->id));
			exit;			
		}		
		
		
		$this->load->vars($page_data);
		$this->load->view('header');
		$this->load->view('issues/assign');
		$this->load->view('footer');
	}
	
	
	public function view( $issue_id = NULL )
	{
		if( ! $issue = $this->issues_model->get_issue($issue_id) )
		{
			show_404();	
		}

		$data = $this->_get_issue_info( $issue );		
		$data['page_title'] = "#{$issue->id} - {$issue->title}";
		
		$this->load->vars($data);
		$this->load->view('header');
		$this->load->view('issues/view');
		$this->load->view('footer');
	}	
	
	private function _get_issue_info( $issue )
	{
		$data['issue'] = $issue;
		$data['posts'] = $this->issues_model->get_posts($issue->id);
		$data['date_time_format'] = $this->settings_model->get('date_format', 'Y-m-d').' '.$this->settings_model->get('time_format', 'h:i a');
		$data['project'] = ($project = $this->projects_model->project($issue->project_id)) ? $project->name : lang('unknown_project');
		$data['category'] = ($category = $this->categories_model->category($issue->category_id)) ? $category->name : lang('unknown_category');
		$data['priority'] = ($priority = $this->priorities_model->priority($issue->priority_id)) ? $priority->name : lang('unknown_priority');
		$data['milestone'] = ($milestone = $this->milestones_model->milestone($issue->milestone_id)) ? $milestone->name : lang('unknown_milestone');
		return $data;		
	}

}