	<div class="row-fluid">		
			<a href="<?php echo site_url('admin/projects/create'); ?>" class="btn btn-primary pull-right"><?php echo lang('create_project'); ?></a>		
			<h1><?php echo lang('projects'); ?> <small><?php echo lang('overview'); ?></small></h1>
	</div>

	<div class="row-fluid">		
	<table class="table table-striped">
		<tbody>
			<?php foreach($projects->result() as $project): ?>
			<tr>
				<td><?php echo $project->name; ?></td>
				<td>
					<div class="pull-right">
						<a href="<?php echo site_url('admin/projects/edit/'.$project->id); ?>" class="btn btn-mini"><i class="icon-edit"></i> <?php echo lang('edit'); ?></a>
						<a href="#" class="btn btn-mini btn-info"><i class="icon-tasks icon-white"></i> <?php echo lang('issues'); ?></a>
					</div>
				</td>
			</tr>				
			<?php endforeach; ?>		
		</tbody>
	</table>
	</div>