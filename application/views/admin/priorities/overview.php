	<div class="row-fluid">		
			<a href="<?php echo site_url('admin/priorities/create'); ?>" class="btn btn-primary pull-right"><?php echo lang('create_priority'); ?></a>		
			<h1><?php echo lang('priorities'); ?> <small><?php echo lang('overview'); ?></small></h1>
	</div>

	<div class="row-fluid">		
	<table class="table table-striped">
		<tbody>
			<?php foreach($priorities->result() as $priority): ?>
			<tr>				
				<td><?php echo $priority->name; ?><?php if($priority->default): ?> <span class="label"><?php echo lang('default'); ?></span> <?php endif; ?></td>
				
				<td>
					<div class="pull-right">

							<?php if( $priority->sort != 0 ): ?>
							<a href="<?php echo site_url('admin/priorities/sort/up/'.$priority->id); ?>"><i class="icon-arrow-up"></i></a>
							<?php endif; ?>
							<?php if( $priority->sort < ($priorities->num_rows() - 1) ): ?>
							<a href="<?php echo site_url('admin/priorities/sort/down/'.$priority->id); ?>"><i class="icon-arrow-down"></i></a>
							<?php endif; ?>					
							

						<a href="<?php echo site_url('admin/priorities/edit/'.$priority->id); ?>" class="btn btn-mini"><i class="icon-edit"></i> <?php echo lang('edit'); ?></a>
						<a href="#" class="btn btn-mini btn-info"><i class="icon-tasks icon-white"></i> <?php echo lang('issues'); ?></a>
						<a href="<?php echo site_url('admin/priorities/delete/'.$priority->id); ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> <?php echo lang('delete'); ?></a>
					</div>
				</td>
			</tr>				
			<?php endforeach; ?>		
		</tbody>
	</table>
	</div>