<?php $this->load->view('admin/header'); ?>
<?php
	if (is_array($main_content))
	{
		foreach ($main_content as $view)
		{
			$this->load->view($view);
		}
	}
	else
	{
		$this->load->view($main_content);
	}
?>
<?php $this->load->view('admin/footer'); ?>