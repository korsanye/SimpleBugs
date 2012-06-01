	<div class="row">				
			<div class="span12">
			
				<h1><?php echo lang('issue'); ?> #<?php echo $issue->id; ?></h1>
				<h3><?php echo $issue->title; ?></h3>
				<h6><?php echo lang('assigned_to'); ?> <a href="#"><?php echo $this->simpleusers->user($issue->assigned_to)->username; ?></a></h6>
				<hr>
				
				<div class="row">
					<div class="span3">
						<div class="well">

							<?php $this->load->view('issues/infobar'); ?>
														
						</div>
					</div>	
					
					<div class="span9">

						<?php foreach($posts->result() as $post): ?>
						<div class="issue_top">
							
						<?php if($post->first_post): ?>
						<strong><?php echo lang('opened_by'); ?> <a href="#"><?php echo $this->simpleusers->user($post->assigned_from)->username; ?></a></strong> <?php echo date($date_time_format, strtotime($issue->create_date)); ?>
						<?php else: ?>
						<strong><?php echo lang('assigned_to'); ?> <a href="#"><?php echo $this->simpleusers->user($post->assigned_to)->username; ?></a> <?php echo lang('by'); ?> <a href="#"><?php echo $this->simpleusers->user($post->assigned_from)->username; ?></a></strong> <?php echo date($date_time_format, strtotime($post->assigned_date)); ?>
						<?php endif; ?>
						
						
							<?php if(!isset($top)): ?>
							 <div class="pull-right">
									<a href="<?php echo site_url('issues/assign/'.$issue->id); ?>" class="btn btn-mini btn-primary "><i class="icon-user"></i> <?php echo lang('assign'); ?></a>
									<a href="#" class="btn btn-mini btn-success "><i class="icon-ok"></i> <?php echo lang('resolve'); ?></a>
								</div>
							<?php endif; $top = true;?>
						
						</div>
						<div class="issue_bottom">
							<?php echo $post->content; ?>
						</div>

						<?php endforeach; ?>
	

						<!--

						<div class="issue_top">
						<strong>Assigned to <a href="#">Dan Storm</a> by <a href="#">Dan Storm</a></strong>
						</div>
						<div class="issue_bottom">
								
							<a href="#" class="thumbnail">
								<img src="http://www.frontpage-to-expression.com/images/bug-test3.jpg" alt="">
							</a>
							
							
						</div>


					
						<div class="issue_top">
						<strong>Opened by <a href="#">Dan Storm</a></strong>
						</div>
						<div class="issue_bottom">
							Hello!	
						</div>
					
						-->
					</div>
					
				</div>				
				
			</div>
		</div>