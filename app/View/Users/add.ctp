<div class="users form">
<?php echo $this->Form->create('User',array('action'=>'app_userregistration')); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('school');
		echo $this->Form->input('userview');
		echo $this->Form->input('question');
		echo $this->Form->input('answer');
		echo $this->Form->input('role');
		echo $this->Form->input('status');
		echo $this->Form->input('device');
		echo $this->Form->input('device_token');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
