<div class="attendees form">
<?php echo $this->Form->create('Attendee'); ?>
	<fieldset>
		<legend><?php echo __('Edit Attendee'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Attendee.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Attendee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?></li>
	</ul>
</div>
