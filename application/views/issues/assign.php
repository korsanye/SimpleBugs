	<script type="text/javascript">
		$(document).ready(function() {	
			$("#assign").select2({placeholder: "Assign to..."}); 
			$("#priority").select2({placeholder: "Priority"}); 
			$("#project").select2({placeholder: "Project"}); 
			$("#category").select2({placeholder: "Category"}); 
			$("#milestone").select2({placeholder: "Milestone"}); 
			 });
	</script>		

		<div class="row">				
			<div class="span12">
			
				<?php if( ! isset($edit) ): ?>
				<h1>New issue</h1>
				<?php else: ?>
				<h1><?php echo lang('issue'); ?> #<?php echo $issue->id; ?></h1>
				<h3><?php echo $issue->title; ?></h3>
				<?php endif; ?>
				<hr>
				
				<div class="row">
					<div class="span3">
						<div class="well">
												
							<?php if( ! isset($edit) ): ?>								
							<h6><?php echo lang('creating_an_issue'); ?></h6>
							<p><?php echo lang('creating_an_issue_help'); ?></p>
							<?php else: ?>
							<?php $this->load->view('issues/infobar'); ?>
							<?php endif; ?>

							
						</div>
					</div>	
					
					<div class="span9">
						
					<?php if( validation_errors() != "" ): ?>
					<div class="alert alert-danger">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<?php echo validation_errors(); ?>
					</div>
					<?php endif; ?>
					<form method="post" action="">
						<div class="row">
							<div class="span3">
								<label for="assign">Assign to:</label>
								
								<select name="assigned_to" id="assign">
									<option></option>
									<?php foreach($users as $user): ?>
									<option value="<?php echo $user->id; ?>"<?php if(set_value('assigned_to') == $user->id): ?> selected="selected"<?php endif; ?>><?php echo $user->username; ?></option>	
									<?php endforeach; ?>
								</select>
							</div>						
						
							<div class="span3">
								<label for="priority">Priority:</label>
								
								<select name="priority_id" id="priority">
									<?php foreach($priorities->result() as $priority): ?>
									<option value="<?php echo $priority->id; ?>"<?php if(($priority->default && !set_value('priority_id')) || set_value('priority_id', $priority_id) == $priority->id): ?> selected="selected"<?php endif; ?>><?php echo $priority->name; ?></option>	
									<?php endforeach; ?>									
								</select>
								
							</div>						
							
							<div class="span3">
								<label for="project">Project:</label>
								
								<select name="project_id" id="project">
									<?php foreach($projects->result() as $project): ?>
									<option value="<?php echo $project->id; ?>"<?php if(set_value('project_id', $project_id) == $project->id): ?> selected="selected"<?php endif; ?>><?php echo $project->name; ?></option>	
									<?php endforeach; ?>									
								</select>
								
							</div>												
							
							
							
						</div>

						<div class="row">
							
							<div class="span3">
								<label for="category">Category:</label>
								
								<select name="category_id" id="category">
									<?php foreach($categories->result() as $category): ?>
									<option value="<?php echo $category->id; ?>"<?php if(($category->default && !set_value('category_id')) || set_value('category_id', $category_id) == $category->id): ?> selected="selected"<?php endif; ?>><?php echo $category->name; ?></option>	
									<?php endforeach; ?>									
								</select>
							</div>						
														
							<div class="span3">
								<label for="milestone">Milestone:</label>
								
								<select name="milestone_id" id="milestone">
									<option value="0">Undecided</option>
									<?php foreach($milestones->result() as $milestone): 
									if(strtotime($milestone->milestone) < time() )
									{
										break; 
									}									
									?>
									<option value="<?php echo $milestone->id; ?>"<?php if(set_value('milestone_id', $milestone_id) == $milestone->id): ?> selected="selected"<?php endif; ?>><?php echo $milestone->name; ?></option>	
									<?php endforeach; ?>									
										
								</select>
							</div>																				
							
						</div>
							
							<hr>
							<?php if( ! isset($edit) ): ?>
							<label for="title"><? echo lang('issue_title'); ?></label>
							<input type="text" class="span9" name="title" value="<?php echo set_value('title', $title); ?>">
							<?php endif; ?>
						
							<label for="content">Issue content</label>
							<textarea name="content" id="content" class="span9" rows="10"><?php echo set_value('content'); ?></textarea>
						



						<div class="row">
						
							<div class="span4">
								<div class="control-group">
									<label class="control-label" for="estimate"><?php echo lang('estimate'); ?>	</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-time"></i></span><input id="estimate" class="span2" type="text" name="estimate" value="<?php echo set_value('estimate', $estimate); ?>">
											<span class="inline-help">Format is 2h 30m</span>
										</div>	
									</div>
								</div>
								
								
							</div>	

							<div class="span4 offset1">
								<div class="control-group">
									<label class="control-label" for="time_spent"><?php echo lang('time_spent'); ?>	</label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-time"></i></span><input id="time_spent" class="span2" type="text" name="time_spent" value="<?php echo set_value('time_spent'); ?>">
											<span class="inline-help">Format is 2h 30m</span>
										</div>	
									</div>
								</div>
							</div>	

							
						</div>
						
						<div class="form-actions">
							
							<button class="btn btn-primary" type="submit">Assign</button>
							<a href="#" class="btn">Cancel</a>							
							
						</div>

					</form>
					
	
					
							
					</div>
					
				</div>				
				
			</div>
		</div>