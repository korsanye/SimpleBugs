							<h6><?php echo lang('project'); ?></h6>
							<p><i class="icon-folder-open"></i> <?php echo $project; ?></p>

							<h6><?php echo lang('category'); ?></h6>
							<p><i class="icon-tasks"></i> <?php echo $category; ?></p>


							<h6><?php echo lang('priority'); ?></h6>
							<p><i class="icon-flag"></i> <?php echo $priority; ?></p>

							<h6><?php echo lang('milestone'); ?></h6>
							<p><i class="icon-road"></i> <?php echo $milestone; ?></p>

							<h6><?php echo lang('created'); ?></h6>
							<p><i class="icon-time"></i> <?php echo date($date_time_format, strtotime($issue->create_date)); ?></p>
														
							<h6><?php echo lang('estimate'); ?></h6>
							<p><i class="icon-time"></i> <?php echo gmdate("H:i", $issue->estimate); ?></p>

							<h6><?php echo lang('time_spent'); ?></h6>
							<p><i class="icon-time"></i> <?php echo gmdate("H:i", $issue->time_spent); ?>
							<?php if($issue->time_spent > $issue->estimate): ?><span class="label label-important">!</span><?php endif; ?></p>