<div class="eventhosts form">
<?php echo $this->Form->create('Eventhost'); ?>
	<fieldset>
		<legend><?php echo __('Add Eventhost'); ?></legend>
	<?php
		echo $this->Form->input('userid');
		echo $this->Form->input('eventname');
		echo $this->Form->input('starttime');
		echo $this->Form->input('endtime');
		echo $this->Form->input('fromdate');
		echo $this->Form->input('enddate');
		echo $this->Form->input('days');
		echo $this->Form->input('district');
		echo $this->Form->input('code');
		echo $this->Form->input('companycode');
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

		<li><?php echo $this->Html->link(__('List Eventhosts'), array('action' => 'index')); ?></li>
	</ul>
</div>
