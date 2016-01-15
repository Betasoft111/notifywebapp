<div class="parrents form">
<?php echo $this->Form->create('Parrent'); ?>
	<fieldset>
		<legend><?php echo __('Edit Parrent'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('userid');
		echo $this->Form->input('childname');
		echo $this->Form->input('teachercode');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Parrent.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Parrent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Parrents'), array('action' => 'index')); ?></li>
	</ul>
</div>
