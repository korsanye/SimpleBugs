<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SimpleBugs Login</title>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>">/</script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
		<style type="text/css">
		body
		{
			margin-top: 60px;
		}
		</style>
	</head>
	<body>
	
	<div class="container">
		
		<div class="row">
			<div class="span4 offset4">
				<h1><?php echo lang('login_to_simplebugs'); ?></h1>
			</div>
						
		</div>
		
		<div class="row">
			<div class="span4 offset4 well">
				<?php if( isset($login_error) ): ?>
				<div class="alert alert-error">
					<?php echo lang('wrong_credentials'); ?>
				</div>
				<?php endif; ?>
				<form method="POST" action="" class="form">
				
					<div class="control-group">
						<label class="control-label" for="email"><?php echo lang('email'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="email" name="email">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password"><?php echo lang('password'); ?></label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="password" name="password">
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" class="btn btn-primary" value="<?php echo lang('login'); ?>">
							<a href="#"><?php echo lang('forgot_your_password'); ?></a>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label class="checkbox"><input type="checkbox" name="remember_me"> <?php echo lang('remember_me'); ?></label>					
						</div>
					</div>

				</form>
				
			</div>
		</div>
	</div>
		
	</body>
</html>