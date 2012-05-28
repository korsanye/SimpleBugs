	<div class="row-fluid">		
			<a href="<?php echo site_url('admin/categories/create'); ?>" class="btn btn-primary pull-right"><?php echo lang('create_category'); ?></a>		
			<h1><?php echo lang('categories'); ?> <small><?php echo lang('overview'); ?></small></h1>
	</div>

	<div class="row-fluid">		
	<table class="table table-striped">
		<tbody>
			<?php foreach($categories->result() as $category): ?>
			<tr>				
				<td><?php echo $category->name; ?><?php if($category->default): ?> <span class="label"><?php echo lang('default'); ?></span> <?php endif; ?></td>
				
				<td>
					<div class="pull-right">							
						<a href="<?php echo site_url('admin/categories/edit/'.$category->id); ?>" class="btn btn-mini"><i class="icon-edit"></i> <?php echo lang('edit'); ?></a>
						<a href="#" class="btn btn-mini btn-info"><i class="icon-tasks icon-white"></i> <?php echo lang('issues'); ?></a>
						<a href="<?php echo site_url('admin/categories/delete/'.$category->id); ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> <?php echo lang('delete'); ?></a>
					</div>
				</td>
			</tr>				
			<?php endforeach; ?>		
		</tbody>
	</table>
	</div>