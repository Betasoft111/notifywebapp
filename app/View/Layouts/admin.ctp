<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title><?php echo 'Attendance Admin ';?></title>
</head>
<style>
 input[type=submit]:hover {
    cursor:pointer;
} 
 input[type=button]:hover {
    cursor:pointer;
} 
</style>

<?php echo $this->Html->script(array('admin/jquery-1.8.2.js','admin/jquery.validate.js','admin/tooltip.js','admin/superfish.js','admin/common.js'))?>
  <?php echo $this->Html->css(array('ui/ui.base.css','themes/apple_pie/ui.css','admin.css'))?>
  <body id="sidebar-left">    	
	  <div id="page_wrapper">
		  <div id="page-header">
			<?php
			if(!in_array($this->params['action'],array('admin_login')))
			{
				echo $this->element('adminElements/admin_header'); 
			}
			?>
		  </div>
		  <div id="content">
			  <?php echo $content_for_layout?>       
		  </div>
	  </div>        
  </body>
</html>