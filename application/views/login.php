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
				<h1>Login <small>to SimpleBugs</small></h1>
			</div>
						
		</div>
		
		<div class="row">
			<div class="span4 offset4 well">
				<div class="alert alert-error">
					Wrong e-mail or password provided.
				</div>
								
				<form class="form">
				
					<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="email">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="password">
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" class="btn btn-primary" value="Login">
							<a href="#">Forgot your password?</a>
						</div>
					</div>

					
				</form>
				
			</div>
		</div>
	</div>
		
	</body>
</html>