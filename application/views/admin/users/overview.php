	<div class="row-fluid">
			<a href="<?php echo site_url('admin/users/create'); ?>" class="btn btn-primary pull-right"><?php echo lang('create_user'); ?></a>		
			<h1><?php echo lang('users'); ?> <small><?php echo lang('overview'); ?></small></h1>
	</div>

	<div class="row-fluid">		
	<table class="table table-striped">
		<tbody>
			<?php foreach($users as $user): ?>
			<tr>
				<td width="35"><img src="//www.gravatar.com/avatar/<?php echo md5(strtolower($user->email)); ?>?s=20&d=mm" alt="Gravatar"></td>
				<td width="25%"><?php echo $user->username; ?></td>
				<td><?php echo $user->email; ?></td>
				<td>
					<div class="pull-right">
						<a href="<?php echo site_url('admin/users/edit/'.$user->id); ?>" class="btn btn-mini"><i class="icon-edit"></i> <?php echo lang('edit'); ?></a>
						<a href="#" class="btn btn-mini btn-info"><i class="icon-tasks icon-white"></i> <?php echo lang('issues'); ?></a>
					</div>
				</td>
			</tr>				
			<?php endforeach; ?>		
		</tbody>
	</table>
	</div>