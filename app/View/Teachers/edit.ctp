<div class="teachers form">
<?php echo $this->Form->create('Teacher'); ?>
	<fieldset>
		<legend><?php echo __('Edit Teacher'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('userid');
		echo $this->Form->input('classname');
		echo $this->Form->input('starttime');
		echo $this->Form->input('endtime');
		echo $this->Form->input('fromdate');
		echo $this->Form->input('enddate');
		echo $this->Form->input('days');
		echo $this->Form->input('district');
		echo $this->Form->input('code');
		echo $this->Form->input('latitude');
		echo $this->Form->input('logitude');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Teacher.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Teacher.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Teachers'), array('action' => 'index')); ?></li>
	</ul>
</div>
