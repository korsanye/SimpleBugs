	<div class="row-fluid">		

		<form class="form-horizontal" method="post" action="">
			<fieldset>
				<legend><?php echo (isset($edit)) ? lang('edit_project') : lang('create_project'); ?></legend>

				<div class="control-group<?php if(form_error('name') != "") echo " error"; ?>">
			    <label class="control-label" for="email"><?php echo lang('name'); ?></label>
			    <div class="controls">
			    	<input type="text" class="input-xlarge" id="name" name="name" value="<?php echo set_value('name', $name); ?>">
			    	<span class="help-inline"><?php echo form_error('name'); ?></span>	
		  	  </div>
		  	  
		    </div>
		    		    
		    <div class="form-actions">
		    	<input type="submit" value="<?php echo (isset($edit)) ? lang('save') : lang('create'); ?>" class="btn btn-primary">
		    	<a href="<?php echo site_url('admin/projects'); ?>" class="btn"><?php echo lang('cancel'); ?></a>
		    </div>
		    
    </fieldset>
    </form>
  </div>