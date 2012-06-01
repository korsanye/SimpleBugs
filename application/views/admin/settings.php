<div class="row-fluid">		

<form method="post" action="" class="form-horizontal">
	<fieldset>
		<legend><?php echo lang('settings'); ?></legend>

		<div class="control-group">
			<label class="control-label" for="input01"><?php echo lang('date_format'); ?></label>
			<div class="controls">
				
				<?php $options = array(
															'Y-m-d'		=> date('Y-12-31'),
															'Y/m/d'		=> date('Y/12/31'),
															'y-m-d'		=> date('y-12-31'),
															'Y/m/d'		=> date('Y/12/31'),
															'y/m/d'		=> date('y/12/31'),
															'd/m/Y'		=> date('31/12/Y'),
															'd/m/y'		=> date('31/12/y'),
															'd/m - Y'	=> date('31/12 - Y'),
															'd/m - y'	=> date('31/12 - y')
															);
					echo form_dropdown('date_format', $options, $date_format, 'class="input-xlarge" id="date_format"' );
         ?>
								
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="input01"><?php echo lang('time_format'); ?></label>
			<div class="controls">
				
				<?php $options = array(
															'H:i'		=> "13:37 (24 hour format)",
															'h:i a'		=> "1:37 pm",
															'h:i A'		=> "1:37 PM",
															);
					echo form_dropdown('time_format', $options, $time_format, 'class="input-xlarge" id="time_format"' );
         ?>
								
			</div>
		</div>



		    <div class="form-actions">
		    	<input type="submit" value="<?php echo lang('save'); ?>" class="btn btn-primary">		    	
		    </div>



	</fieldset>
</form>

</div>