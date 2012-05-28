		<div class="row">				
			<div class="span12">
			
				<h1>New issue</h1>
				<hr>
				
				<div class="row">
					<div class="span3">
						<div class="well">
																				
							<h6><?php echo lang('creating_an_issue'); ?></h6>
							<p><?php echo lang('creating_an_issue_help'); ?></p>


							
						</div>
					</div>	
					
					<div class="span9">
					<form>
						<div class="row">
							<div class="span3">
								<label for="assign">Assign to:</label>
								
								<select name="assign" id="assign">
									<option></option>
									<option value="1">Dan Storm</option>	
									<option value="2">John Doe</option>	
									<option value="3">Niels Nielsen</option>										
								</select>
							</div>						
						
							<div class="span3">
								<label for="priority">Priority:</label>
								
								<select name="priority" id="priority">
									<option value="1">Must Fix</option>	
									<option value="2">Within Milestone</option>	
									<option value="3">Fix If Time</option>										
								</select>
								
							</div>						
							
							<div class="span3">
								<label for="project">Project:</label>
								
								<select name="project" id="project">
									<option value="1">SimpleBugs</option>	
									<option value="2">Catalyst Code</option>	
									<option value="3">Creative Coders</option>										
								</select>
								
							</div>												
							
							
							
						</div>

						<div class="row">
							
							<div class="span3">
								<label for="category">Category:</label>
								
								<select name="category" id="category">
									<option value="1">Bug</option>	
									<option value="2">Feature</option>	
									<option value="3">Inquery</option>										
								</select>
							</div>						
														
							<div class="span3">
								<label for="milestine">Milestone:</label>
								
								<select name="milestone" id="milestone">
									<option value="0">Undecided</option>	
								</select>
							</div>																				
							
						</div>						
						
						<label for="content">Issue content</label>
						<textarea name="content" id="content" class="span9" rows="10">
							
						</textarea>

						<div class="row">
						<div class="pull-right">
							<label for="file">Attach file(s)</label>
							<input type="file" name="userfiles[]" id="file" multiple="multiple">
						</div>
						</div>
						
						<div class="form-actions">
							
							<button class="btn btn-primary" type="submit">Assign</button>
							<button class="btn">Cancel</button>							
							
						</div>

					</form>
					
	
					
							
					</div>
					
				</div>				
				
			</div>
		</div>