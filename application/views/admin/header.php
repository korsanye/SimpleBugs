<!DOCTYPE html>
<html lang="en">
	<head>
		<title>#2312 - Something about a case which didn't make much sense - SimpleBugs</title>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap-alert.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap-datepicker.js'); ?>">/</script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/datepicker.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">		
	</head>
	<body>

		<?php $this->load->view('navbar'); ?>
		
		<div class="container-fluid">				
			<div class="row-fluid">				
				<div class="span2">
	
	
			    <ul class="nav nav-list well">
			
			    <li class="nav-header">
			 	   <?php echo lang('administration'); ?>
			    </li>
			
			    <li<?php if($this->uri->segment(2) == "projects"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/projects'); ?>"><?php echo lang('projects'); ?></a></li>
			    <li<?php if($this->uri->segment(2) == "milestones"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/milestones'); ?>"><?php echo lang('milestones'); ?></a></li>
			    <li<?php if($this->uri->segment(2) == "users"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/users'); ?>"><?php echo lang('users'); ?></a></li>
			
			    <li class="nav-header">
			  	  <?php echo lang('settings'); ?>
			    </li>
			    
			    <li<?php if($this->uri->segment(2) == "categories"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/categories'); ?>"><?php echo lang('categories'); ?></a></li>
			    <li<?php if($this->uri->segment(2) == "priorities"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/priorities'); ?>"><?php echo lang('priorities'); ?></a></li>
			    <li<?php if($this->uri->segment(2) == "settings"): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin/settings'); ?>"><?php echo lang('general_settings'); ?></a></li>    
			
			    </ul>
	
			</div>
			<div class="span10">
				
			<?php foreach( array('alert-success', 'alert-error', 'alert-info', 'alert-block') as $type): 
			if( $msg = $this->session->flashdata($type) ): ?>
	    <div class="alert alert-success">
	    	<a class="close" data-dismiss="alert" href="#">&times;</a>
  	  	<?php echo $msg; ?>
	    </div>			
	    <?php endif; endforeach; ?>