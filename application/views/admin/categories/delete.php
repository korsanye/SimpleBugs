<div class="row-fluid">
	<h1><?php echo lang('confirm_deletion'); ?></h1>


<p>
	<?php echo sprintf(lang('confirm_category_deletion'), $category->name); ?>	
</p>


<form method="post" action="">

	<input type="submit" class="btn btn-large btn-danger" name="delete" value="<?php echo lang('confirm_delete_button'); ?>">	
	<a href="<?php site_url('admin/categories'); ?>" class="btn btn-large"><?php echo lang('cancel'); ?></a>
	
</form>	
</div>
