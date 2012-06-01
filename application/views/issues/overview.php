	<div class="row">				
		<div class="span12">
			<table class="table table_striped">
				
				<thead>
					<tr>
						<th><?php echo lang('issue'); ?></th>
						<th></th>
						<th><?php echo lang('assigned_to'); ?></th>
						<th><?php echo lang('priority'); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($issues->result() as $issue): ?>
				<tr>
					<td>
						<a href="<?php echo site_url($issue->id); ?>">
						#<?php echo $issue->id; ?>
						</a>
					</td>					
					
					<td>
						<a href="<?php echo site_url($issue->id); ?>">
						<?php echo $issue->title; ?>
						</a>
					</td>					

					<td>
						<?php echo $this->simpleusers->user($issue->assigned_to)->username; ?>
					</td>
					<td>
						<?php echo ($priority = $this->priorities_model->priority($issue->priority_id)) ? $priority->name : lang('unknown_priority'); ?>
					</td>									
					
				</tr>				
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>