<div class="attendees form">
<?php echo $this->Form->create('Attendee'); ?>
	<fieldset>
		<legend><?php echo __('Add Attendee'); ?></legend>
	<?php
		echo $this->Form->input('userid');
		echo $this->Form->input('eventname');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?></li>
	</ul>
</div>
