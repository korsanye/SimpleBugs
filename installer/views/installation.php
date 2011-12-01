<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SimpleBugs Installation</title>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
		<style type="text/css">
			body { padding-top: 40px; }
		</style>
</head>
<body>



   <div class="container">
   	
     <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>SimpleBugs</h1>
        
        <p>SimpleBugs is a simple bugtracking system to report bugs and assign them to your fellow developers.</p>
        
        
        	
        

      </div>   	

      <div class="content">
        <div class="page-header">
        	
          
        </div>
        <div class="row">
          <div class="span16">
            <h2>Installation</h2>
				
						<?php if(isset($errors) && count($errors) > 0): ?>
						<div class="well">
						
						<p>
							<strong>We found some errors you should look into before you continue the installation.</strong>
						</p>
						
						<?php foreach($errors as $error): ?>
							<div class="alert-message error">
						    <p><?php echo $error; ?></p>
							</div>
						<?php endforeach; ?>	
						</div>
						<?php endif; ?>
				
				
						<?php if(validation_errors()): ?>
						<div class="well">
						
							<p>
								<strong>We found some errors you should look into before you continue the installation.</strong>
							</p>
							<div class="alert-message error">
							<?php echo validation_errors(); ?>
							</div>
						</div>						
						<?php endif; ?>
	
			<?php echo form_open('setup'); ?>

        <fieldset>
          <legend>Database settings</legend>

          <div class="clearfix">
            <label for="db_hostname">Hostname</label>
            <div class="input">
              <input class="xlarge" id="db_hostname" name="hostname" size="30" type="text" value="<?php echo set_value('hostname'); ?>" />
            </div>            
          </div><!-- /clearfix -->

          <div class="clearfix">
            <label for="db_username">Username</label>
            <div class="input">
              <input class="xlarge" id="db_username" name="username" size="30" type="text" value="<?php echo set_value('username'); ?>"/>
            </div>            
          </div><!-- /clearfix -->

          <div class="clearfix">
            <label for="dp_password">Password</label>
            <div class="input">
              <input class="xlarge" id="db_password" name="password" size="30" type="password" value="<?php echo set_value('password'); ?>"/>
            </div>            
          </div><!-- /clearfix -->
				      
          <div class="clearfix">
            <label for="db_database">Database</label>
            <div class="input">
              <input class="xlarge" id="db_databate" name="database" size="30" type="text" value="<?php echo set_value('database'); ?>"/>
            </div>            
          </div><!-- /clearfix -->
 				      
          <div class="clearfix">
            <label for="db_prefix">Prefix</label>
            <div class="input">
              <input class="xlarge" id="db_prefix" name="dbprefix" size="30" type="text" value="<?php echo set_value('dbprefix', 'sb_'); ?>" />
            </div>            
          </div><!-- /clearfix -->

 				      
				  </fieldset>
				  
       <fieldset>
          <legend>Admin user</legend>
				  
          <div class="clearfix">
            <label for="admin_username">Admin username</label>
            <div class="input">
              <input class="xlarge" id="admin_username" name="admin_username" size="30" type="text" value="<?php echo set_value('admin_username'); ?>"/>
            </div>            
          </div><!-- /clearfix -->

          <div class="clearfix">
            <label for="admin_email">Admin email</label>
            <div class="input">
              <input class="xlarge" id="admin_email" name="admin_email" size="30" type="text" value="<?php echo set_value('admin_email'); ?>"/>
            </div>            
          </div><!-- /clearfix -->				  


          <div class="clearfix">
            <label for="admin_password">Admin Password</label>
            <div class="input">
              <input class="xlarge" id="admin_password" name="admin_password" size="30" type="password" value="<?php echo set_value('admin_password'); ?>"/>
            </div>            
          </div><!-- /clearfix -->				  
          
          <div class="clearfix">
            <label for="admin_passconf">Confirm Password</label>
            <div class="input">
              <input class="xlarge" id="admin_passconf" name="admin_passconf" size="30" type="password" value="<?php echo set_value('admin_passconf'); ?>" />
            </div>            
          </div><!-- /clearfix -->				  
          

         <div class="actions">
            <input type="submit" class="btn primary" value="Install now!">
          </div>
				  
			 </fieldset>
				</form>    
				      
       	</div>
      </div>

      <footer>
        <p>&copy; Catalyst Code 2011</p>

      </footer>


</body>
</html>