		<script type="text/javascript">
			$(document).ready(function() {
				$('#milestone').datepicker();
			});
		</script>
	
		<div class="row-fluid">		

		<form class="form-horizontal" method="post" action="">
			<fieldset>
				<legend><?php echo (isset($edit)) ? lang('edit_milestone') : lang('create_milestone'); ?></legend>

				<div class="control-group<?php if(form_error('name') != "") echo " error"; ?>">
			    <label class="control-label" for="name"><?php echo lang('name'); ?></label>
			    <div class="controls">
			    	<input type="text" class="input-xlarge" id="name" name="name" value="<?php echo set_value('name', $name); ?>">
			    	<span class="help-inline"><?php echo form_error('name'); ?></span>	
		  	  </div>
		  	  
		    </div>

				<div class="control-group<?php if(form_error('milestone') != "") echo " error"; ?>">
			    <label class="control-label" for="milestone"><?php echo lang('milestone_date'); ?></label>
			    <div class="controls">
			    	 <input type="text" class="input-xlarge" id="milestone" name="milestone" data-date="<?php echo $milestone; ?>" data-date-format="yyyy-mm-dd" value="<?php echo set_value('milestone', $milestone); ?>">
			    	<span class="help-inline"><?php echo (form_error('name') != "") ? : lang('milestone_format') ; ?></span>
		  	  </div>		  	  
		    </div>

		    		    
		    <div class="form-actions">
		    	<input type="submit" value="<?php echo (isset($edit)) ? lang('save') : lang('create'); ?>" class="btn btn-primary">
		    	<a href="<?php echo site_url('admin/milestones'); ?>" class="btn"><?php echo lang('cancel'); ?></a>
		    </div>
		    
    </fieldset>
    </form>
    
  	</div>