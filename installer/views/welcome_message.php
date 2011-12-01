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
				
		<?php if(count($errors) > 0): ?>
		<div class="well">
		
		<p>
			<strong>We found some errors you should look at before you continue the installation.</strong>
		</p>
		
		<?php foreach($errors as $error): ?>
			<div class="alert-message error">
		    <p><?php echo $error; ?></p>
			</div>
		<?php endforeach; ?>
	
			<div class="row">
				<div class="clearfix">	
					<a href="<?php echo base_url(); ?>" class="btn pull-right">Refresh</a>
				</div>
			</div>
		</div>
		<?php endif; ?>



          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Catalyst Code 2011</p>

      </footer>


</body>
</html>