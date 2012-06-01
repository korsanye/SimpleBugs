		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">

		    <a class="brand" href="#">
			    <?php echo lang('simplebugs'); ?>
		    </a>
    
		    <ul class="nav">
			    <li <?php if($this->uri->segment(1) == FALSE || ($this->uri->segment(1) == "issues" && $this->uri->segment(2) != "create")):?> class="active"<?php endif; ?>><a href="<?php echo base_url(); ?>"><?php echo lang('issues'); ?></a></li>
			    <li<?php if($this->uri->segment(2) == "create"):?> class="active"<?php endif; ?>><a href="<?php echo site_url('issues/create'); ?>">New Issue</a></li>	    
		    </ul>    
		
		    <form class="navbar-search pull-right">
			    <input type="text" class="search-query" placeholder="<?php echo lang('search'); ?>">
		    </form>
		    		    
		   	<ul class="nav pull-right">
		   		<!-- <li><a href="#">Notifications <span class="badge badge-info">8</span></a></li> -->
		  		<?php if($this->simpleusers->is_admin()): ?><li<?php if($this->uri->segment(1) == "admin"):?> class="active"<?php endif; ?>><a href="<?php echo site_url('admin'); ?>"><?php echo lang('administration'); ?></a></li><?php endif; ?>
		  		<li><a href="<?php echo site_url('logout'); ?>"><?php echo lang('logout'); ?></a></li>
		  	</ul>


				</div>
			</div>
		</div>