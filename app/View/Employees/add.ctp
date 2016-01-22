<!doctype html>
<html lang="en">
  <head>
   
    <title>Home Page</title>

  </head>
<style>
table thead tr th, table tfoot tr th, table tfoot tr td, table tbody tr th, table tbody tr td, table tr td {
  width: auto;
}
</style>
  <body>
      <div class="main_wrapper">
 <?php echo $this->element('header');?>
<!--end of header-->
<section>
  <div class="main-contents-details">
  <div class="table">
<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
	<fieldset>
		<legend><?php echo __('Add Employee'); ?></legend>
	<?php
		echo $this->Form->input('userid');
		echo $this->Form->input('locationname');
		echo $this->Form->input('locationcode');
		echo $this->Form->input('managercode');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?></li>
	</ul>
</div>
