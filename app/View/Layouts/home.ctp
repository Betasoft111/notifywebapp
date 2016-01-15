<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<title><?php echo 'Attendance';?></title>
</head>
<style>
 input[type=submit]:hover {
    cursor:pointer;
} 
 input[type=button]:hover {
    cursor:pointer;
} 
</style>


<?php echo $this->Html->script(array('jquery.min','vendor/jquery','tinyslide','vendor/modernizr','foundation.min'))?>
  <?php echo $this->Html->css(array('foundation','font-awesome','font-awesome.min','tinyslide','style','main'))?>
  <body id="sidebar-left">    	
	  <div id="page_wrapper">
		  <div id="page-header">
		  </div>
		  <div id="content">
			  <?php echo $content_for_layout?>       
		  </div>
	  </div>        
  </body>
  <script>
      $(document).foundation();
    </script>
</html>
