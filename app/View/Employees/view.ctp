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
<div class="employees view">
<h2><?php echo __('Employee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Userid'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['userid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locationname'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['locationname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locationcode'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['locationcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Managercode'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['managercode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($employee['Employee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Employee'), array('action' => 'edit', $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Employee'), array('action' => 'delete', $employee['Employee']['id']), array(), __('Are you sure you want to delete # %s?', $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee'), array('action' => 'add')); ?> </li>
	</ul>
</div>
