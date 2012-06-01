<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php if(isset($page_title)): ?><?php echo $page_title; ?> - <?php endif; ?><?php echo lang('simplebugs'); ?></title>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>">/</script>
		<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap-alert.js'); ?>">/</script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">		

		<link href="<?php echo base_url('assets/select2/select2.css'); ?>" rel="stylesheet" type="text/css">
		<script src="<?php echo base_url('assets/select2/select2.js'); ?>"></script>		
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/shadowbox/shadowbox.css'); ?>">		
		<script src="<?php echo base_url('assets/shadowbox/shadowbox.js'); ?>"></script>		
		
		

	</head>
	<body>

		<?php $this->load->view('navbar'); ?>
		
		<div class="container">