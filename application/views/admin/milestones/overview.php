

	<div class="row-fluid">		
			<a href="<?php echo site_url('admin/milestones/create'); ?>" class="btn btn-primary pull-right"><?php echo lang('create_milestone'); ?></a>		
			<h1><?php echo lang('projects'); ?> <small><?php echo lang('overview'); ?></small></h1>
	</div>

	<div class="row-fluid">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><?php echo lang('name'); ?></th>
				<th><?php echo lang('due'); ?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($milestones->result() as $milestone): ?>
			<tr>
				<td><?php echo $milestone->name; ?></td>
				<td><?php echo date($this->settings_model->get('date_format', 'Y-m-d'), strtotime($milestone->milestone)); ?></td>
				<td>
					<div class="pull-right">
						<a href="<?php echo site_url('admin/milestones/edit/'.$milestone->id); ?>" class="btn btn-mini"><i class="icon-edit"></i> <?php echo lang('edit'); ?></a>
						<a href="#" class="btn btn-mini btn-info"><i class="icon-tasks icon-white"></i> <?php echo lang('issues'); ?></a>
					</div>
				</td>
			</tr>				
			<?php endforeach; ?>		
		</tbody>
	</table>
	</div>