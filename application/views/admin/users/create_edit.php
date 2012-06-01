	<div class="row-fluid">		

		<form class="form-horizontal" method="post" action="">
			<fieldset>
				<legend><?php echo (isset($edit)) ? lang('edit_user') : lang('create_user'); ?></legend>

				<div class="control-group<?php if(form_error('name') != "") echo " error"; ?>">
			    <label class="control-label" for="email"><?php echo lang('name'); ?></label>
			    <div class="controls">
			    	<input type="text" class="input-xlarge" id="name" name="name" value="<?php echo set_value('name', $name); ?>">
			    	<span class="help-inline"><?php echo form_error('name'); ?></span>	
		  	  </div>
		  	  
		    </div>
		    
				<div class="control-group<?php if(form_error('email') != "") echo " error"; ?>">
			    <label class="control-label" for="email"><?php echo lang('email'); ?></label>
			    <div class="controls">
			    	<input type="text" class="input-xlarge" id="email" name="email" value="<?php echo set_value('email', $email); ?>">
			    	<span class="help-inline"><?php echo form_error('email'); ?></span>	
		  	  </div>
		    </div>

				<div class="control-group<?php if(form_error('password') != "") echo " error"; ?>">
			    <label class="control-label" for="password"><?php echo lang('password'); ?></label>
			    <div class="controls">
			    	<input type="password" class="input-xlarge" id="password" name="password">
			    	<span class="help-inline"><?php echo form_error('password'); ?></span>	
		  	  </div>
		    </div>

				<div class="control-group<?php if(form_error('password_conf') != "") echo " error"; ?>">
			    <label class="control-label" for="password_conf"><?php echo lang('password_conf'); ?></label>
			    <div class="controls">
			    	<input type="password" class="input-xlarge" id="password_conf" name="password_conf">
			    	<span class="help-inline"><?php echo form_error('password_conf'); ?></span>	
		  	  </div>
		    </div>

				<?php if($id != 1): ?>
				<div class="control-group">			    
			    <div class="controls">
			    	<label class="checkbox" for="is_admin">
			    		<input type="checkbox" name="is_admin"<?php if($is_admin): ?> checked="checked"<?php endif; ?>>
			    	<?php echo lang('admin_rights'); ?></label>
		  	  </div>
		    </div>
		    <?php endif; ?>
		    
		    <div class="form-actions">
		    	<input type="submit" value="<?php echo (isset($edit)) ? lang('save') : lang('create'); ?>" class="btn btn-primary">
		    	<a href="<?php echo site_url('admin/users'); ?>" class="btn"><?php echo lang('cancel'); ?></a>
		    </div>
		    
    </fieldset>
    </form>
    
  </div>